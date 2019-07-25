<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypePersonNota extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nota_fiscal', function (Blueprint $table) {
            $table->enum('type_person',['PF','PJ','EX'])->default('PF')->after('xNome');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nota_fiscal', function (Blueprint $table) {
            $table->dropColumn('type_person');
        });
    }
}
