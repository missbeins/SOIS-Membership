<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonAcademicMembershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_academic_membership', function (Blueprint $table) {
            $table->id('non_academic_membership_id');
            $table->unsignedBigInteger('organization_id');
            $table->integer('membership_fee');
            $table->string('semester');
            $table->string('school_year');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('registration_status');
            $table->string('status');
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
        Schema::dropIfExists('non_academic_membership');
    }
}
