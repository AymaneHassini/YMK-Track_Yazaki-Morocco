<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;

class SupplierController extends Controller
{
    public function AllSupplier()
    {

        $supplier = Supplier::latest()->get();
        return view('backend.supplier.all_supplier', compact('supplier'));

    } // End Method


    public function AddSupplier()
    {
        return view('backend.supplier.add_supplier');
    } // End Method

    public function StoreSupplier(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers')->ignore(Auth::id())
                    ->where(function ($query) {
                        $query->where('email', request('email'));
                    }),
                Rule::unique('suppliers')->ignore(Auth::id())
                    ->where(function ($query) {
                        $query->where('email', request('email'));
                    }),
                Rule::unique('users')->ignore(Auth::id())
                    ->where(function ($query) {
                        $query->where('email', request('email'));
                    }),
            ],
            'phone' => [
                'nullable',
                'string',
                'digits:10',
                function ($attribute, $value, $fail) {
                    $existsInCustomers = DB::table('customers')->where('phone', $value)->exists();
                    $existsInSuppliers = DB::table('suppliers')->where('phone', $value)->exists();
                    $existsInUsers = DB::table('users')->where('phone', $value)->where('id', '<>', Auth::id())->exists();
        
                    if ($existsInCustomers || $existsInSuppliers || $existsInUsers) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                },
            ],
            'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'bank_branch'=>'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'bank_name'=>'required|string|regex:/^[a-zA-Z\s]+$/|max:400',

            'company_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'account_holder' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:200'],
            'account_number' => [
                'required',
                'string',
                'digits:12',
                Rule::unique('customers')->ignore(Auth::id())
                    ->where(function ($query) {
                        $query->where('account_number', request('account_number'));
                    }),
                Rule::unique('suppliers')->ignore(Auth::id())
                    ->where(function ($query) {
                        $query->where('account_number', request('account_number'));
                    }),
            ],
            'type' => 'required',
            'city'=> 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'image' => 'required',
        ]);
 
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300, 300)->save('upload/supplier/'.$name_gen);
        $save_url = 'upload/supplier/'.$name_gen;

        Supplier::insert([

            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'company_name' => $request->company_name,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
           'message' => 'Supplier Inserted Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('all.supplier')->with($notification);
    } // End Method


    public function EditSupplier($id)
    {

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));

    } // End Method

    public function UpdateSupplier(Request $request)
    {
        $supplier_id = $request->id;
    
        $validateData = $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('customers')->ignore($supplier_id),
                Rule::unique('suppliers')->ignore($supplier_id),
                Rule::unique('users')->ignore($supplier_id),
            ],
            'phone' => [
                'nullable',
                'string',
                'digits:10',
                function ($attribute, $value, $fail) use ($supplier_id) {
                    $existsInCustomers = DB::table('customers')->where('phone', $value)->where('id', '<>', $supplier_id)->exists();
                    $existsInSuppliers = DB::table('suppliers')->where('phone', $value)->where('id', '<>', $supplier_id)->exists();
                    $existsInUsers = DB::table('users')->where('phone', $value)->where('id', '<>', $supplier_id)->exists();
    
                    if ($existsInCustomers || $existsInSuppliers || $existsInUsers) {
                        $fail('The ' . $attribute . ' has already been taken.');
                    }
                },
            ],
            'address' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'bank_branch'=>'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'bank_name'=>'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'city'=> 'required|string|regex:/^[a-zA-Z\s]+$/|max:400',
            'company_name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:200',
            'account_holder' => ['required', 'string', 'regex:/^[a-zA-Z\s]+$/', 'max:200'],
            'account_number' => [
                'required',
                'string',
                'digits:12',
                Rule::unique('customers')->ignore($supplier_id),
                Rule::unique('suppliers')->ignore($supplier_id),
            ],
        ]);
    
        if ($request->file('image')) {
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(300, 300)->save('upload/supplier/' . $name_gen);
            $save_url = 'upload/supplier/' . $name_gen;
    
            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'image' => $save_url,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = [
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('all.supplier')->with($notification);
        } else {
            Supplier::findOrFail($supplier_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'company_name' => $request->company_name,
                'type' => $request->type,
                'account_holder' => $request->account_holder,
                'account_number' => $request->account_number,
                'bank_name' => $request->bank_name,
                'bank_branch' => $request->bank_branch,
                'city' => $request->city,
                'created_at' => Carbon::now(),
            ]);
    
            $notification = [
                'message' => 'Supplier Updated Successfully',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('all.supplier')->with($notification);
        }
    }

    public function DeleteSupplier($id)
    {

        $supplier_img = Supplier::findOrFail($id);
        $img = $supplier_img->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    } // End Method

    public function DetailsSupplier($id)
    {

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.details_supplier', compact('supplier'));

    } // End Method

}
