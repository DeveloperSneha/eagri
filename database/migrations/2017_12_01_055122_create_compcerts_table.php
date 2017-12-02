<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompcertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compcerts', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idCompCerts');
            $table->integer('idCertificate')->unsigned()->nullable(false)->unique();
            $table->foreign('idCertificate')->references('idCertificate')->on('certificates')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('idComponent')->unsigned()->nullable(false)->unique();
            $table->foreign('idComponent')->references('idComponent')->on('component')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('compcerts');
    }
}
