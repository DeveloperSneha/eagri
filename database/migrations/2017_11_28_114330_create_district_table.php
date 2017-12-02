<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('district', function (Blueprint $table) {
            $table->engine = "InnoDB";
            $table->increments('idDistrict');
            $table->integer('idState')->unsigned()->nullable();
            $table->foreign('idState')->references('idState')->on('state')->onUpdate('cascade')->onDelete('cascade');
            $table->string('districtName', 20)->nullable(false)->unique();
            $table->timestamps();
        });
//        Schema::table('district', function($table) {
//            $table->foreign('idState')->references('idState')->on('state');
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('district');
    }

}
