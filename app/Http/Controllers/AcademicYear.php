<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear as ModelsAcademicYear;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AcademicYear extends Controller
{
    public function index()
    {
        return Inertia::render('Academic/Year', ['academic_years' => ModelsAcademicYear::all()]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'academic_year' => 'required|string'
        ]);
        $record = new ModelsAcademicYear();
        $record->academic_year = $request->academic_year;
        $record->created_by = $request->user()->name;
        $record->save();
        return redirect()->route('acacdemic_year')->with('status', 'Academic year has been created!');
    }
    public function destroy($id)
    {
        $academic_year = ModelsAcademicYear::where('id', $id)->first();
        if (!$academic_year) {
            return redirect()->route('acacdemic_year')->with('status', 'Academic with that id is not found!');
        }
        $academic_year->delete();
        return redirect()->route('acacdemic_year')->with('status', 'Academic year has been deleted!');
    }
}
