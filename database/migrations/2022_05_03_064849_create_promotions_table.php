<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('from_grade');
            $table->unsignedBigInteger('from_level');
            $table->unsignedBigInteger('from_section');
            $table->unsignedBigInteger('to_grade');
            $table->unsignedBigInteger('to_level');
            $table->unsignedBigInteger('to_section');
            $table->string('academic_year');
            $table->string('academic_year_new');
            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('from_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('from_level')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('from_section')->references('id')->on('sections')->onDelete('cascade');
            $table->foreign('to_grade')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('to_level')->references('id')->on('levels')->onDelete('cascade');
            $table->foreign('to_section')->references('id')->on('sections')->onDelete('cascade');
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
        Schema::dropIfExists('promotions');
    }
};
