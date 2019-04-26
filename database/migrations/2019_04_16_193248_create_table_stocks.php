<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableStocks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('data_geracao');
            $table->string('depositante',20)->index();
            $table->string('cnpj_origem');
            $table->date('data_atual');
            $table->string('hora_atual');
            $table->string('tipo_estoque');
            $table->string('desc_tipo_estoque');
            $table->string('codigo_produto');
            $table->string('desc_produto');
            $table->string('unidade_medida');
            $table->string('lote');
            $table->date('data_validade');
            $table->string('desc_restricao');
            $table->bigInteger('qtd_produto');
            $table->bigInteger('qtd_regul_reser');
            $table->bigInteger('qtd_fiscal');
            $table->bigInteger('qtd_avariada');
            $table->string('avaria');
            $table->string('peca')->nullable();
            $table->string('serie')->nullable();
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
        Schema::dropIfExists('stocks');
    }
}
