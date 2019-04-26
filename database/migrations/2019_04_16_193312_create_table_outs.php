<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableOuts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_geracao');
            $table->string('depositante');
            $table->string('razao_social');
            $table->string('tipo_estoque');
            $table->string('desc_tipo_estoque');
            $table->string('codigo_produto');
            $table->string('desc_produto');
            $table->string('unidade_medida');
            $table->string('lote');
            $table->date('data_validade');
            $table->date('data_envio');
            $table->string('serie_nf');
            $table->string('nota_fiscal');
            $table->string('nome_destino_final');
            $table->string('pedido_venda');
            $table->string('centro');
            $table->string('numero_ordem');
            $table->string('qtd_enviada');
            $table->string('serie');
            $table->string('peca');
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
        Schema::dropIfExists('outs');
    }
}
