<?php

namespace App\Http\Controllers\LogIn;

use App\Http\Controllers\Controller;
use App\Mail\VendorReq_Notification;
use App\Models\Admin;
use App\Models\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    public function showRegisterForm()
    {
        return view("Frontend.VendorReg");
    }
    public function registration(Request $request)
    {
        // ============================================
        // 1. VALIDATION RULES
        // ============================================
        $validated = $request->validate([
            // Personal Information
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email|unique:users,email',
            'contact_no' => 'required|string|max:20',

            // Business Information
            'company_name' => 'required|string|max:255',
            'reg_no' => 'required|string|max:100|unique:vendors,reg_no',

            // Logo
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',

            // Address
            'address' => 'nullable|string|max:500',
            'city' => 'nullable|string|max:100',

            // Terms
            'terms' => 'accepted',
        ], );

        $vendor = new Vendors();
        $vendor->name = $request->name;
        $vendor->email = $request->email;
        $vendor->company_name = $request->company_name;
        $vendor->reg_no = $validated['reg_no'];
        $file = $request->file('logo');
        if ($file) {
            $file_name = time() . "." . $file->getClientOriginalExtension();
            $file->move('storage', $file_name);
            $vendor->logo = $file_name;
        }
        $vendor->contact_no = $request->contact_no;
        $vendor->save();
        //Email send to admin
        //$admin = Admin::first();
        Mail::to("dipeshrana255@gmail.com")->send(new VendorReq_Notification($vendor));

        return redirect()->route('Frontend.VendorSuccess')
            ->with('success', 'Registration submitted successfully! We have sent you an email with your login credentials.');
    }
    public function RegisterSuccess()
    {
        return view("Frontend.VendorSuccess");
    }
}
