<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MasterEwallet;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // $urls = \AshAllenDesign\ShortURL\Models\ShortURL::latest()->get();
        $ewallet['count'] = MasterEwallet::count();
        $ewallet['route'] = route('ewallet.index');

        $user['count'] = User::where('role','user')->count();
        $user['route'] = route('users.index');

        $project['count'] = Project::count();
        $project['route'] = route('projects.index');

        return view('admin.home',compact('ewallet','user','project'));
    }
}
