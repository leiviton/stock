<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdNotaItems extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nota_fiscal_items', function (Blueprint $table) {
            $table ->integer('nota_id')->unsigned()->nullable()->after('id');
            $table->foreign('nota_id')->references('id')->on('nota_fiscal');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nota_fiscal_items', function (Blueprint $table) {
            $table ->dropColumn('nota_id');
            $table->dropForeign('nota_id');
        });
    }
}
