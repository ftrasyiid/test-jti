<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard berisi tombol link form input dan form output.
     *
     * @return Illuminate\Support\Facades\View
     */
    public function index()
    {
        session( ['api_key' => Auth::user()->api_token ] );
        return view('dashboard');
    }
}
