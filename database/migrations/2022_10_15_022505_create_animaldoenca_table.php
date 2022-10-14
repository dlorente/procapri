

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimaldoencaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animaldoenca', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->integer('doenca_id');
            $table->date('addtinicio');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->smallint('coddoenca', 6);
            $table->text('adobs');
            $table->smallint('facodigo', 6);
            $table->timestamps();
            $table->index(["doenca_id"]);
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
        Schema::dropIfExists('animaldoenca');
    }
}

