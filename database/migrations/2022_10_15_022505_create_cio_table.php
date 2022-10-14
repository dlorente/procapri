

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cio', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('cidata');
            $table->string('ciocodigo', 1);
            $table->date('cicobertu');
            $table->string('cobcodigo', 1);
            $table->decimal('cidose', 10, 0);
            $table->string('cinanimal', 12);
            $table->date('cidatapre');
            $table->string('ciresulta', 1);
            $table->date('cidataprefinal');
            $table->smallint('citempoprovgest', 6);
            $table->smallint('cinumfetosgest', 6);
            $table->date('cidtdiagnosticogest');
            $table->smallint('exgcodigo', 6);
            $table->smallint('tmcodigo', 6);
            $table->string('cpcodigo', 1);
            $table->string('ciflag', 1);
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
        Schema::dropIfExists('cio');
    }
}

