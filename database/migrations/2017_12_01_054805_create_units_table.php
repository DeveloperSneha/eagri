<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUnitsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('units', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idUnit');
            $table->string('unitName', 50)->nullable(false)->unique();
            $table->string('unitType', 50)->nullable(false)->unique();
            $table->integer('idBaseUnit')->unsigned()->nullable(false);
            $table->decimal('conversionMultipierToBase',10,2)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('units');
    }

}
