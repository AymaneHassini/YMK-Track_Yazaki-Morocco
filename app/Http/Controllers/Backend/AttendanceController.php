<?php

namespace App\Http\Controllers\Backend;

use App\Models\Employee;
use App\Models\Attendance;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function EmployeeAttendanceList()
    {
        // First, get the dates in descending order of the latest id for each date
        $allData = Attendance::select('date')
            ->orderBy('date', 'desc')
            ->groupBy('date')
            ->get();

        return view('backend.attendance.view_employee_attend', compact('allData'));
    }

    public function AddEmployeeAttendance()
    {
        $employees = Employee::all();
        return view('backend.attendance.add_employee_attend', compact('employees'));
    }
    public function EmployeeAttendanceStore(Request $request)
    {

        Attendance::where('date', date('Y-m-d', strtotime($request->date)))->delete();
    
        $countemployee = count($request->employee_id);
    
        for ($i=0; $i < $countemployee ; $i++) {
            $attend_status = 'attend_status'.$i;
            $attend = new Attendance();
            $attend->date = date('Y-m-d', strtotime($request->date));
            $attend->employee_id = $request->employee_id[$i];
            $attend->attend_status  = $request->$attend_status;
            $attend->save();
        }
    
        $notification = array(
           'message' => 'Data Inseted Successfully',
           'alert-type' => 'success'
            );
    
        return redirect()->route('employee.attend.list')->with($notification);
    
    
    }
    public function EditEmployeeAttendance($date)
    {
        $employees = Employee::all();
        $editData = Attendance::where('date', $date)->get();
        return view('backend.attendance.edit_employee_attend', compact('employees', 'editData'));

    }
    public function ViewEmployeeAttendance($date)
    {

        $details = Attendance::where('date', $date)->get();
        return view('backend.attendance.details_employee_attend', compact('details'));


    }

}
