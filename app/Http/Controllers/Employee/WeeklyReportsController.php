<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\WeeklyReports;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Storage;

class WeeklyReportsController extends Controller
{
    public function index()
    {
        $weeklyreports = WeeklyReports::latest()->get();
        return view('employee.weeklyreports.index', compact('weeklyreports'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'tittle' => 'required',
            'file' => 'required|file|mimes:pdf|max:2048',
            'description' => 'nullable',
            'status' => 'nullable',
        ],[
            'tittle.required' => 'Judul wajib diisi!',
            'file.required' => 'Wajib upload file!',
            'file.mimes' => 'Wjib format PDF!',
            'file.max' => 'File maksimal 2MB!',
        ]);
    
        $employee = Auth::user()->employee;
    
        $reportData = [
            'employee_id' => $employee->id,
            'status' => 'Pending',
            'tittle' => $request->tittle,
            'description' => $request->description,
        ];
    
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            Storage::putFileAs('public/pdf_reports', $file, $fileName);
            $reportData['file'] = $fileName;
        }
    
        WeeklyReports::create($reportData);
        
        Alert::success('Success', 'Laporan mingguan berhasil dibuat!');
        return redirect()->route('employee.weeklyreports.index');
    }

    public function download($fileName)
    {
        $filePath = storage_path('app/public/pdf_reports/' . $fileName);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            abort(404, 'File not found');
        }
    }

}