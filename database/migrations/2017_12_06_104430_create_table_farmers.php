<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFarmers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farmers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idFarmer');
            $table->string('name',100);
            $table->string('father_name',100);
            $table->string('mother_name',100);
            $table->string('aadhaar',15)->nullable(false)->unique();
            $table->string('rcno',30)->nullable()->unique();
            $table->string('farmer_category');
            $table->string('gender',15);
            $table->string('marital_status',20);
            $table->string('caste',20);
            $table->string('mobile')->nullable(false)->unique();
            $table->integer('idDistrict')->default(0);
            $table->integer('idBlock')->default(0);
            $table->integer('idVillage')->default(0);
            $table->string('bank_name',100)->nullable();
            $table->string('bank_branch',100)->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('account_no')->nullable();
            $table->string('land_location',50)->nullable();
            $table->string('land_owner',50)->nullable();
            $table->string('total_land',50)->nullable(false);
            $table->string('remarks',500)->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('farmers');
    }
}
