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
            $table->string('chave_logix')->nullable()->unique();
            $table->date('data_recebimento')->nullable();
            $table->date('data_geracao')->nullable();
            $table->string('depositante')->nullable();
            $table->string('razao_social')->nullable();
            $table->string('tipo_estoque')->nullable();
            $table->string('desc_tipo_estoque')->nullable();
            $table->string('cnpj_emissor_nfe')->nullable();
            $table->string('razao_social_fornecedor')->nullable();
            $table->string('codigo_produto')->nullable();
            $table->string('desc_produto')->nullable();
            $table->string('unidade_medida')->nullable();
            $table->string('lote')->nullable();
            $table->date('data_validade')->nullable();
            $table->string('serie_nf')->nullable();
            $table->string('tipo_nf')->nullable();
            $table->string('qtd_recebida')->nullable();
            $table->string('qtd_avariada')->nullable();
            $table->string('desc_restricao')->nullable();
            $table->string('serie')->nullable();
            $table->string('peca')->nullable();
            $table->string('qtd_fiscal')->nullable();
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
