

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemusoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semuso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('criador_id');
            $table->smallint('l3codigo', 6)->default('0');
            $table->string('crcodigo', 5);
            $table->string('l3nome', 50);
            $table->timestamps();
            $table->index(["criador_id"]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('semuso');
    }
}

