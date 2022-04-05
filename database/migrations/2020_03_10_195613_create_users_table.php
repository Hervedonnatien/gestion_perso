<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->Increments('id');
            $table->enum('droit',['admin','simple'])->default('simple');
            $table->string('personnel_num_matricule');
            $table->foreign('personnel_num_matricule')
                ->references('num_matricule')->on('personnels')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('email_personnel')->unique();
            $table->string('password');
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
        Schema::dropIfExists('users');
    }
}
