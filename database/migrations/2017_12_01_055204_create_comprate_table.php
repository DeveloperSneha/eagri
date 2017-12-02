<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComprateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comprate', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idCompRate');
            $table->integer('idCompSize')->unsigned()->nullable(false)->unique();
            $table->foreign('idCompSize')->references('idCompSize')->on('compsize')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idSchemeActivation')->unsigned()->nullable(false);
            $table->foreign('idSchemeActivation')->references('idSchemeActivation')->on('schemeactivation')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('ratePerUnit')->nullable(false);
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
        Schema::dropIfExists('comprate');
    }
}
