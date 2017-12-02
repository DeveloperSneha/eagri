<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemedistributiondistrictTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schemedistributiondistrict', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idSchemDistributionDistrict');
            $table->integer('idSchemeActivation')->unsigned()->nullable(false)->unique();
            $table->foreign('idSchemeActivation')->references('idSchemeActivation')->on('schemeactivation')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idDistrict')->unsigned()->nullable(false)->unique();
            $table->foreign('idDistrict')->references('idDistrict')->on('district')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('amountDistrict', 10, 2);
            $table->decimal('areaDistrict', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schemedistributiondistrict');
    }

}
