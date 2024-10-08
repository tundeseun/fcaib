<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableGraduandBulkTemporary extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('graduand_bulk_temporaries', function (Blueprint $table) {
            $table->id();
            $table->string('matric_number')->nullable();
            $table->string('cgpa')->nullable();
            $table->string('class_of_degree')->nullable();
            $table->foreignId('user_id')->nullable();
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
        Schema::dropIfExists('graduand_bulk_temporaries');
    }
}
