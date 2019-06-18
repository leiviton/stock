<?php
/**
 * Created by PhpStorm.
 * User: leiviton.silva
 * Date: 27/05/2019
 * Time: 16:17
 */

namespace Stock\Services;

use Illuminate\Support\Facades\DB;
use NFePHP\Common\Certificate;
use NFePHP\NFe\Common\Standardize;
use NFePHP\NFe\Complements;
use NFePHP\NFe\Exception\InvalidArgumentException;
use NFePHP\NFe\Make;
use NFePHP\NFe\Tools;
use NFePHP\DA\NFe\Danfe;
use NFePHP\DA\Legacy\FilesFolders;


class NFeService
{

    /**
     *
     */
    public function emitirNfe()
    {
       $pedido = DB::connection('sqlsrv')->raw("SELECT 

* FROM (

SELECT TOP 5
         saida.pedido
       , saida.tip_docum
       , ISNULL(F1_CHVNFE,'') [CVH_ENT]
       , A1_EST    [UF_CLI_REM]
       , A1_CGC AS [CNPJ_REM]
       , (SELECT A1_CGC 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [CLI_DEST]
       , (SELECT A1_NOME
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [NomCli]
       , (SELECT A1_END 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [EndCli]
       , (SELECT A1_BAIRRO 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [BaiCli]
       , (SELECT A1_COD_MUN 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [CoMuCli]
       , (SELECT A1_MUN 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [MunCli]
       , (SELECT A1_EST 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [EstCli]
       , (SELECT A1_CEP 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [CepCli]
       , (SELECT A1_CODPAIS 
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [CodPais]
       , (SELECT A1_PAIS
                           FROM SA1010 A1B 
                   WHERE A1B.D_E_L_E_T_ = '' 
                             AND A1B.A1_COD + A1B.A1_LOJA COLLATE SQL_Latin1_General_CP1_CI_AS = (SELECT cliB.texto_parametro as [CodProtheus] 
                                        FROM LOGIX_TESTE.logix.wms_docum_saida saidaA                                    
                                        INNER JOIN LOGIX_TESTE.logix.vdp_cli_parametro cliB -- Relacionamento para encontrar o cliente final
                                        on cliB.cliente   = saidaA.cliente 
                                        and cliB.parametro = 'cod_externo_intg_eai'
                                        WHERE saidaA.trans_docum_retorno_simbolico = saida.transacao_docum )) as [PaisDes]

--     , saida.transacao_docum
--     , (SELECT transacao_docum FROM LOGIX_TESTE.logix.wms_docum_saida WHERE trans_docum_retorno_simbolico = saida.transacao_docum) as [a]
    , C5_TPFRETE    AS [TIPO_TRANSP]
       , A4_NOME       AS [NOME_TRANSP]
       , A4_CGC        AS [CNPJ_TRANSP]
       , A4_INSEST     AS [INS_TRANSP]
       , A4_END        AS [END_TRANSP]
       , A4_MUN        AS [MUN_TRANSP]
       , A4_EST        AS [UF_TRANSP]
       , C6.C6_PRODUTO AS [CodProd]
       , C6.C6_DESCRI  AS [DescProd] --B1.B1_DESC    AS [DescProd]
       , B1.B1_POSIPI  AS [NCM]
       , C6.C6_QTDVEN  AS [Qtd]  --D2.D2_QUANT AS [Quant]
       , C6.C6_CF      AS [CFOP] --D2.D2_CF
       , B1.B1_UM      AS [UM]
       , C6.C6_PRCVEN  AS [PRC]
       , C6.C6_VALOR   AS [VALOR] 
       , B1.B1_CODBAR  AS [EAN]
       , ISNULL(D2.D2_CLASFIS,B1.B1_ORIGEM+F4.F4_SITTRIB) AS [CST]
       , ISNULL(D2.D2_BASEICM,0) AS [BasIcm]
       , ISNULL(D2.D2_PICM,0)    AS [AlqIcm]   
       , ISNULL(D2.D2_VALICM,0)  AS [ValIcm]
       , F4_GRPCST     AS [EnqIpi]
       , F4.F4_CTIPI   AS [SitIpi]
       , ISNULL(D2.D2_BASEIPI,0) AS [BasIpi]
       , ISNULL(D2.D2_IPI,0)     AS [AlqIpi]
       , ISNULL(D2.D2_VALIPI,0)  AS [ValIpi]
       , ISNULL(D2.D2_BASIMP6,0) AS [BasPis]
       , ISNULL(D2.D2_ALQIMP6,0) AS [AlqPis]
       , ISNULL(D2.D2_VALIMP6,0) AS [ValPis]
       , F4.F4_CSTPIS                   AS [SitPis]
       , ISNULL(D2.D2_BASIMP5,0) AS [BasCof]
       , ISNULL(D2.D2_ALQIMP5,0) AS [AlqCo]
       , ISNULL(D2.D2_VALIMP5,0) AS [ValCof]
       , F4.F4_CSTCOF  AS [SitCof]
       --, C6_NFORI      AS [Doc]
       --, C6_SERIORI    AS [SerOri]
       --, C6_ITEMORI    AS [IteOri]

FROM SC5010 C5
    
       INNER Join LOGIX_TESTE.logix.wms_docum_saida saida on -- Relaciono com a saida do Logix
       pedido COLLATE SQL_Latin1_General_CP1_CI_AS = C5_NUM         

       INNER JOIN SA1010 A1 ON -- Relaciono com o cadastro de cliente
             A1.D_E_L_E_T_ = '' 
       AND A1_COD  = C5_CLIENTE 
       AND A1_LOJA = C5_LOJACLI

       INNER Join LOGIX_TESTE.logix.vdp_cli_parametro cli on  -- Relaciono com a de/para do Logix
       ltrim(rtrim(texto_parametro)) COLLATE SQL_Latin1_General_CP1_CI_AS = A1_COD + A1_LOJA

       INNER JOIN SC6010 C6 ON  -- Relaciono com o item do pedido
       C6.D_E_L_E_T_ = ''         AND
       C6_FILIAL     = C5_FILIAL  AND
       C6_NUM        = C5_NUM     AND
       C6_CLI        = C5_CLIENTE AND
       C6_LOJA       = C5_LOJACLI

       LEFT JOIN SA4010 A4 ON 
       A4_COD = C5_TRANSP

       LEFT JOIN SF1010 F1 ON 
       F1.F1_FILIAL = C6_FILIAL  AND 
       F1.F1_DOC    = C6_NFORI   AND
       F1.F1_SERIE  = C6_SERIORI AND
       F1.F1_FORNECE = C6_CLI    AND 
       F1.F1_LOJA    = C6.C6_LOJA

       INNER JOIN SB1010 B1 ON -- Relaciono com o cadastro de produto
       B1.D_E_L_E_T_ = ''        AND 
       B1_FILIAL     = C6_FILIAL AND 
       B1_COD        = C6_PRODUTO

       LEFT JOIN SD2010 D2 ON -- Relaciono com o item da NF
       D2.D_E_L_E_T_ = ''         AND
       D2_FILIAL     = C6_FILIAL  AND
       D2_PEDIDO     = C6_NUM     AND 
       D2_ITEMPV     = C6_ITEM    AND 
       D2_COD        = C6_PRODUTO AND 
       D2_CLIENTE    = C6_CLI     AND
       D2_LOJA       = C6_LOJA

       LEFT JOIN SF4010 F4 ON 
       F4.D_E_L_E_T_ = '' 
       AND F4_FILIAL = C6_FILIAL
       AND F4_CODIGO = C6_TES

WHERE C5.D_E_L_E_T_ = '' 
 
order by C5.R_E_C_N_O_ desc  
 ) AS dados
WHERE dados.tip_docum = 'R' AND UF_CLI_REM = 'SP';
");
        dd($pedido);
        $nfe = new Make();
        $std = new \stdClass();
        $nf = 40;
        $std->versao = '4.00';
        $std->Id = null;
        $std->pk_nItem = '';
        $nfe->taginfNFe($std);

        $std = new \stdClass();
        $std->cUF = 35; //coloque um código real e válido
        $std->cNF = '80070011';
        $std->natOp = 'VENDA';
        $std->mod = 55;
        $std->serie = 1;
        $std->nNF = $nf;
        $std->dhEmi = date("Y-m-d\TH:i:sP");
        $std->dhSaiEnt = date("Y-m-d\TH:i:sP");
        $std->tpNF = 1;
        $std->idDest = 2;
        $std->cMunFG = 3506003; //Código de município precisa ser válido
        $std->tpImp = 1;
        $std->tpEmis = 1;
        $std->cDV = 2;
        $std->tpAmb = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
        $std->finNFe = 1;
        $std->indFinal = 0;
        $std->indPres = 0;
        $std->procEmi = '0';
        $std->verProc = 1;
        $nfe->tagide($std);

        $std = new \stdClass();
        $std->xNome = 'SUPORTEMED DISTRIBUIDORA COMERCIO E REPRESENTACAO COMERCIAL LTDA.';
        $std->IE = '675189081113';
        $std->CRT = 3;
        $std->CNPJ = '11957717000142';
        $nfe->tagemit($std);

        $std = new \stdClass();
        $std->xLgr = "PC MIGUEL ORTEGA ";
        $std->nro = '05';
        $std->xBairro = 'PARQUE ASSUNCAO ';
        $std->cMun = 3552809; //Código de município precisa ser válido e igual o  cMunFG
        $std->xMun = 'TABOAO DA SERRA';
        $std->UF = 'SP';
        $std->CEP = '06754160';
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $nfe->tagenderEmit($std);

        $std = new \stdClass();
        $std->xNome = 'LEIVITON CARLOS DA SILVA';
        $std->indIEDest = 2;
        $std->IE = 'ISENTO';
        $std->CNPJ = '23941126000166';
        $nfe->tagdest($std);

        $std = new \stdClass();
        $std->xLgr = "R JOSE RIBEIRO DO VALLE";
        $std->nro = '185';
        $std->xBairro = 'JARDIM BELA VISTA';
        $std->cMun = 3128709;
        $std->xMun = 'Guaxupé';
        $std->UF = 'MG';
        $std->CEP = '37800000';
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $nfe->tagenderDest($std);
        $total = 0.00;

        for ($i = 1; $i < 60; $i++) {
            $std = new \stdClass();
            $std->item = $i;
            $std->cEAN = 'SEM GTIN';
            $std->cEANTrib = 'SEM GTIN';
            $std->cProd = $i;
            $std->xProd = 'PACLITAXEL AHCL 6MG/ML 16.7 ML PACLITAXEL';
            $std->NCM = '30049059';
            $std->CFOP = '6949';
            $std->uCom = 'UN';
            $std->qCom = '1.0000';
            $std->vUnCom = '10.99';
            $std->vProd = '10.99';
            $std->uTrib = 'UN';
            $std->qTrib = '1.0000';
            $std->vUnTrib = '10.99';
            $std->indTot = 1;
            $total += (float)$std->vUnTrib;
            $nfe->tagprod($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->vTotTrib = 0.00;
            $nfe->tagimposto($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->orig = 0;
            $std->CST = '41';
            $std->modBC = 0;
            $std->vBC = 0.0;
            $std->pICMS = '0.0000';
            $std->vICMS = '0.00';
            $nfe->tagICMS($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->cEnq = '999';
            $std->CST = '51';
            $std->vIPI = 0;
            $std->vBC = 0;
            $std->pIPI = 0;
            $nfe->tagIPI($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->CST = '98';
            $std->vBC = 0;
            $std->pPIS = 0;
            $std->vPIS = 0;
            $nfe->tagPIS($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->vCOFINS = 0;
            $std->vBC = 0;
            $std->pCOFINS = 0;

            $nfe->tagCOFINSST($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->CST = '98';
            $std->vBC = 0;
            $std->pCOFINS = 0;
            $std->vCOFINS = 0;
            $nfe->tagCOFINS($std);

            $std = new \stdClass();
            $std->item = $i;
            $std->qVol = 1;
            $std->esp = 'caixa';
            $std->marca = 'DRS';
            $std->nVol = '11111';
            $std->pesoL = 10.00;
            $std->pesoB = 11.00;
            $nfe->tagvol($std);
        }

        $std = new \stdClass();
        $std->vBC = 0.0;
        $std->vICMS = 0.00;
        $std->vICMSDeson = 0.00;
        $std->vBCST = 0.00;
        $std->vST = 0.00;
        $std->vProd = $total;
        $std->vFrete = 0.00;
        $std->vSeg = 0.00;
        $std->vDesc = 0.00;
        $std->vII = 0.00;
        $std->vIPI = 0.00;
        $std->vPIS = 0.00;
        $std->vCOFINS = 0.00;
        $std->vOutro = 0.00;
        $std->vNF = $total;
        $std->vTotTrib = 0.00;
        $nfe->tagICMSTot($std);


        $std = new \stdClass();
        $std->modFrete = 1;
        $nfe->tagtransp($std);
        //dd($total);
        $std = new \stdClass();
        $std->nFat = '002';
        $std->vOrig = $total;
        $std->vLiq = $total;
        $nfe->tagfat($std);

        $std = new \stdClass();
        $std->nDup = '001';
        $std->dVenc = date('Y-m-d');
        $std->vDup = $total;
        $nfe->tagdup($std);

        $std = new \stdClass();
        $std->vTroco = 0;
        $nfe->tagpag($std);

        $std = new \stdClass();
        $std->indPag = 0;
        $std->tPag = "01";
        $std->vPag = $total;
        $std->indPag = 0;
        $nfe->tagdetPag($std);

        $xml = $nfe->getXML(); // O conteúdo do XML fica armazenado na variável $xml

        $config = [
            "atualizacao" => date('Y-m-d h:i:s'),
            "tpAmb" => 2,
            "razaosocial" => "SUPORTEMED DISTRIBUIDORA COMERCIO E REPRESENTACAO COMERCIAL LTDA",
            "cnpj" => "11957717000142", // PRECISA SER VÁLIDO
            "ie" => '675189081113', // PRECISA SER VÁLIDO
            "siglaUF" => "SP",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "AAAAAAA",
            "CSC" => "",
            "CSCid" => "",
            "aProxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]
        ];


        $configJson = json_encode($config);

        $certificadoDigital = file_get_contents('storage\companies\certificates\certificado.pfx');

        //return $xml;
        $tools = new Tools($configJson, Certificate::readPfx($certificadoDigital, '18061960'));
        try {
            $xmlAssinado = $tools->signNFe($xml); // O conteúdo do XML assinado fica armazenado na variável $xmlAssinado
            $idLote = $nf; // Identificador do lote
            $resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                //erro registrar e voltar
                exit("[$std->cStat] $std->xMotivo");
            }

            $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota
            //return $recibo;
            $protocolo = $tools->sefazConsultaRecibo($recibo);

            file_put_contents("storage/companies/xml_gerados/$nf.xml", $xmlAssinado);
            $xmlNf = file_get_contents("storage/companies/xml_gerados/$nf.xml");
            //return $protocolo ."proximo". $xmlOriginal;
//            return $recibo;
//            $xmlA = Complements::toAuthorize($xmlNf, $protocolo);
//
//            file_put_contents("storage/companies/xml_autorizados/$nf.xml", $xmlA);

            return $xml . 'recibo: ' . $recibo;
            //return $protocolo;
        } catch (\Exception $e) {
            //aqui você trata possíveis exceptions da assinatura
            exit($e->getMessage());
        }
        //$key = Keys::build('12','2019','05','23941126000166','55','2','1211','1','1');
    }

    /**
     * @param $recibo
     * @return string
     */
    public function consultaProtocolo($recibo)
    {
        $config = [
            "atualizacao" => date('Y-m-d h:i:s'),
            "tpAmb" => 2,
            "razaosocial" => "SUPORTEMED DISTRIBUIDORA COMERCIO E REPRESENTACAO COMERCIAL LTDA",
            "cnpj" => "11957717000142", // PRECISA SER VÁLIDO
            "ie" => '675189081113', // PRECISA SER VÁLIDO
            "siglaUF" => "SP",
            "schemes" => "PL_009_V4",
            "versao" => '4.00',
            "tokenIBPT" => "AAAAAAA",
            "CSC" => "",
            "CSCid" => "",
            "aProxyConf" => [
                "proxyIp" => "",
                "proxyPort" => "",
                "proxyUser" => "",
                "proxyPass" => ""
            ]
        ];


        $configJson = json_encode($config);

        $certificadoDigital = file_get_contents('storage\companies\certificates\certificado.pfx');

        $tools = new Tools($configJson, Certificate::readPfx($certificadoDigital, '18061960'));


        //consulta número de recibo
        //$numeroRecibo = número do recíbo do envio do lote
        $xmlRetorno = $tools->sefazConsultaRecibo($recibo);

        //transforma o xml de retorno em um stdClass
        $st = new Standardize();
        $std = $st->toStd($xmlRetorno);

        if ($std->cStat == '103') { //lote enviado
            //Lote ainda não foi precessado pela SEFAZ;
            return "lote ainda nao processou";
        }
        if ($std->cStat == '105') { //lote em processamento
            //tente novamente mais tarde
            return "lote ainda em processo";
        }

        if ($std->cStat == '104') { //lote processado (tudo ok)
            if ($std->protNFe->infProt->cStat == '100') { //Autorizado o uso da NF-e
                $xmlOriginal = file_get_contents('storage\companies\xml_gerados\40.xml');
                $xml = Complements::toAuthorize($xmlOriginal, $xmlRetorno);
                file_put_contents("storage/companies/xml_autorizados/40.xml", $xml);
                return response()->json(["situacao" => "autorizada",
                    "numeroProtocolo" => $std->protNFe->infProt->nProt,
                    "xmlProtocolo" => $xmlRetorno]);
            } elseif (in_array($std->protNFe->infProt->cStat, ["302"])) { //DENEGADAS
                return response()->json(["situacao" => "denegada",
                    "numeroProtocolo" => $std->protNFe->infProt->nProt,
                    "motivo" => $std->protNFe->infProt->xMotivo,
                    "cstat" => $std->protNFe->infProt->cStat,
                    "xmlProtocolo" => $xmlRetorno]);
            } else { //não autorizada (rejeição)
                return response()->json(["situacao" => "rejeitada",
                    "motivo" => $std->protNFe->infProt->xMotivo,
                    "cstat" => $std->protNFe->infProt->cStat]);
            }
        } else { //outros erros possíveis
            return response()->json(["situacao" => "rejeitada",
                "motivo" => $std->xMotivo,
                "cstat" => $std->cStat]);
        }
    }

    public function geraDanfe()
    {
        $xml = 'storage/companies/xml_autorizados/40.xml';
        $docxml = FilesFolders::readFile($xml);
        $logo = 'data://text/plain;base64,' . base64_encode(file_get_contents('storage/companies/suportemed/logo.jpg'));
        try {
            $danfe = new Danfe($docxml, 'P', 'A4', $logo, 'I', 'storage/companies/pdf_danfe');
            $id = $danfe->montaDANFE();
            $pdf = $danfe->render();
            FilesFolders::saveFile('storage\companies\pdf_danfe', 'danfe40.pdf', $pdf);
            //o pdf porde ser exibido como view no browser
            //salvo em arquivo
            //ou setado para download forçado no browser
            //ou ainda gravado na base de dados
            //file_put_contents('storage\companies\pdf_danfe\danfe1.pdf',$pdf);
            header('Content-Type: application/pdf');
            return $pdf;
        } catch (InvalidArgumentException $e) {
            return "Ocorreu um erro durante o processamento :" . $e->getMessage();
        }
    }
}