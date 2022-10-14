

<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDadosprodutivosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dadosprodutivos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('criador_id');
            $table->string('dpregistro', 12);
            $table->string('crcodigo', 5);
            $table->date('dpinicio');
            $table->smallint('dplactacao', 6)->default('0');
            $table->decimal('dpmes1', 10, 2)->default('0.00');
            $table->decimal('dpmes2', 10, 2)->default('0.00');
            $table->decimal('dpmes3', 10, 2)->default('0.00');
            $table->decimal('dpmes4', 10, 2)->default('0.00');
            $table->decimal('dpmes5', 10, 2)->default('0.00');
            $table->decimal('dpmes6', 10, 2)->default('0.00');
            $table->decimal('dpmes7', 10, 2)->default('0.00');
            $table->decimal('dpmes8', 10, 2)->default('0.00');
            $table->decimal('dpmes9', 10, 2)->default('0.00');
            $table->decimal('dpmes10', 10, 2)->default('0.00');
            $table->decimal('dpmes11', 10, 2)->default('0.00');
            $table->decimal('dpmes12', 10, 2)->default('0.00');
            $table->decimal('dpmes13', 10, 2)->default('0.00');
            $table->decimal('dpmes14', 10, 2)->default('0.00');
            $table->decimal('dpmesmais14', 10, 2)->default('0.00');
            $table->date('dpfim');
            $table->decimal('dptotal', 10, 2)->default('0.00');
            $table->decimal('dpdias', 10, 2)->default('0.00');
            $table->decimal('dpmedia', 10, 2)->default('0.00');
            $table->decimal('dp305', 10, 2)->default('0.00');
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
        Schema::dropIfExists('dadosprodutivos');
    }
}

