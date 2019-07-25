<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_fiscal', function (Blueprint $table) {
            $table->increments('id');
            $table ->integer('company_id')->unsigned()->nullable();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->bigInteger('nNF');
            $table->string('tpNF');
            $table->string('idDest')->default(2);
            $table->string('cMunFG');
            $table->string('tpImp')->default(1);
            $table->string('cDv')->default(2);
            $table->enum('finNFe',[1,2,3,4])->default(1);
            $table->enum('indFinal',[0,1])->default(0);
            /*
                0 = Não se aplica (por exemplo, Nota Fiscal complementar ou de ajuste);
                1 = Operação presencial;
                2 = Operação não presencial, pela Internet;
                3 = Operação não presencial, Teleatendimento;
                4 = NFC-e em operação com entrega a domicílio;
                5 = Operação presencial, fora do estabelecimento;
                9 = Operação não presencial, outros.
            */
            $table->enum('indPres',[0,1,2,3,4,5,9])->default(0);
            $table->string('procEmi')->default(0);
            $table->string('verProc')->default(1);
            $table->string('xNome');
            $table->string('indIEDest');
            $table->string('IE');
            $table->string('CNPJ');
            /*endDest*/
            $table->string('xLgr');
            $table->string('nro');
            $table->string('xBairro');
            $table->string('cMun');
            $table->string('xMun');
            $table->string('UF');
            $table->string('CEP');
            $table->string('cPais')->default('1058');
            $table->string('xPais')->default('BRASIL');
            /*totalizadores*/
            $table->float('vBC');
            $table->float('vICMS',20,2);
            $table->float('vICMSDeson',20,2);
            $table->float('vBCST',20,2);
            $table->float('vST',20,2);
            $table->float('vProd',20,2);
            $table->float('vFrete',20,2);
            $table->float('vSeg',20,2);
            $table->float('vDesc',20,2);
            $table->float('vII',20,2);
            $table->float('vIPI',20,2);
            $table->float('vPIS',20,2);
            $table->float('vCOFINS',20,2);
            $table->float('vOutro',20,2);
            $table->float('vNF',20,2);
            $table->float('vTotTrib',20,2);
            $table->enum('status',['autorizada','processando','processada','cancelada','inutilizada','gerada'])->default('gerada');
            $table->timestamps();
        });

        Schema::table('configuration_fiscal', function (Blueprint $table) {
            $table->integer('tpAmb')->default(2)->after('codigo_estado');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nota_fiscal');
    }
}
