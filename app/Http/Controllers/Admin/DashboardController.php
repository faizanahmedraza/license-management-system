<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\License;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $customerCount = User::where('user_type',User::USER_TYPE['customer'])->count();
        $productCount = Product::count();
        $licenseCount = License::count();
        $licenses = License::latest()->get()->take(5);
        return view('admin.dashboard',compact('customerCount','productCount','licenses','licenseCount'));
    }
}
