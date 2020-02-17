<?php

namespace Stock\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stock\Mail\IntegrationLogix;

class EmailCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'emails:cron';

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

        $arraySolicitationNumber = DB::connection('sqlsrvcomprovei')->select("SELECT RTRIM(C1_NUM) num_solicit,
	RTRIM(C1_DESCRI) descri_prod,
	C1_QUANT qtd_prod, 
	RTRIM(C1_NOMESOL) solicitante,
	RTRIM(C1_EMAIL) email,
	C1_XENVEML env_email
FROM SC1010 
	WHERE D_E_L_E_T_ ='' AND env_email <> '1'
	AND C1_QUJE = '0' 
	AND C1_COTACAO ='' 
	AND C1_APROV LIKE '%L%' 
	AND C1_RESIDUO = '' 
	AND C1_EMISSAO >= '20200216'
");

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

        if (count($solicitUnique) > 0) {
            for ($j = 0; $j < count($solicitUnique); $j++) {
                $result = DB::connection('sqlsrvcomprovei')
                    ->select("SELECT 
                                RTRIM(C1_NUM) num_solicit,
                                    RTRIM(C1_DESCRI) descri_prod,
                                    C1_QUANT qtd_prod, 
                                    RTRIM(C1_NOMESOL) solicitante,
                                    RTRIM(C1_EMAIL) email,
                                    C1_XENVEML env_email
                                FROM SC1010 
                                    WHERE D_E_L_E_T_ ='' 
                                    AND C1_QUJE = '0' 
                                    AND C1_COTACAO ='' 
                                    AND C1_APROV LIKE '%L%' 
                                    AND C1_RESIDUO = '' 
                                    AND C1_EMISSAO >= '20200216'
                                    AND C1_XENVEML <> '1'
                                    AND C1_NUM = $solicitUnique[$j]");

                Mail::queue(new IntegrationLogix($result[0]->email, $result, $solicitUnique[$j]));

                DB::connection('sqlsrvcomprovei')->update("UPDATE SC1010 SET C1_XENVEML = '!' WHERE C1_NUM = ?", [$solicitUnique[$j]]);
            }

            return response()->json(['message' => 'Finalizado envio de email']);
        } else {
            return response()->json(['message' => 'Sem solicitação pendente']);
        }
    }
}
