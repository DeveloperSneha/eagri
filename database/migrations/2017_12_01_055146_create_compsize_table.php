<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompsizeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compsize', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idCompSize');
            $table->integer('idComponent')->unsigned()->nullable(false)->unique();
            $table->foreign('idComponent')->references('idComponent')->on('component')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('size')->nullable(false);
            $table->integer('idUnit')->unsigned()->nullable(false);
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
        Schema::dropIfExists('compsize');
    }
}
