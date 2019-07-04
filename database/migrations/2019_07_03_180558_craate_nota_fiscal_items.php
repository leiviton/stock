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
            $table->string('cProd');
            $table->string('xProd');
            $table->string('NCM');
            $table->string('CFOP');
            $table->string('uCom');
            $table->string('qCom');
            $table->string('vUnCom');
            $table->string('vProd');
            $table->string('uTrib');
            $table->string('qTrib');
            $table->string('vUnTrib');
            $table->string('indTot');
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
