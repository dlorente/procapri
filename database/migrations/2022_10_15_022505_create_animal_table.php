

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnimalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('animal', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('criador_id');
            $table->string('anregistro', 12);
            $table->string('crcodigo', 5);
            $table->string('ananimal', 6);
            $table->string('irgcodigo', 1);
            $table->smallint('anpontua', 6);
            $table->string('annome', 50);
            $table->string('anregpai', 12);
            $table->string('anomepai', 50);
            $table->string('anregmae', 12);
            $table->string('anomemae', 50);
            $table->date('andnasc');
            $table->smallint('sacodigo', 6);
            $table->string('sxcodigo', 1);
            $table->smallint('pecodigo', 6);
            $table->string('corcodigo', 1);
            $table->string('bacodigo', 1);
            $table->string('brcodigo', 1);
            $table->string('fnlcodigo', 2);
            $table->date('andesmama');
            $table->date('andcoberta');
            $table->date('anentrada');
            $table->smallint('encodigo', 6);
            $table->date('andatasai');
            $table->smallint('mscodigo', 6);
            $table->smallint('cscodigo', 6);
            $table->string('anorigem', 255);
            $table->smallint('l1codigo', 6);
            $table->smallint('l2codigo', 6);
            $table->smallint('l3codigo', 6);
            $table->smallint('racodigo', 6);
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
        Schema::dropIfExists('animal');
    }
}

