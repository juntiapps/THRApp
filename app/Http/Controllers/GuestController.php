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

        $ip = ClickLog::where('ip', request()->ip())->first();

        $data['ewallet'] = $ewallet;

        // dd($ip,$data);

        if ($data['filter_ip'] == 1) {
            $data['visited'] = $ip ? true : false;
        } else {
            $data['visited'] = false;
        }

        return response()->view('show', compact('data'))
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0')
            ->header('Pragma', 'no-cache')
            ->header('Expires', '0');
    }

    public function counter(Request $request)
    {
        $request->validate([
            'url_id' => 'integer|required',
            'project_id' => 'string|required'
        ]);

        // Cek apakah IP sudah pernah klik link dari project yang sama
        $existing = ClickLog::where('ip', request()->ip())
            ->join('ewallets', 'click_log.url_id', '=', 'ewallets.id')
            ->where('ewallets.project_id', $request->project_id)
            ->first();

        if ($existing) {
            return response()->json(['status' => 0, 'msg' => 'Anda sudah menggunakan salah satu link dari project ini']);
        }

        try {
            //code...
            DB::beginTransaction();
            $save = ClickLog::create([
                'url_id' => $request->url_id,
                'ip' => request()->ip()
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
