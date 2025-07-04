<?php

namespace App\Jobs;

use App\Models\Major;
use App\Events\ImportFinished;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use phpDocumentor\Reflection\Types\This;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ImportMajorJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file_path;

    public function __construct($file_path)
    {
        $this->file_path = $file_path;
    }

    public function handle(): void
    {
        try {
            $full_path = storage_path("app/{$this->file_path}");
            $rows = Excel::toArray([], $full_path);
            Log::info("Reading Excel file from: " . $full_path);

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

            Storage::delete($this->file_path);
            Log::info("ImportMajorJob completed.");
        } catch (\Throwable $e) {
            Log::error("ImportMajorJob failed: " . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
