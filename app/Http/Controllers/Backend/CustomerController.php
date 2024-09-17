<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Rules\EmailDomain;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function AllCustomer()
    {

        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer', compact('customer'));
    } // End Method


    public function AddCustomer()
    {
        return view('backend.customer.add_customer');
    } // End Method


    public function StoreCustomer(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'email' => 'required|unique:users|max:200',
            'phone' => ['required', 'string', 'digits:10', 'unique:users,phone,' . Auth::id()],
            'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'company_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'account_holder' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:200'],
            'account_number' => ['required', 'string', 'digits:12', 'unique:customers,account_number,' . Auth::id()],
            'image' => 'required',
            'bank_name'=>'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'bank_branch'=> 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'city'=>'nullable|string|regex:/^[a-zA-Z\s]+$/|max:200',
        ]);
 
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/customer/'.$name_gen);
        $save_url = 'upload/customer/'.$name_gen;

        Customer::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company_name' => $request->company_name,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
           'message' => 'Customer Inserted Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.customer')->with($notification);
    } // End Method


    public function EditCustomer($id)
    {

        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer', compact('customer'));

    } // End Method


    public function UpdateCustomer(Request $request)
    {
        $customer_id = $request->id;
        $customer = Customer::findOrFail($customer_id);
    
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
            'phone' => ['nullable', 'string', 'digits:10', 'unique:users,phone,' . Auth::id()],
            'account_number' => ['nullable', 'string', 'digits:12', Rule::unique('customers', 'account_number')->ignore($customer->id)],
            'account_holder' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:200'],
            'company_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'bank_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'city' => 'nullable|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'bank_branch' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
        ]);
    
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/customer/' . $name_gen);
            $save_url = 'upload/customer/' . $name_gen;
    
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = [
                'message' => 'Customer Updated Successfully',
                'alert-type' => 'success',
            ];
    
            return redirect()->route('all.customer')->with($notification);
    
        } else {
            $customer->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = [
                'message' => 'Customer Updated Successfully',
                'alert-type' => 'success',
            ];
    
            return redirect()->route('all.customer')->with($notification);
        }
    }
    


    public function DeleteCustomer($id)
    {

        $customer_img = Customer::findOrFail($id);
        $img = $customer_img->image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method



}
