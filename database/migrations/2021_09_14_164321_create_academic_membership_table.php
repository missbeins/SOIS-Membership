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
            $table->id('academic_member_id');

            $table->unsignedBigInteger('course_id');

            $table->string('approval_status')->default('Pending');
            $table->string('subscription')->default('Unpaid');
            $table->string('email')->unique();
            $table->string('student_number')->unique();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('year_and_section');
            $table->date('date_of_birth');
            $table->string('mobile_number');
            $table->timestamps();

            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
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
