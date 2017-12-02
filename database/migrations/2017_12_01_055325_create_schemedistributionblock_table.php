<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemedistributionblockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schemedistributionblock', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idSchemDistributionDistrict');
            $table->integer('idSchemeActivation')->unsigned()->nullable(false)->unique();
            $table->foreign('idSchemeActivation')->references('idSchemeActivation')->on('schemeactivation')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('schemeDistributionDistrict')->unsigned()->nullable(false)->unique();
            $table->integer('idBlock')->unsigned()->nullable(false)->unique();
            $table->foreign('idBlock')->references('idBlock')->on('block')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('amountBlock', 10, 2);
            $table->decimal('areaBlock', 10, 2);
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
        Schema::dropIfExists('schemedistributionblock');
    }
}
