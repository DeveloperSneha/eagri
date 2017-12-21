<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemeactivationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('schemeactivation', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idSchemeActivation');
            $table->integer('idScheme')->unsigned()->nullable(false)->unique();
            $table->foreign('idScheme')->references('idScheme')->on('scheme')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idFinancialYear')->unsigned()->nullable(false)->unique();
            $table->datetime('startDate')->nullable(false);
            $table->datetime('endDate')->nullable(false);
            $table->integer('extendDays')->unsigned()->nullable(false);
            $table->integer('totalFundsAllocated')->unsigned()->nullable(false);
            $table->integer('totalAreaAllocated')->unsigned()->nullable(false);
            $table->integer('idUnit')->unsigned();
            $table->foreign('idUnit')->references('idUnit')->on('units')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('vendorDeliveryDayLimit');
            $table->string('guidelines',200);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('schemeactivation');
    }

}
