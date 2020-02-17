<?php

namespace Stock\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stock\Mail\IntegrationAprov;
use Stock\Mail\IntegrationPedAprov;

class PedidoAprovCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pedidoaprov:cron';

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
            ->select("SELECT	RTRIM(SC7.C7_NUM) num_pedido,
		RTRIM(SC7.C7_NUMSC) num_solicit,
		RTRIM(SC1.C1_NOMESOL) solicitante,
		RIGHT(SC7.C7_DATPRF,2)+'/'+SUBSTRING(SC7.C7_DATPRF,5,2)+'/'+LEFT(SC7.C7_DATPRF,4) AS data_entrega,
		RTRIM(SC1.C1_EMAIL) email
FROM SC7010 SC7
	LEFT JOIN SC1010 SC1 ON (SC1.D_E_L_E_T_='' AND SC1.C1_FILIAL = SC7.C7_FILIAL AND SC1.C1_NUM = SC7.C7_NUMSC)
WHERE C7_RESIDUO ='' AND C7_CONTRA ='' AND C7_CONAPRO <> 'B' AND SC7.C7_NUMSC <> '' AND SC7.C7_EMISSAO >= '20200216' 
AND C7_XENVAPR <> '1'
GROUP BY SC7.C7_NUM, SC7.C7_NUMSC, SC1.C1_NOMESOL, SC1.C1_EMAIL, SC7.C7_XENVEML, SC7.C7_DATPRF, C7_XENVAPR");


        if (count($arraySolicitationNumber) > 0) {
            for ($j = 0; $j < sizeof($arraySolicitationNumber); $j++) {
                Mail::queue(new IntegrationPedAprov($arraySolicitationNumber[$j]->email, $arraySolicitationNumber[$j], $arraySolicitationNumber[$j]->num_pedido));
                DB::connection('sqlsrvcomprovei')->update("UPDATE SC7010 SET C7_XENVAPR = '1' WHERE C7_NUM = ?", [$arraySolicitationNumber[$j]->num_pedido]);
            }
        }else{
            return response()->json(['message' => 'Sem pedidos nessa data email']);
        }

        //dd($arraySolicitationNumber);
    }
}
