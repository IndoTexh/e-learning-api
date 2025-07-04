<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Major extends Model
{
    protected $fillable = [
        'major_kh',
        'major_en',
        'tuition_fees_total',
        'tuition_fees_per_semester',
        'no_of_semester',
        'no_of_course',
        'subjects_per_semester',
        'academic_year',
        'semester_kh',
        'semester_en',
        'subject_kh',
        'subject_en',
        'created_by'
    ];
}
