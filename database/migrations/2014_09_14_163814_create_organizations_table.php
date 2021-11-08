<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id('organization_id');
            $table->unsignedBiginteger('organization_type_id');
            $table->string('organization_name');
            $table->string('organization_acronym');
            $table->timestamps();
            
            $table->foreign('organization_type_id')->references('organization_type_id')->on('organizations_type')->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
