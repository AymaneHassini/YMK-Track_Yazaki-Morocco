<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Rules\EmailDomain;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function AdminDestroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Logout Done Successfully',
            'alert-type' => 'info'
        );

        return redirect('/logout')->with($notification);
    }
    public function AdminLogoutPage()
    {
        return view('admin.admin_logout');
    }
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }
    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'), $filename);
            $data['photo'] = $filename;
        }
            
        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }
    public function ChangePassword()
    {
        return view('admin.change_password');
    }
    public function UpdatePassword(Request $request)
{
    $request->validate([
        'old_password' => 'required',
        'new_password' => [
            'required',
            'confirmed',
            'min:8', 
            'string',
            'regex:/[a-z]/', // must contain at least one lowercase letter
            'regex:/[A-Z]/', // must contain at least one uppercase letter
            'regex:/[0-9]/', // must contain at least one number
            'regex:/[@$!%*#?&_\\-]/', // must contain a special character
        ],
    ], [
        // Custom messages for password validation
        'new_password.required' => 'The new password field is required.',
        'new_password.confirmed' => 'The password confirmation does not match.',
        'new_password.min' => 'The password must be at least 8 characters.',
        'new_password.regex' => 'The password must contain at least one lowercase letter, one uppercase letter, one number, and one special character.',
    ]);

    if (!Hash::check($request->old_password, auth()->user()->password)) {
        $notification = array(
            'message' => 'Incorrect Current Password !',
            'alert-type' => 'error'
        );
        return back()->with($notification);
    }

    User::whereId(auth()->user()->id)->update([
        'password' => Hash::make($request->new_password)
    ]);

    $notification = array(
        'message' => 'Password Changed Successfully',
        'alert-type' => 'success'
    );
    return back()->with($notification);
}


}
