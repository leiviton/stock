<?php

namespace Stock\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class TravelRoute.
 *
 * @package namespace Stock\Models;
 */
class TravelRouteEx extends \Stock\Models\Base\TravelRouteEx implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "ROTA",
        "PARADA",
        "DATA_ROTA",
        "TIPO",
        "NUMERO",
        "SERIE",
        "EMISSAO",
        "CLIENTE",
        "CONTATO",
        "TELEFONE",
        "EMAIL",
        "CLIENTE_RAZAO",
        "ENDERECO",
        "BAIRRO",
        "CEP",
        "CIDADE",
        "ESTADO",
        "PAIS",
        "TRANSPORTADORA",
        "TRANSP_RAZAO",
        "PESO_BRUTO",
        "PESO_LIQUIDO",
        "VOLUMES",
        "SKU",
        "SKU_DESCRICAO",
        "QDE",
        "UOM",
        "BARCODE",
        "TIPO_PARADA",
        "MENSAGEM",
        "CHAVE_NOTA",
        "MODELO_DOC",
        "CNPJ_CLIENTE",
        "REGIAO",
        "MOTORISTA",
        "PLACA",
        "VALOR NOTA",
        "BASE_ORIG_COD",
        "BASE_ORIG_NOME",
        "BASE_ORIG_RUA",
        "BASE_ORIG_NUMERO",
        "BASE_ORIG_COMPL",
        "BASE_ORIG_BAIRRO",
        "BASE_ORIG_CIDADE",
        "BASE_ORIG_ESTADO",
        "BASE_ORIG_CEP",
        "BASE_ORIG_PAIS",
        "BASE_DEST_COD",
        "BASE_DEST_NOME",
        "BASE_DEST_RUA",
        "BASE_DEST_NUMERO",
        "BASE_DEST_COMPL",
        "BASE_DEST_BAIRRO",
        "BASE_DEST_CIDADE",
        "BASE_DEST_ESTADO",
        "BASE_DEST_CEP",
        "BASE_DEST_PAIS",
        "CNPJ_EMBARCADOR"
    ];

}
