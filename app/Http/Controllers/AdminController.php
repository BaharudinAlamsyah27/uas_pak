<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Pastikan nama file di folder resources/views/admin/dashboard.blade.php
        return view('admin.dashboard');
    }
}