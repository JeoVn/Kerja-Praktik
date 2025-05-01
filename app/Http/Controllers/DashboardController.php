<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function ownerDashboard()
    {
        // Jika pengguna adalah owner, tampilkan dashboard owner
        return view('dashboard', ['role' => 'owner']);
    }

    public function adminDashboard()
    {
        // Jika pengguna adalah admin, tampilkan dashboard admin
        return view('dashboard', ['role' => 'admin']);
    }
}
