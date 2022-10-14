

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCriadorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('criador', function (Blueprint $table) {
            $table->increments('id');
            $table->string('crcodigo', 5);
            $table->string('crnome', 50);
            $table->string('crprop', 40);
            $table->string('crfazenda', 40);
            $table->string('crendereco', 40);
            $table->string('crcep1', 9);
            $table->string('crmunic', 50);
            $table->string('crestado', 2);
            $table->string('crpostal', 5);
            $table->string('crfonef', 15);
            $table->string('crcorrespc', 40);
            $table->string('crbairroc', 50);
            $table->string('crcepc1', 9);
            $table->string('crcidadec', 50);
            $table->string('crestadoc', 2);
            $table->string('crfonec', 15);
            $table->string('crfaxc', 15);
            $table->string('crpostalc', 5);
            $table->string('crsufafixo', 1);
            $table->string('crconectiv', 5);
            $table->string('crsenha', 20);
            $table->date('crdtregistro');
            $table->date('crdtvalidade');
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
        Schema::dropIfExists('criador');
    }
}

