<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('numserie');
            $table->unsignedBigInteger('user_id');
            $table->string('marque');
            $table->string('type');
            $table->integer('annee');
            $table->string('description');
            $table->string('statut');
            $table->boolean('dedouaner');
            $table->double('prixDedouanement');
            $table->double('ht');
            $table->integer('tva')->default(10);
            $table->double('ttc');
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
        Schema::dropIfExists('cars');
    }
}
