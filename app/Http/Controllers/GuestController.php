<?php

namespace App\Http\Controllers;

use App\Models\Ewallet;
use App\Models\MasterEwallet;
use App\Models\Project;
use Illuminate\Http\Request;

class GuestController extends Controller
{
    //
    public function index() {
        return view('welcome');
    }
    public function show($id) {
        $data = Project::find($id);
        
        $ewallet = Ewallet::where('project_id',$id)->get();
        
        foreach ($ewallet as &$value) {
            $mwall = MasterEwallet::find($value->ewallet_id);
            $value->color = $mwall->color;
            $value->color2 = $mwall->color2;
            $value->ewallet_name = $mwall->name;
        }

        $data['ewallet'] = $ewallet;
        return view('show',compact('data'));
    }
}
