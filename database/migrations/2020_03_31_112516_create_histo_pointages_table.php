<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoPointagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('histo_pointages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->time('heure_entre');
            $table->time('heure_sortie');
            $table->string('im');
            $table->foreign('im')
                ->references('num_matricule')->on('personnels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
        Schema::dropIfExists('histo_pointages');
    }
}
