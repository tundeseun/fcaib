<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmGraduandsList extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_graduands_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->nullable();
            $table->foreignId('academic_id')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->string('matric_number')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('class_of_degree')->nullable();
            $table->string('session')->nullable();
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
        Schema::dropIfExists('sm_graduands_lists');
    }
}
