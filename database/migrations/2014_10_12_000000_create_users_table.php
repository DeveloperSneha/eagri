<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('aadhaar');
            $table->string('rcno');
            $table->string('farmer_category');
            $table->string('gender');
            $table->string('marital_status');
            $table->string('caste');
            $table->string('mobile');
            $table->string('schdistrict');
            $table->string('schblock');
            $table->string('schvillage');
            $table->string('bank_name');
            $table->string('bank_branch');
            $table->string('ifsc_code');
            $table->string('account_no');
            $table->string('land_location');
            $table->string('land_owner');
            $table->string('total_land');
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
        Schema::dropIfExists('users');
    }
}
