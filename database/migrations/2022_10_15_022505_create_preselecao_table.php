

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePreselecaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('preselecao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->string('annome', 50);
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
        Schema::dropIfExists('preselecao');
    }
}

