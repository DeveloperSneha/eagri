<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemedistributionvillageTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schemedistributionvillage', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idSchemDistributionVillage');
            $table->integer('idSchemeActivation')->unsigned()->nullable(false)->unique();
            $table->foreign('idSchemeActivation')->references('idSchemeActivation')->on('schemeactivation')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('schemeDistributionBlock')->unsigned()->nullable(false)->unique();
            $table->foreign('schemeDistributionBlock')->references('idBlock')->on('block')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idVillage')->unsigned()->nullable(false)->unique();
            $table->foreign('idVillage')->references('idVillage')->on('village')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('amountVillage', 10, 2);
            $table->decimal('areaVillage', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schemedistributionvillage');
    }

}
