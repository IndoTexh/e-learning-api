<?php

namespace App\Http\Controllers;

use App\Jobs\ImportMajorJob;
use App\Models\Major;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Maatwebsite\Excel\Facades\Excel;

class MajorController extends Controller
{
    public function index()
    {
        return Inertia::render('Academic/Major', ['majors' => Major::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'major_in_kh' => 'required|string|max:150',
            'major_in_en' =>  'required|string|max:150',
            'tuition_fee_total' => 'required|numeric',
            'tuition_per_semster' => 'required|numeric',
            'no_of_semester' => 'required|numeric',
            'no_of_course' => 'required|numeric',
            'no_of_subject_per_semester' => 'required|numeric',
        ]);
        $major = new Major();
        $major->major_kh = $request->major_in_kh;
        $major->major_en = $request->major_in_en;
        $major->tuition_fees_total = $request->tuition_fee_total;
        $major->tuition_fees_per_semester = $request->tuition_per_semster;
        $major->no_of_semester = $request->no_of_semester;
        $major->no_of_course = $request->no_of_course;
        $major->subjects_per_semester = $request->no_of_subject_per_semester;
        $major->created_by = $request->user()->name;
        $major->save();
        return back()->with('status', 'Major has been created!');
    }
    public function import(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls',
        ]);
        $file = $request->file('excel_file');
        $file_path = $file->getPathname();
        $rows = Excel::toArray([], $file_path);
        $heading_row = $rows[0][0];
        $data = array_slice($rows[0], 1);
        foreach ($data as $row) {
            $row_data = array_combine($heading_row, $row);
            $major = new Major();
            $major->major_kh = $row_data['major_kh'];
            $major->major_en = $row_data['major_en'];
            $major->tuition_fees_total = $row_data['tuition_fees_total'];
            $major->tuition_fees_per_semester = $row_data['tuition_fees_per_semester'];
            $major->no_of_semester = $row_data['no_of_semester'];
            $major->no_of_major = $row_data['no_of_major'];
            $major->subjects_per_semester = $row_data['subjects_per_semester'];
            $major->academic_year = $row_data['academic_year'];
            $major->semester_kh = $row_data['semester_kh'];
            $major->semester_en = $row_data['semester_en'];
            $major->subject_kh = $row_data['subject_kh'];
            $major->subject_en = $row_data['subject_en'];
            $major->created_by = $row_data['created_by'];
            $major->save();
        }
        /* ImportMajorJob::dispatch($file_path); */
        return redirect()->back()->with('status', 'Data import has finished.');
    }
    public function detail(Request $request)
    {
        $major_detail = Major::where('major_en', $request->text_id)->first();
        if (!$major_detail) return back()->with('status', "We couldn't find detail for that major.");
        else return Inertia::render('Academic/MajorDetail', ['major_detail' => $major_detail]);
    }
}
