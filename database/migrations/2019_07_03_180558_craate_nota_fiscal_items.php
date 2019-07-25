<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CraateNotaFiscalItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscal_items', function (Blueprint $table) {
            $table->increments('id');
            $table->string('cEAN')->nullable();
            $table->string('cEANTrib')->nullable();
            $table->string('cProd')->nullable();
            $table->string('xProd')->nullable();
            $table->string('NCM')->nullable();
            $table->string('CFOP')->nullable();
            $table->string('uCom')->nullable();
            $table->string('qCom')->nullable();
            $table->string('vUnCom')->nullable();
            $table->string('vProd')->nullable();
            $table->string('uTrib')->nullable();
            $table->string('qTrib')->nullable();
            $table->string('vUnTrib')->nullable();
            $table->string('indTot')->nullable();
            $table->string('orig')->nullable();
            $table->string('CST')->nullable();
            $table->string('modBC')->nullable();
            $table->string('vBC')->nullable();
            $table->string('pICMS')->nullable();
            $table->string('vICMS')->nullable();
            $table->string('cEnq')->nullable();
            $table->string('CSTIPI')->nullable();
            $table->string('vIPI')->nullable();
            $table->string('vBCIPI')->nullable();
            $table->string('pIPI')->nullable();
            $table->string('CSTPIS')->nullable();
            $table->string('vBCPIS')->nullable();
            $table->string('pPIS')->nullable();
            $table->string('vPIS')->nullable();
            $table->string('CSTCOFINS')->nullable();
            $table->string('vBCOFINS')->nullable();
            $table->string('pCOFINS')->nullable();
            $table->string('vCOFINS')->nullable();
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
        Schema::dropIfExists('nota_fiscal_items');
    }
}
