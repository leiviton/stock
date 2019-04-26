<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompanyIdTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table ->integer('company_id')->unsigned()->nullable()->after('id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table ->integer('company_id')->unsigned()->nullable()->after('id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });

        Schema::table('outs', function (Blueprint $table) {
            $table ->integer('company_id')->unsigned()->nullable()->after('id');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('roads', function (Blueprint $table) {
            $table ->dropColumn('company_id')->unsigned()->nullable();
            $table->dropForeign('company_id');
        });

        Schema::table('outs', function (Blueprint $table) {
            $table ->dropColumn('company_id')->unsigned()->nullable();
            $table->dropForeign('company_id');
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table ->dropColumn('company_id')->unsigned()->nullable();
            $table->dropForeign('company_id');
        });
    }
}
