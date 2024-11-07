<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function loginPage () {
        return view('public.login');
  }
  
    public function registerPage()
    {
        return view('auth.register');
    }


    public function dashboard()
    {
        return view('dashboard', ['level' => 'siswa']);
    }

    public function dashboardAdmin()
    {
        return view('admin.dashboard', ['level' => 'admin']);
    }
    
    

}
