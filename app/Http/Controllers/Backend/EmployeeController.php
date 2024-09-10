<?php

namespace App\Http\Controllers\Backend;
use App\Models\Employee;
use App\Rules\UniquePhoneAcrossTables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Rules\EmailDomain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    public function AllEmployee()
    {
        $employee = Employee::latest()->get();
        return view('backend.employee.all_employee', compact('employee'));
    }
    public function AddEmployee()
    {
        return view('backend.employee.add_employee');
    }
    public function StoreEmployee(Request $request)
{
    $validateData = $request->validate([
        'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
        'email' => [
            'required',
            'unique:employees',
            'max:200',
            'regex:/^[a-zA-Z0-9._%+-]+@yazaki-europe\.com$/',
            new EmailDomain,
        ],
        'phone' => [
            'required',
            'string',
            'digits:10',
            function ($attribute, $value, $fail) {
                // Check uniqueness in the employees table
                $existsInEmployees = \App\Models\Employee::where('phone', $value)->exists();
                // Check uniqueness in the users table
                $existsInUsers = \App\Models\User::where('phone', $value)->exists();

                if ($existsInEmployees || $existsInUsers) {
                    $fail('The phone number is already in use.');
                }
            },
        ],
        'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
        'salary' => 'required|integer',
        'vacation' => 'nullable|string|regex:/^[a-zA-Z\s]+$/|max:200',
        'experience' => 'required',
        'image' => 'required|image',
        'city' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
    ], [
        'name.required' => 'The Employee Name Field is Required',
        'phone.unique' => 'The phone number is already in use.',
        'image.image' => 'The image must be a valid image file.',
    ]);

    // Handle the image upload
    $image = $request->file('image');
    $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
    Image::make($image)->resize(300, 300)->save(public_path('upload/employee/' . $name_gen));
    $save_url = 'upload/employee/' . $name_gen;

    // Insert employee data into the database
    Employee::create([
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'experience' => $request->experience,
        'salary' => $request->salary,
        'vacation' => $request->vacation,
        'city' => $request->city,
        'image' => $save_url,
    ]);

    // Prepare success notification
    $notification = [
        'message' => 'Employee Inserted Successfully',
        'alert-type' => 'success',
    ];

    return redirect()->route('all.employee')->with($notification);
}

    public function EditEmployee($id)
    {

        $employee = Employee::findOrFail($id);
        return view('backend.employee.edit_employee', compact('employee'));

    }
    public function UpdateEmployee(Request $request)
    {
        $employee_id = $request->id;
        $employee=Employee::findOrFail($employee_id);

        $validateData = $request->validate(
            [
                'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
                'email' => [
                'required',
                 Rule::unique('employees')->ignore($employee->id),
                'max:200',
                'regex:/^[a-zA-Z0-9._%+-]+@yazaki-europe\.com$/',
                new EmailDomain
            ],
            'phone' => [
                'required',
                'string',
                'digits:10',
                new UniquePhoneAcrossTables($employee_id),
            ],
            'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'salary' => 'required|integer',
            'vacation' => 'nullable|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'experience' => 'required',
            'city' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',

        ],
            [
            'name.required' => 'This Field is Required',
        ]
        );

        if ($request->file('image')) {

            $image = $request->file('image');
            $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/employee/'.$name_gen);
            $save_url = 'upload/employee/'.$name_gen;

            Employee::findOrFail($employee_id)->update([

                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'experience' => $request->experience,
                'salary' => $request->salary,
                'vacation' => $request->vacation,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),

            ]);

            $notification = array(
               'message' => 'Employee Updated Successfully',
               'alert-type' => 'success'
        );

            return redirect()->route('all.employee')->with($notification);
             
        } else {

            Employee::findOrFail($employee_id)->update([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'experience' => $request->experience,
            'salary' => $request->salary,
            'vacation' => $request->vacation,
            'city' => $request->city,
            'created_at' => Carbon::now(),

        ]);

            $notification = array(
               'message' => 'Employee Updated Successfully',
               'alert-type' => 'success'
        );

            return redirect()->route('all.employee')->with($notification);

        }
    }
    public function DeleteEmployee($id)
    {

        $employee_img = Employee::findOrFail($id);
        $img = $employee_img->image;
        unlink($img);

        Employee::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Employee Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }
    

}
