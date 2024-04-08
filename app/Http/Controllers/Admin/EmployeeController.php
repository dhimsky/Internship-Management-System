<?php

namespace App\Http\Controllers\Admin;

use App\Attendance;
use App\Department;
use App\Employee;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use RealRashid\SweetAlert\Facades\Alert;

use function Ramsey\Uuid\v1;

class EmployeeController extends Controller
{
    public function index() {
        $data = [
            'employees' => Employee::all()
        ];
        return view('admin.employees.index')->with($data);
    }
    // public function create() {
    //     $data = [
    //         'departments' => Department::all(),
    //         'desgs' => ['Manajer', 'Asisten Manajer', 'Kepala Divisi', 'Staff']
    //     ];
    //     return view('admin.employees.create')->with($data);
    // }

    public function store(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'age' => 'required',
            'campus_origin' => 'required',
            'division' => 'required',
            'intern_period' => 'required',
            'email' => 'required|email',
            // 'photo' => 'image|nullable',
            'password' => 'required|confirmed|min:6'
        ],[
            'name.required' => 'Nama wajib diisi!',
            'age.required' => 'Umur wajib diisi!',
            'campus_origin.required' => 'Asal Kampus wajib diisi!',
            'division.required' => 'Divisi wajib diisi!',
            'intern_period.required' => 'Periode magang wajib diisi',
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
        ]);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $employeeRole = Role::where('name', 'employee')->first();
        $user->roles()->attach($employeeRole);
        $employeeDetails = [
            'user_id' => $user->id, 
            'name' => $request->name, 
            'age' => $request->age,
            'campus_origin' => $request->campus_origin, 
            'division' => $request->division, 
            'intern_period' => $request->intern_period,
            // 'photo'  => 'user.png'
        ];
        // Photo upload
        // if ($request->hasFile('photo')) {
        //     // GET FILENAME
        //     $filename_ext = $request->file('photo')->getClientOriginalName();
        //     // GET FILENAME WITHOUT EXTENSION
        //     $filename = pathinfo($filename_ext, PATHINFO_FILENAME);
        //     // GET EXTENSION
        //     $ext = $request->file('photo')->getClientOriginalExtension();
        //     //FILNAME TO STORE
        //     $filename_store = $filename.'_'.time().'.'.$ext;
        //     // UPLOAD IMAGE
        //     // $path = $request->file('photo')->storeAs('public'.DIRECTORY_SEPARATOR.'employee_photos', $filename_store);
        //     // add new file name
        //     $image = $request->file('photo');
        //     $image_resize = Image::make($image->getRealPath());              
        //     $image_resize->resize(300, 300);
        //     $image_resize->save(public_path(DIRECTORY_SEPARATOR.'storage'.DIRECTORY_SEPARATOR.'employee_photos'.DIRECTORY_SEPARATOR.$filename_store));
        //     $employeeDetails['photo'] = $filename_store;
        // }
        
        Employee::create($employeeDetails);
        
        Alert::success('Success', 'Data berhasil ditambahkan!');
        return redirect()->route('admin.employees.index');
    }

    public function update(Request $request, $id)
{
    // Ambil data karyawan berdasarkan ID
    $employee = Employee::findOrFail($id);

    // Lakukan validasi data dari $request
    $this->validate($request, [
        'name' => 'required',
        'age' => 'required|numeric',
        'campus_origin' => 'required',
        'division' => 'required',
        'intern_period' => 'required',
        'email' => 'required|email',
    ]);

    // Update data karyawan berdasarkan input dari $request
    $employee->name = $request->name;
    $employee->age = $request->age;
    $employee->campus_origin = $request->campus_origin;
    $employee->division = $request->division;
    $employee->intern_period = $request->intern_period;
    $employee->save();

    // Tampilkan pesan sukses atau redirect ke halaman lain
    return redirect()->route('admin.employees.index')->with('success', 'Data karyawan berhasil diperbarui.');
}


    public function attendance(Request $request) {
        $data = [
            'date' => null
        ];
        if($request->all()) {
            $date = Carbon::create($request->date);
            $employees = $this->attendanceByDate($date);
            $data['date'] = $date->format('d M, Y');
        } else {
            $employees = $this->attendanceByDate(Carbon::now());
        }
        $data['employees'] = $employees;
        // dd($employees->get(4)->attendanceToday->id);
        return view('admin.employees.attendance')->with($data);
    }

    public function attendanceByDate($date) {
        $employees = DB::table('employees')->select('id', 'name', 'division')->get();
        $attendances = Attendance::all()->filter(function($attendance, $key) use ($date){
            return $attendance->created_at->dayOfYear == $date->dayOfYear;
        });
        return $employees->map(function($employee, $key) use($attendances) {
            $attendance = $attendances->where('employee_id', $employee->id)->first();
            $employee->attendanceToday = $attendance;
            return $employee;
        });
    }

    public function destroy($employee_id) {
        $employee = Employee::findOrFail($employee_id);
        $user = User::findOrFail($employee->user_id);
        // detaches all the roles
        DB::table('leaves')->where('employee_id', '=', $employee_id)->delete();
        DB::table('attendances')->where('employee_id', '=', $employee_id)->delete();
        DB::table('expenses')->where('employee_id', '=', $employee_id)->delete();
        $employee->delete();
        $user->roles()->detach();
        // deletes the users
        $user->delete();
        Alert::success('Success', 'Data berhasil di hapus!');
        return redirect()->route('admin.employees.index');

    }

    public function attendanceDelete($attendance_id) {
        $attendance = Attendance::findOrFail($attendance_id);
        $attendance->delete();
        request()->session()->flash('success', 'Riwayat Absensi berhasil dihapus!');
        return back();
    }

    public function employeeProfile($employee_id) {
        $employee = Employee::findOrFail($employee_id);
        return view('admin.employees.profile')->with('employee', $employee);
    }
}