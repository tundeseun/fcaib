<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmResultsUploadTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sm_results_uploads', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('subject_id')->nullable();
            $table->foreignId('class_id')->nullable();
            $table->foreignId('academic_year_id')->nullable();
            $table->boolean('status')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sm_results_uploads');
    }
}
