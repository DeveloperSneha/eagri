<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFarmerAppliedScheme extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmerapplied_scheme', function (Blueprint $table) {
            $table->increments('idAppliedScheme');
            $table->integer('idFarmer')->unsigned()->nullable(false)->unique();
            $table->foreign('idFarmer')->references('idFarmer')->on('farmer')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idScheme')->unsigned()->nullable(false)->unique();
            $table->foreign('idScheme')->references('idScheme')->on('scheme')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idProgram')->unsigned()->nullable(false)->unique();
            $table->foreign('idProgram')->references('idProgram')->on('program')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idCategory')->unsigned()->nullable();
            $table->integer('idComponent')->unsigned()->nullable();
            $table->string('areaApplied',100)->nullable(false);
            $table->char('previouslyApplied',1)->default('N');
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
        Schema::dropIfExists('farmerapplied_scheme');
    }
}
