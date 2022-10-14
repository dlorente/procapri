

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGrausangueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grausangue', function (Blueprint $table) {
            $table->increments('id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->smallint('racodigo', 6);
            $table->decimal('gsaporcsangue', 10, 0)->default('0');
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
        Schema::dropIfExists('grausangue');
    }
}

