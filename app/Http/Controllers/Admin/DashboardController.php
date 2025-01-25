<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $urls = \AshAllenDesign\ShortURL\Models\ShortURL::latest()->get();
        
        return view('admin.home');
    }
}
