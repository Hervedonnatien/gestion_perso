<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDemandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('demandes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date_demande');
            $table->dateTime('date_debut');
            $table->dateTime('date_fin');
            $table->text('motif');
            $table->string('personnel_num_matricule');
            $table->foreign('personnel_num_matricule')
                ->references('num_matricule')->on('personnels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('type_demande_id');
            $table->foreign('type_demande_id')
                ->references('id')->on('type_demandes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('demandes');
    }
}
