<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableRoads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_geracao');
            $table->string('depositante');
            $table->string('razao_social');
            $table->date('data_recibimento');
            $table->string('tipo_estoque');
            $table->string('desc_tipo_estoque');
            $table->string('cnpj_emissor_nfe');
            $table->string('razao_social_fornecedor');
            $table->string('codigo_produto');
            $table->string('desc_produto');
            $table->string('unidade_medida');
            $table->string('lote');
            $table->date('data_validade');
            $table->string('serie_nf');
            $table->string('tipo_nf');
            $table->string('qtd_recebida');
            $table->string('qtd_avariada');
            $table->string('desc_restricao');
            $table->string('serie');
            $table->string('peca');
            $table->string('qtd_fiscal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roads');
    }
}
