<?php

namespace Stock\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Stock\Mail\IntegrationAprov;

class AprovCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aprov:cron';

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
            ->select("SELECT RTRIM(C7.C7_NUM) num_pedido, 
		RTRIM(C7.C7_NUMSC) num_solicit,  
		AK_EMAIL email_aprov, 
		AK_NOME	nome_aprov, 
		CR_STATUS status_aprov,  
		AL.AL_NIVEL nivel_aprov,
		CR_EMISSAO emissao
FROM SC7010 C7
		LEFT JOIN SCR010 CR ON (CR.D_E_L_E_T_ ='' AND CR.CR_FILIAL = C7.C7_FILIAL AND CR.CR_NUM = C7.C7_NUM)
		LEFT JOIN SAK010 AK ON (AK.D_E_L_E_T_ ='' AND AK.AK_FILIAL = CR.CR_FILIAL AND AK.AK_USER = CR.CR_USER)
		LEFT JOIN SAL010 AL ON (AL.D_E_L_E_T_ ='' AND AL.AL_FILIAL = CR.CR_FILIAL AND AL.AL_USER = CR.CR_USER AND AL.AL_COD = CR.CR_GRUPO)
WHERE C7_EMISSAO >= '20200216' AND C7.D_E_L_E_T_ ='' AND CR_ENVMAIL <> '1'
GROUP BY C7_NUM, C7_NUMSC,AK_EMAIL, AK_NOME, CR_STATUS, AL.AL_NIVEL, CR_EMISSAO");
        if (count($arraySolicitationNumber) > 0) {
            for ($j = 0; $j < sizeof($arraySolicitationNumber); $j++) {
                if ($arraySolicitationNumber[$j]->status_aprov == '02') {
                    Mail::queue(new IntegrationAprov($arraySolicitationNumber[$j]->email_aprov, $arraySolicitationNumber[$j], $arraySolicitationNumber[$j]));
                    DB::connection('sqlsrvcomprovei')->update("UPDATE SCR010 SET CR_ENVMAIL = '1' WHERE CR_NUM = ? AND CR_STATUS = '02'", [$arraySolicitationNumber[$j]->num_pedido]);
                }
            }
        }else{
            return response()->json(['message' => 'Sem pedidos nessa data email']);
        }

        //dd($arraySolicitationNumber);
    }
}
