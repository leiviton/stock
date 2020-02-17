<?php

namespace Stock\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stock\Mail\IntegrationEmail;

class PedidoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedido:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get outs client logix';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }


    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws \Exception
     */
    public function handle()
    {


        $arraySolicitationNumber = DB::connection('sqlsrvcomprovei')
            ->select("	SELECT RTRIM(SC7.C7_NUM) num_pedido,
						RTRIM(SC7.C7_NUMSC) num_solicit,
						RTRIM(SC1.C1_NOMESOL) solicitante,
						RIGHT(SC7.C7_DATPRF,2)+'/'+SUBSTRING(SC7.C7_DATPRF,5,2)+'/'+LEFT(SC7.C7_DATPRF,4) AS data_entrega,
						RTRIM(SC1.C1_EMAIL) email,
						SC7.C7_XENVEML env_email
				FROM SC7010 SC7
					LEFT JOIN SC1010 SC1 ON (SC1.D_E_L_E_T_='' AND SC1.C1_FILIAL = SC7.C7_FILIAL AND SC1.C1_NUM = SC7.C7_NUMSC)
				WHERE SC7.D_E_L_E_T_='' 
					AND SC7.C7_EMISSAO >= '20200216' AND C7_XENVEML <> '1'
				GROUP BY SC7.C7_NUM,
							SC7.C7_NUMSC,
							SC1.C1_NOMESOL,
							SC7.C7_DATPRF,
							SC1.C1_EMAIL,
							C7_XENVEML");

        //dd($arraySolicitationNumber);

        $solicitacao = '';
        if (count($arraySolicitationNumber) > 0)
            for ($i = 0; $i < count($arraySolicitationNumber); $i++) {
                // dd($i);
                if ($i == 0) {
                    $solicitacao .= $arraySolicitationNumber[$i]->num_solicit;
                } else {
                    //dd($solicitacao);
                    $solicitacao .= ',' . $arraySolicitationNumber[$i]->num_solicit;
                }
                $solicitUnique = array_unique(explode(',', $solicitacao));
            } else {
            $solicitUnique = [];
        }
        //dd($arraySolicitationNumber);
        //dd($solicitUnique);
        if (count($solicitUnique) > 0) {
            for ($j = 0; $j < count($solicitUnique); $j++) {
                $result = DB::connection('sqlsrvcomprovei')
                    ->select("	SELECT RTRIM(SC7.C7_NUM) num_pedido,
						RTRIM(SC7.C7_NUMSC) num_solicit,
						RTRIM(SC1.C1_NOMESOL) solicitante,
						RIGHT(SC7.C7_DATPRF,2)+'/'+SUBSTRING(SC7.C7_DATPRF,5,2)+'/'+LEFT(SC7.C7_DATPRF,4) AS data_entrega,
						RTRIM(SC1.C1_EMAIL) email,
						SC7.C7_XENVEML env_email
				FROM SC7010 SC7
					LEFT JOIN SC1010 SC1 ON (SC1.D_E_L_E_T_='' AND SC1.C1_FILIAL = SC7.C7_FILIAL AND SC1.C1_NUM = SC7.C7_NUMSC)
				WHERE SC7.D_E_L_E_T_='' 
					AND SC7.C7_EMISSAO >= '20200216' AND C7_XENVEML <> '1' AND C7_NUMSC = $solicitUnique[$j]
				GROUP BY SC7.C7_NUM,
							SC7.C7_NUMSC,
							SC1.C1_NOMESOL,
							SC7.C7_DATPRF,
							SC1.C1_EMAIL,
							C7_XENVEML");

                //AND C7_XENVEML <> '1' AND C7_NUMSC = $solicitUnique[$j]
                Mail::queue(new IntegrationEmail($result[0]->email, $result, $solicitUnique[$j]));

                DB::connection('sqlsrvcomprovei')->update("UPDATE SC7010 SET C7_XENVEML = '1' WHERE C7_NUMSC = ?", [$solicitUnique[$j]]);
            }

            return response()->json(['message' => 'Finalizado envio de email']);
        } else {
            return response()->json(['message' => 'Sem solicitação pendente']);
        }

    }
}
