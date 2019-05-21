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
            $table->string('chave_logix')->nullable();
            $table->date('data_geracao')->nullable();
            $table->string('depositante')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('tipo_estoque')->nullable();
            $table->string('desc_tipo_estoque')->nullable();
            $table->string('codigo_produto')->nullable();
            $table->string('desc_produto')->nullable();
            $table->string('unidade_medida')->nullable();
            $table->string('lote')->nullable();
            $table->date('data_validade')->nullable();
            $table->date('data_envio')->nullable();
            $table->string('serie_nf')->nullable();
            $table->string('nota_fiscal')->nullable();
            $table->string('nome_destino_final')->nullable();
            $table->string('pedido_venda')->nullable();
            $table->string('centro')->nullable();
            $table->string('numero_ordem')->nullable();
            $table->string('qtd_enviada')->nullable();
            $table->string('serie')->nullable();
            $table->string('peca')->nullable();
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
