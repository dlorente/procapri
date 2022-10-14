

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProducaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('producao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->integer('ocolact_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('prdatacon');
            $table->decimal('prplord1', 10, 2);
            $table->decimal('prplord2', 10, 2);
            $table->decimal('prplord3', 10, 2);
            $table->smallint('olcodigo', 6);
            $table->decimal('prgordura', 10, 2);
            $table->decimal('prproteina', 10, 2);
            $table->decimal('prextseco', 10, 2);
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
        Schema::dropIfExists('producao');
    }
}

