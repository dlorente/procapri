

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoencaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doenca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('agente_id');
            $table->smallint('coddoenca', 6);
            $table->string('nomedoenca', 100);
            $table->smallint('agcodigo', 6);
            $table->timestamps();
            $table->index(["agente_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doenca');
    }
}

