<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idBlock');
            $table->integer('idDistrict')->unsigned()->nullable(false);
            $table->foreign('idDistrict')->references('idDistrict')->on('district')->onUpdate('cascade')->onDelete('cascade');
            $table->string('blockName',200)->nullable(false)->unique('blockName', 'idDistrict');
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
        Schema::dropIfExists('block');
    }
}
