

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePesoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peso', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('animal_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('pedatapes');
            $table->decimal('pepeso', 10, 2);
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
        Schema::dropIfExists('peso');
    }
}

