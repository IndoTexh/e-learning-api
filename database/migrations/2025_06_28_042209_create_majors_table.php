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
        Schema::create('majors', function (Blueprint $table) {
            $table->id();
            $table->string('major_kh');
            $table->string('major_en');
            $table->string('tuition_fees_total');
            $table->string('tuition_fees_per_semester');
            $table->integer('no_of_semester');
            $table->integer('no_of_course');
            $table->integer('subjects_per_semester');
            /* $table->string('academic_year'); */
            /* $table->string('semester_kh');
            $table->string('semester_en'); */
            /* $table->string('subject_kh');
            $table->string('subject_en'); */
            $table->string('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('majors');
    }
};
