<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVillageTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('village', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idVillage');
            $table->integer('idBlock')->unsigned()->nullable(false);
            $table->foreign('idBlock')->references('idBlock')->on('block')->onUpdate('cascade')->onDelete('cascade');
            $table->string('villageName',100)->nullable(false)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('village');
    }

}
