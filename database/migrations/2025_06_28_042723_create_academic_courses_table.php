<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_courses', function (Blueprint $table) {
            $table->id();
            $table->string('course_name_kh');
            $table->string('course_name_en');
            $table->string('academic_year');
            $table->string('major_kh');
            $table->string('major_en');
            $table->string('semester_kh');
            $table->string('semester_en');
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_courses');
    }
};
