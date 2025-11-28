<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
            
            return redirect()->route('shop.index');
        } else {
            return redirect('login');
        }
    }
}