<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('user_user_id');
            $table->unsignedBigInteger('role_role_id');
            $table->timestamps();
            
            $table->foreign('user_user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('role_role_id')->references('role_id')->on('roles')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
