<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $role = Auth::user()->role;

            if ($role == 'admin') {
                return redirect()->route('admin.home');
            }

            if ($role == 'seller') {
                return redirect()->route('seller.home');
            }

            return view('dashboard.user.home');
        } else {
            return redirect('login');
        }
    }
}