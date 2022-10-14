

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parto', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('padatapar');
            $table->smallint('paordem', 6);
            $table->smallint('pacodigo', 6);
            $table->smallint('panucrias', 6);
            $table->string('panubode', 12);
            $table->date('padultcob');
            $table->string('cobcodigo', 1);
            $table->string('ciocodigo', 1);
            $table->smallint('panciocob', 6);
            $table->smallint('pancioncob', 6);
            $table->date('padenclac');
            $table->smallint('eccodigo', 6);
            $table->decimal('paprtolei', 10, 2);
            $table->decimal('patprotei', 10, 2);
            $table->decimal('patgordura', 10, 2);
            $table->decimal('paextseco', 10, 2);
            $table->decimal('paprmaxima', 10, 2);
            $table->decimal('paprminima', 10, 2);
            $table->timestamps();
            $table->index(["animal_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('parto');
    }
}

