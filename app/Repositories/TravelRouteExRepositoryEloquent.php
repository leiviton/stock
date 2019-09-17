<?php

namespace Stock\Repositories;

use Illuminate\Support\Facades\DB;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Stock\Models\TravelRouteEx;

/**
 * Class TravelRouteExRepositoryEloquent.
 *
 * @package namespace Stock\Repositories;
 */
class TravelRouteExRepositoryEloquent extends BaseRepository implements TravelRouteExRepository
{
    protected $skipPresenter = true;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return TravelRouteEx::class;
    }


    /**
     * Boot up the repository, pushing criteria
     * @throws \Prettus\Repository\Exceptions\RepositoryException
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @param $dataStart
     * @param $dataEnd
     * @return mixed
     */
    public function getQueryUser($dataStart, $dataEnd)
    {
        $query = $this->model->select(DB::raw('ROTA,
        CAST(ROW_NUMBER() OVER (PARTITION BY ROTA, DATA_ROTA ORDER BY NUMERO) AS VARCHAR(03)) AS [PARADA],
        DATA_ROTA,
        TIPO,
        NUMERO,
        SERIE,
        EMISSAO,
        CLIENTE,
        CONTATO,
        TELEFONE,
        EMAIL,
        CLIENTE_RAZAO,
        ENDERECO,
        BAIRRO,
        CEP,
        CIDADE,
        ESTADO,
        PAIS,
        TRANSPORTADORA,
        TRANSP_RAZAO,
        PESO_BRUTO,
        PESO_LIQUIDO,
        VOLUMES,
        SKU,
        SKU_DESCRICAO,
        QDE,
        UOM,
        BARCODE,
        TIPO_PARADA,
        MENSAGEM,
        CHAVE_NOTA,
        MODELO_DOC,
        CNPJ_CLIENTE,
        REGIAO,
        MOTORISTA,
        PLACA,
        VALOR_NOTA,
        BASE_ORIG_COD,
        BASE_ORIG_NOME,
        BASE_ORIG_RUA,
        BASE_ORIG_NUMERO,
        BASE_ORIG_COMPL,
        BASE_ORIG_BAIRRO,
        BASE_ORIG_CIDADE,
        BASE_ORIG_ESTADO,
        BASE_ORIG_CEP,
        BASE_ORIG_PAIS,
        BASE_DEST_COD,
        BASE_DEST_NOME,
        BASE_DEST_RUA,
        BASE_DEST_NUMERO,
        BASE_DEST_COMPL,
        BASE_DEST_BAIRRO,
        BASE_DEST_CIDADE,
        BASE_DEST_ESTADO,
        BASE_DEST_CEP,
        BASE_DEST_PAIS,
        CNPJ_EMBARCADOR'))->where(function ($query) use ($dataStart, $dataEnd) {
            return $query->whereRaw('DATA_ROTA BETWEEN ? AND ?',
                [$dataStart, $dataEnd]);
        })->get();

        return $query;
    }

    /**
     * @param $now
     * @return mixed
     * @throws \Exception
     */
    public function getAgent($now)
    {
        return $this->model->select(DB::raw('ROTA,
        CAST(ROW_NUMBER() OVER (PARTITION BY ROTA, DATA_ROTA ORDER BY NUMERO) AS VARCHAR(03)) AS [PARADA],
        DATA_ROTA,
        TIPO,
        NUMERO,
        SERIE,
        EMISSAO,
        CLIENTE,
        CONTATO,
        TELEFONE,
        EMAIL,
        CLIENTE_RAZAO,
        ENDERECO,
        BAIRRO,
        CEP,
        CIDADE,
        ESTADO,
        PAIS,
        TRANSPORTADORA,
        TRANSP_RAZAO,
        PESO_BRUTO,
        PESO_LIQUIDO,
        VOLUMES,
        SKU,
        SKU_DESCRICAO,
        QDE,
        UOM,
        BARCODE,
        TIPO_PARADA,
        MENSAGEM,
        CHAVE_NOTA,
        MODELO_DOC,
        CNPJ_CLIENTE,
        REGIAO,
        MOTORISTA,
        PLACA,
        VALOR_NOTA,
        BASE_ORIG_COD,
        BASE_ORIG_NOME,
        BASE_ORIG_RUA,
        BASE_ORIG_NUMERO,
        BASE_ORIG_COMPL,
        BASE_ORIG_BAIRRO,
        BASE_ORIG_CIDADE,
        BASE_ORIG_ESTADO,
        BASE_ORIG_CEP,
        BASE_ORIG_PAIS,
        BASE_DEST_COD,
        BASE_DEST_NOME,
        BASE_DEST_RUA,
        BASE_DEST_NUMERO,
        BASE_DEST_COMPL,
        BASE_DEST_BAIRRO,
        BASE_DEST_CIDADE,
        BASE_DEST_ESTADO,
        BASE_DEST_CEP,
        BASE_DEST_PAIS,
        CNPJ_EMBARCADOR'))->where('DATA_ROTA', $now)->paginate();
    }
}
