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
use Stock\Repositories\CompanyRepository;
use Stock\Repositories\NotaFiscalRepository;
use Symfony\Component\Console\Output\NullOutput;


class NFeService
{
    /**
     * @var NotaFiscalRepository
     */
    private $repository;
    /**
     * @var CompanyRepository
     */
    private $companyRepository;

    /**
     * NFeService constructor.
     * @param NotaFiscalRepository $repository
     * @param CompanyRepository $companyRepository
     */
    public function __construct(NotaFiscalRepository $repository, CompanyRepository $companyRepository)
    {
        $this->repository = $repository;
        $this->companyRepository = $companyRepository;
    }

    /**
     *
     */
    public function emitirNfe()
    {
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
        } else if ($std->cStat == '105') { //lote em processamento
            //tente novamente mais tarde
            return "lote ainda em processo";
        } else if ($std->cStat == '104') { //lote processado (tudo ok)
            if ($std->protNFe->infProt->cStat == '100') { //Autorizado o uso da NF-e
                $xmlOriginal = file_get_contents('storage\companies\xml_gerados\40.xml');
                $xml = Complements::toAuthorize($xmlOriginal, $xmlRetorno);
                file_put_contents("storage/companies/xml_autorizados/40.xml", $xml);
                return response()->json(["situacao" => "autorizada",
                    "numeroProtocolo" => $std->protNFe->infProt->nProt,
                    "xmlProtocolo" => $xmlRetorno]);
            } else if (in_array($std->protNFe->infProt->cStat, ["302"])) { //DENEGADAS
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

    public function geraDanfe($nf)
    {
        $xml = "storage/companies/xml_autorizados/$nf.xml";
        $docxml = FilesFolders::readFile($xml);
        $logo = 'data://text/plain;base64,' . base64_encode(file_get_contents('storage/companies/suportemed/logo.jpg'));
        try {
            $danfe = new Danfe($docxml, 'P', 'A4', $logo, 'I', 'storage/companies/pdf_danfe');
            $id = $danfe->montaDANFE();
            $pdf = $danfe->render();
            FilesFolders::saveFile("storage\companies\pdf_danfe", "$nf.pdf", $pdf);
            //o pdf porde ser exibido como view no browser
            //salvo em arquivo
            //ou setado para download forçado no browser
            //ou ainda gravado na base de dados
            //file_put_contents('storage\companies\pdf_danfe\danfe1.pdf',$pdf);
            return env('APP_URL')."storage/companies/pdf_danfe/$nf.pdf";
        } catch (InvalidArgumentException $e) {
            return "Ocorreu um erro durante o processamento :" . $e->getMessage();
        }
    }

    /**
     * @param $status
     * @return mixed
     */
    public function listNfe($status)
    {
        return $this->repository
            ->skipPresenter(false)
            ->scopeQuery(function ($query)use($status){
                return $query->where('status',$status);
            })->paginate(20);
    }

    /**
     * @param $idEmitente
     * @param $idNota
     * @return bool
     * @throws \Exception
     */
    public function gerarNfe($idNota): bool {

        $nota = $this->repository->find($idNota);

        $emitente = $this->companyRepository->find($nota->company_id);

        $items = $nota->nota_fiscal_items();
        /*variavies totalizadores*/
        $vBC = 0.0;
        $vICMS = 0.00;
        $vICMSDeson = 0.00;
        $vBCST = 0.00;
        $vST = 0.00;
        $vProd = 0.00;
        $vFrete = 0.00;
        $vSeg = 0.00;
        $vDesc = 0.00;
        $vII = 0.00;
        $vIPI = 0.00;
        $vPIS = 0.00;
        $vCOFINS = 0.00;
        $vOutro = 0.00;
        $vTotTrib = 0.00;

        $nfe = new Make();
        $std = new \stdClass();
        $std->versao = '4.00';
        $std->Id = null;
        $std->pk_nItem = '';
        $nfe->taginfNFe($std);

        $nf = $emitente->configuration_fiscal()->ultima_nota + 1;

        $std = new \stdClass();
        $std->cUF = $this->state($emitente->configuration_fiscal()->estado); //coloque um código real e válido
        $std->cNF = random_int(1,9);
        $std->natOp = 'VENDA';
        $std->mod = 55;
        $std->serie = $emitente->configuration_fiscal()->serie_nf;
        $std->nNF = $nf;
        $std->dhEmi = date("Y-m-d\TH:i:sP");
        $std->dhSaiEnt = date("Y-m-d\TH:i:sP");
        $std->tpNF = 1;
        $std->idDest = 2;
        $std->cMunFG = $emitente->configuration_fiscal()->codigo_cidade; //Código de município precisa ser válido
        $std->tpImp = 1;
        $std->tpEmis = 1;
        $std->cDV = random_int(1,9);
        $std->tpAmb = 2; // Se deixar o tpAmb como 2 você emitirá a nota em ambiente de homologação(teste) e as notas fiscais aqui não tem valor fiscal
        $std->finNFe = 1;
        $std->indFinal = 0;
        $std->indPres = 9;
        $std->procEmi = '0';
        $std->verProc = 1;
        $nfe->tagide($std);

        $std = new \stdClass();
        $std->xNome = $emitente->nome;
        $std->IE = '675189081113';
        $std->CRT = 3;
        $std->CNPJ = '11957717000142';
        $nfe->tagemit($std);

        $std = new \stdClass();
        $std->xLgr = $emitente->configuration_fiscal()->logradouro;
        $std->nro = $emitente->configuration_fiscal()->numero;
        $std->xBairro = $emitente->configuration_fiscal()->bairro;
        $std->cMun = $emitente->configuration_fiscal()->codigo_cidade; //Código de município precisa ser válido e igual o  cMunFG
        $std->xMun = $emitente->configuration_fiscal()->cidade;
        $std->UF = $emitente->configuration_fiscal()->estado;
        $std->CEP = $emitente->configuration_fiscal()->cep;
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $nfe->tagenderEmit($std);

        $std = new \stdClass();
        $std->xNome = $nota->xNome;
        $std->indIEDest = $nota->indIEDest;
        if($nota->type_person == 'PJ') {
            $std->IE = $nota->IE;
            $std->CNPJ = $nota->CNPJ;
        }else if($nota->type_person == 'PF') {
            $std->CPF = $nota->CNPJ;
        }

        $nfe->tagdest($std);

        $std = new \stdClass();
        $std->xLgr = $nota->xLgr;
        $std->nro = $nota->nro;
        $std->xBairro = $nota->xBairro;
        $std->cMun = $nota->cMun;
        $std->xMun = $nota->xMun;
        $std->UF = $nota->UF;
        $std->CEP = $nota->CEP;
        $std->cPais = '1058';
        $std->xPais = 'BRASIL';
        $nfe->tagenderDest($std);
        $total = 0.00;

        //for ($i = 1; $i < 60; $i++) {
        foreach ($items as $item) {
            $std = new \stdClass();
            $std->item = $item->id;
            $std->cEAN = $item->cEan;
            $std->cEANTrib = $item->cEANTrib;
            $std->cProd = $item->cProd;
            $std->xProd = $item->xProd;
            $std->NCM = $item->NCM;
            $std->CFOP = $item->CFOP;
            $std->uCom = $item->uCom;
            $std->qCom = $item->qCom;
            $std->vUnCom = $item->vUnCom;
            $std->vProd = $item->vProd;
            $std->uTrib = $item->uTrib;
            $std->qTrib = $item->qTrib;
            $std->vUnTrib = $item->vUnTrib;
            $std->indTot = 1;
            $total += (float) ($item->vUnTrib * $item->qTrib);
            $nfe->tagprod($std);

            $std = new \stdClass();
            $std->item = $item->id;
            $std->vTotTrib = (float) ($item->vUnTrib * $item->qTrib);
            $nfe->tagimposto($std);

            /*ICMS*/
            $std = new \stdClass();
            $std->item = $item->id;
            $std->orig = $item->orig;
            $std->CST = $item->CST;
            $std->modBC = $item->modBC;
            $std->vBC = $item->vBC;
            $std->pICMS = $item->pICMS;
            $std->vICMS = $item->vICMS;
            $nfe->tagICMS($std);

            /*IPI*/
            $std = new \stdClass();
            $std->item = $item->id;
            $std->cEnq = $item->cEnq;
            $std->CST = $item->CSTIPI;
            $std->vIPI = $item->vIPI;
            $std->vBC = $item->vBCIPI;
            $std->pIPI = $item->pIPI;
            $nfe->tagIPI($std);

            /*PIS*/
            $std = new \stdClass();
            $std->item = $item->id;
            $std->CST = $item->CST;
            $std->vBC = $item->vBCPIS;
            $std->pPIS = $item->pPIS;
            $std->vPIS = $item->vPIS;
            $nfe->tagPIS($std);

            /*COFINS*/
            $std = new \stdClass();
            $std->item = $item->id;
            $std->vCOFINS = $item->vCOFINS;
            $std->vBC = $item->vBCCIFINS;
            $std->pCOFINS = $item->pCOFINS;
            $nfe->tagCOFINSST($std);

            /*COFINS*/
            $std = new \stdClass();
            $std->item = $item->id;
            $std->CST = $item->CSTCOFINS;
            $std->vBC = $item->vBCCOFINS;
            $std->pCOFINS = $item->pCOFINS;
            $std->vCOFINS = $item->vCOFINS;
            $nfe->tagCOFINS($std);

            $vBC += $item->vBC;
            $vICMS += $item->vICMS;
            $vICMSDeson += $item->vICMSDeson;
            $vBCST += $item->vBCST;
            $vST += $item->vST;
            $vProd += $item->vProd;
            $vFrete += $item->vFrete;
            $vSeg += $item->vSeg;
            $vDesc += $item->vDesc;
            $vII += $item->vII;
            $vIPI += $item->vIPI;
            $vPIS += $item->PIS;
            $vCOFINS += $item->vCOFINS;
            $vOutro += $item->vOutro;
            $vTotTrib += $item->vTotTrib;
        }

        $std = new \stdClass();
        $std->vBC = $vBC;
        $std->vICMS = $vICMS;
        $std->vICMSDeson = $vICMSDeson;
        $std->vBCST = $vBCST;
        $std->vST = $vST;
        $std->vProd = $vProd;
        $std->vFrete = $vFrete;
        $std->vSeg = $vSeg;
        $std->vDesc = $vDesc;
        $std->vII = $vII;
        $std->vIPI = $vIPI;
        $std->vPIS = $vPIS;
        $std->vCOFINS = $vCOFINS;
        $std->vOutro = $vOutro;
        $std->vNF = $vProd;
        $std->vTotTrib = $vTotTrib;
        $nfe->tagICMSTot($std);


        $std = new \stdClass();
        $std->modFrete = 9;
        $nfe->tagtransp($std);

        $std = new \stdClass();
        $std->tPag = 90;
        $std->vPag = 0.00;
        $nfe->tagdetPag($std);

        $xml = $nfe->getXML(); // O conteúdo do XML fica armazenado na variável $xml

        $config = [
            "atualizacao" => date('Y-m-d h:i:s'),
            "tpAmb" => 2,
            "razaosocial" => $emitente->nome,
            "cnpj" => $emitente->cnpj, // PRECISA SER VÁLIDO
            "ie" => '675189081113', // PRECISA SER VÁLIDO
            "siglaUF" => $emitente->configuration_fiscal->estado,
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

        $certificadoDigital = file_get_contents($emitente->configuration_fiscal->certificado);

        $tools = new Tools($configJson, Certificate::readPfx($certificadoDigital, $emitente->configuration_fiscal->senha_certificado));
        try {
            $xmlAssinado = $tools->signNFe($xml); // O conteúdo do XML assinado fica armazenado na variável $xmlAssinado
            $idLote = $nf;
            $resp = $tools->sefazEnviaLote([$xmlAssinado], $idLote);

            $st = new Standardize();
            $std = $st->toStd($resp);
            if ($std->cStat != 103) {
                exit("[$std->cStat] $std->xMotivo");
            }

            $recibo = $std->infRec->nRec; // Vamos usar a variável $recibo para consultar o status da nota

            file_put_contents("storage/companies/xml_gerados/$nf.xml", $xmlAssinado);

            $nota->recibo_sefaz = $recibo;
            $nota->save();

            $this->consultaProtocolo($recibo);

            return 'NFE enviada';
            //return $protocolo;
        } catch (\Exception $e) {
            //aqui você trata possíveis exceptions da assinatura
            exit($e->getMessage());
        }
    }

    public function state($uf) {
        switch ($uf) {
            case 'RO':
                return 11;
                break;
            case 'AC':
                return 12;
                break;
            case 'AM':
                return 13;
                break;
            case 'RR':
                return 14;
                break;
            case 'PA':
                return 15;
                break;
            case 'AP':
                return 16;
                break;
            case 'TO':
                return 17;
                break;
            case 'MA':
                return 21;
                break;
            case 'PI':
                return 22;
                break;
            case 'CE':
                return 23;
                break;
            case 'RN':
                return 24;
                break;
            case 'PB':
                return 25;
                break;
            case 'PE':
                return 26;
                break;
            case 'AL':
                return 27;
                break;
            case 'SE':
                return 28;
                break;
            case 'BA':
                return 29;
                break;
            case 'MG':
                return 31;
                break;
            case 'ES':
                return 32;
                break;
            case 'RJ':
                return 33;
                break;
            case 'SP':
                return 35;
                break;
            case 'PR':
                return 41;
                break;
            case 'SC':
                return 42;
                break;
            case 'RS':
                return 43;
                break;
            case 'MS':
                return 50;
                break;
            case 'MT':
                return 51;
                break;
            case 'GO':
                return 52;
                break;
            case 'DF':
                return 53;
                break;
            default:
                return false;
        }
    }
}