<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Leave;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LeaveController extends Controller
{
    public function index() {
        // $leaves = Leave::all();
        // $leaves = $leaves->map(function($leave, $key) {
        //     $employee = Employee::find($leave->employee_id);
        //     $leave->employee = $employee;
        //     return $leave;
        // });
        // return view('admin.leaves.index')->with('leaves', $leaves);
        $leaves = Leave::with('employee')->get();
        return view('admin.leaves.index', compact('leaves'));
    }

    public function update(Request $request, $leave_id){
        $this->validate($request, [
            'status' => 'required'
        ]);
        $leave = Leave::find($leave_id);
        $leave->status = $request->status;
        $leave->save();

        Alert::success('Success', 'Status Cuti Berhasil Diubah');
        return back();
    }
}