<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateComponentTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('component', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idComponent');
            $table->integer('idCategory')->unsigned()->nullable(false)->unique();
            $table->foreign('idCategory')->references('idCategory')->on('category')->onUpdate('cascade')->onDelete('cascade');
            $table->string('componentName', 100)->nullable(false)->unique();
            $table->char('isActive',1)->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('component');
    }

}
