<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfigurationFiscal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configuration_fiscal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('serie_nf')->nullable();
            $table->string('senha_certificado')->nullable();
            $table->string('certificado')->nullable();
            $table->integer('ultima_nota')->nullable()->default(1);
            $table->string('logradouro')->nullable();
            $table->string('numero')->nullable();
            $table->string('bairro')->nullable();
            $table->string('cep')->nullable();
            $table->string('cidade')->nullable();
            $table->string('codigo_cidade')->nullable();
            $table->string('estado')->nullable();
            $table->string('codigo_estado')->nullable();
            $table->timestamps();
        });

        Schema::table('companies', function (Blueprint $table) {
            $table ->integer('configuration_fiscal_id')->unsigned()->nullable()->after('id');
            $table->foreign('configuration_fiscal_id')->references('id')->on('configuration_fiscal')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configuration_fiscal');
    }
}
