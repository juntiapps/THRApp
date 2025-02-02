<?php

namespace App\Http\Controllers;

use App\Models\ClickLog;
use App\Models\Ewallet;
use App\Models\MasterEwallet;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuestController extends Controller
{
    //
    public function index()
    {
        return view('welcome');
    }
    public function show($id)
    {
        $data = Project::find($id);

        $ewallet = Ewallet::where('project_id', $id)->get();

        foreach ($ewallet as &$value) {
            $mwall = MasterEwallet::find($value->ewallet_id);
            $value->color = $mwall->color;
            $value->color2 = $mwall->color2;
            $value->ewallet_name = $mwall->name;
        }

        $data['ewallet'] = $ewallet;
        return view('show', compact('data'));
    }

    public function counter(Request $request)
    {
        $request->validate([
            'url_id' => 'integer|required'
        ]);

        try {
            //code...
            DB::beginTransaction();
            $save = ClickLog::create([
                'url_id' => $request->url_id
            ]);

            DB::commit();
            return response()->json(['status' => 1, 'msg' => 'success']);
        } catch (\Throwable $th) {
            //throw $th;
            DB::rollBack();
            // dd($th);
            return response()->json(['status' => 0, 'msg' => $th->getMessage()]);
        }
    }
}
