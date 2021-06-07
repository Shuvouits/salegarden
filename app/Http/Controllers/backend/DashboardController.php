<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\ProductModel;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller {

    public function pagenotfound() {
        return view('errors.503');
    }
    
    public function dashboard() {
        $company = User::where('users_type', 'Company')->count();
        $user = User::where('users_type', 'User')->count();
        $activeProduct = ProductModel::where('product_status', 'Active')->count();
        $inActiveProduct = ProductModel::where('product_status', 'Inactive')->count();
        return view('backend.pages.dashboard.index', compact('company', 'user', 'activeProduct', 'inActiveProduct'));
    }

    public function adminDashboard() {
        $company = User::where('users_type', 'Company')->count();
        $user = User::where('users_type', 'User')->count();
        $activeProduct = ProductModel::where('product_status', 'Active')->count();
        $inActiveProduct = ProductModel::where('product_status', 'Inactive')->count();
        return view('backend.pages.dashboard.admin', compact('company', 'user', 'activeProduct', 'inActiveProduct'));
    }

    public function userDashboard() {
        $product = ProductModel::where('product_users_id', Auth::user()->users_track_id)->where('product_division', 'Normal')->count();
        return view('backend.pages.dashboard.user', compact('product'));
    }

    public function companyDashboard() {
        $product = ProductModel::where('product_users_id', Auth::user()->users_track_id)->where('product_division', 'Normal')->count();
        $preOrderProduct = ProductModel::where('product_users_id', Auth::user()->users_track_id)->where('product_division', 'PreOrder')->count();
        return view('backend.pages.dashboard.company', compact('product', 'preOrderProduct'));
    }

}
