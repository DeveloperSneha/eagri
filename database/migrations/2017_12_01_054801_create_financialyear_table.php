<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFinancialyearTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('financialyear', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idFinancialYear');
            $table->string('financialYearName', 15)->nullable(false)->unique();
            $table->datetime('finanYearStartDate')->nullable(false)->unique();
            $table->datetime('finanYearEndDate')->nullable(false)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('financialyear');
    }

}
