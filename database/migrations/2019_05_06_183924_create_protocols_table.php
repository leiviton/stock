<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProtocolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('protocols', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tip_estoque')->nullable();
            $table->string('abrang')->nullable();
            $table->string('empresa_deposit')->nullable();
            $table->string('des_tip_estoque')->nullable();
            $table->string('des_reduz_tip_estoque')->nullable();
            $table->string('padrao')->nullable();
            $table->smallInteger('sit_registro')->nullable();
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
        Schema::dropIfExists('protocols');
    }
}
