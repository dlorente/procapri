

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOcorreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ocorre', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('ocdata');
            $table->string('oc1', 55);
            $table->string('oc2', 55);
            $table->string('oc3', 55);
            $table->string('oc4', 55);
            $table->string('oc5', 55);
            $table->string('oc6', 55);
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
        Schema::dropIfExists('ocorre');
    }
}

