<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('scheme', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idScheme');
            $table->integer('idSection')->unsigned()->nullable(false)->unique();
            $table->foreign('idSection')->references('idSection')->on('section')->onUpdate('cascade')->onDelete('cascade');
            $table->string('schemeName', 100)->nullable(false)->unique();
            $table->string('remarks', 200)->nullable(false);
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
        Schema::dropIfExists('scheme');
    }
}
