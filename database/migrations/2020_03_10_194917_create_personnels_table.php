<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->string('num_matricule',6)->primary();
            $table->string('nom_prenom',100);
            $table->string('profile');
            $table->enum('sexe',['Masculin','Feminin']);
            $table->string('email')->unique();
            $table->string('situation_familiale',100);
            $table->string('telephone',15)->unique();
            $table->string('secret_identity',191)->unique();
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
        Schema::dropIfExists('personnels');
    }
}
