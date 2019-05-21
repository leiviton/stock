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
            $table->string('chave_logix')->nullable();
            $table->date('data_geracao')->nullable();
            $table->string('depositante',20)->index();
            $table->string('cnpj_origem')->nullable();
            $table->date('data_atual')->nullable();
            $table->string('hora_atual')->nullable();
            $table->string('tipo_estoque')->nullable();
            $table->string('desc_tipo_estoque')->nullable();
            $table->string('codigo_produto')->nullable();
            $table->string('desc_produto')->nullable();
            $table->string('unidade_medida')->nullable();
            $table->string('lote')->nullable();
            $table->date('data_validade')->nullable();
            $table->string('desc_restricao')->nullable();
            $table->bigInteger('qtd_produto')->nullable();
            $table->bigInteger('qtd_regul_reser')->nullable();
            $table->bigInteger('qtd_fiscal')->nullable();
            $table->bigInteger('qtd_avariada')->nullable();
            $table->string('avaria')->nullable();
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
