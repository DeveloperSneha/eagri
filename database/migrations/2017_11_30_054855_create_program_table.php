<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProgramTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('program', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idProgram');
            $table->integer('idScheme')->unsigned()->nullable(false)->unique();
            $table->foreign('idScheme')->references('idScheme')->on('scheme')->onUpdate('cascade')->onDelete('cascade');
            $table->string('programName', 100)->nullable(false)->unique();
            $table->char('isVendorRequired',1)->default('N');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('program');
    }

}
