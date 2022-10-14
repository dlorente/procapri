

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSemenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('semen', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('smsequencia');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('smdata');
            $table->smallint('smindice', 6)->default('0');
            $table->string('smnfiscal', 50);
            $table->smallint('smndose', 6)->default('0');
            $table->decimal('smpreco', 10, 0)->default('0');
            $table->smallint('smfinal', 6)->default('0');
            $table->string('smobs', 255);
            $table->smallint('flcodigo', 6);
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
        Schema::dropIfExists('semen');
    }
}

