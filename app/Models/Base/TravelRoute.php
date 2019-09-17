<?php

/**
 * Created by Reliese Model.
 * Date: Fri, 13 Sep 2019 16:13:34 -0300.
 */

namespace Stock\Models\Base;

use Reliese\Database\Eloquent\Model as Eloquent;

/**
 * Class TravelRoute
 * 
 * @property int $id
 * @property string $ROTA
 * @property string $PARADA
 * @property string $DATA_ROTA
 * @property string $TIPO
 * @property string $NUMERO
 * @property string $SERIE
 * @property string $EMISSAO
 * @property string $CLIENTE
 * @property string $CONTATO
 * @property string $TELEFONE
 * @property string $EMAIL
 * @property string $CLIENTE_RAZAO
 * @property string $ENDERECO
 * @property string $BAIRRO
 * @property string $CEP
 * @property string $CIDADE
 * @property string $ESTADO
 * @property string $PAIS
 * @property string $TRANSPORTADORA
 * @property string $TRANSP_RAZAO
 * @property string $PESO BRUTO
 * @property string $PESO_LIQUIDO
 * @property string $VOLUMES
 * @property string $SKU
 * @property string $SKU_DESCRICAO
 * @property string $QDE
 * @property string $UOM
 * @property string $BARCODE
 * @property string $TIPO_PARADA
 * @property string $MENSAGEM
 * @property string $CHAVE NOTA
 * @property string $MODELO DOC
 * @property string $CNPJ CLIENTE
 * @property string $REGIAO
 * @property string $MOTORISTA
 * @property string $PLACA
 * @property string $VALOR NOTA
 * @property string $BASE_ORIG_COD
 * @property string $BASE_ORIG_NOME
 * @property string $BASE_ORIG_RUA
 * @property string $BASE_ORIG_NUMERO
 * @property string $BASE_ORIG_COMPL
 * @property string $BASE_ORIG_BAIRRO
 * @property string $BASE_ORIG_CIDADE
 * @property string $BASE_ORIG_ESTADO
 * @property string $BASE_ORIG_CEP
 * @property string $BASE_ORIG_PAIS
 * @property string $BASE_DEST_COD
 * @property string $BASE_DEST_NOME
 * @property string $BASE_DEST_RUA
 * @property string $BASE_DEST_NUMERO
 * @property string $BASE_DEST_COMPL
 * @property string $BASE_DEST_BAIRRO
 * @property string $BASE_DEST_CIDADE
 * @property string $BASE_DEST_ESTADO
 * @property string $BASE_DEST_CEP
 * @property string $BASE_DEST_PAIS
 * @property string $CNPJ_EMBARCADOR
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 *
 * @package Stock\Models\Base
 */
class TravelRoute extends Eloquent
{
    protected $connection = 'sqlsrvcomprovei';

    protected $table = 'ComproveiDrs';
}
