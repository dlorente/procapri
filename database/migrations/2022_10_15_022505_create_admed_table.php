

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admed', function (Blueprint $table) {
            $table->increments('id');
            $table->date('addtinicio');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->smallint('coddoenca', 6);
            $table->smallint('mdcodigo', 6);
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
        Schema::dropIfExists('admed');
    }
}

