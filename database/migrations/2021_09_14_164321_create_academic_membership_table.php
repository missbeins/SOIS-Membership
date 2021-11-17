<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_membership', function (Blueprint $table) {
            
            $table->id('academic_membership_id');
            $table->unsignedBigInteger('organization_id');
            $table->string('semester');
            $table->string('school_year');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();

            $table->foreign('organization_id')->references('organization_id')->on('organizations')->onDelete('cascade');
             
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('academic_membership');
    }
}
