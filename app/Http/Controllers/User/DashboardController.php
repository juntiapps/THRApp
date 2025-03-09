<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ClickLog;
use App\Models\Ewallet;
use App\Models\MasterEwallet;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use AshAllenDesign\ShortURL\Models\ShortURL;
use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use AshAllenDesign\ShortURL\Classes\Builder;
use Carbon\Carbon;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $data['name'] = $user->name;
        $data['projects'] = Project::where('user_id', $user->id)->get();
        // $_projects = Project::where('user_id', $user->id)->get();
        // $projects = $_projects->map(function ($item) {
        //     $item->url = url("projects/$item->id");
        //     return $item;
        // });
        // $data['projects'] = $projects;
        return view('user.home', compact('data'));
    }

    public function create()
    {
        return view('user.projects.create');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|max:255',
            'shopee' => 'nullable|url',
            'dana' => 'nullable|url',
            'gopay' => 'nullable|url',
        ]);

        if (!$request->shopee && !$request->dana && !$request->gopay) {
            return redirect()->route('u.projects.create')->with('error', 'Salah satu URL harus diisi!')->with('name', $request->name);
        }

        $data['name'] = $request->input('name');
        $data['user_id'] = $user->id;

        DB::beginTransaction();

        $project = Project::create($data);

        $project_id = $project->id;

        if ($request->shopee) {
            $create_shopee = Ewallet::create([
                'project_id' => $project_id,
                'ewallet_id' => 1,
                'url' => $request->shopee
            ]);
        }

        if ($request->dana) {
            $create_dana = Ewallet::create([
                'project_id' => $project_id,
                'ewallet_id' => 2,
                'url' => $request->dana
            ]);
        }

        if ($request->gopay) {
            $create_gopay = Ewallet::create([
                'project_id' => $project_id,
                'ewallet_id' => 3,
                'url' => $request->gopay
            ]);
        }

        DB::commit();
        return redirect()->route('user_home')->with('success', 'Data berhasil disimpan!');
    }

    public function show(Project $project)
    {
        $project->url = url("projects/$project->id");
        $project->qr = QrCode::size(200)->generate($project->url);

        $s = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 1])->first();
        $d = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 2])->first();
        $g = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 3])->first();

        $project->shopee = $s != null ? $s->url : $s;
        $project->dana = $d != null ? $d->url : $d;
        $project->gopay = $g != null ? $g->url : $g;

        $count['s'] = $s != null ? ClickLog::where('url_id', $s->id)->count() : '-';
        $count['d'] = $d != null ? ClickLog::where('url_id', $d->id)->count() : '-';
        $count['g'] = $g != null ? ClickLog::where('url_id', $g->id)->count() : '-';

        $data = $project;
        return view('user.projects.show', compact('data', 'count'));
    }

    public function edit(Project $project)
    {
        $s = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 1])->first();
        $d = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 2])->first();
        $g = Ewallet::where(['project_id' => $project->id, 'ewallet_id' => 3])->first();

        $project->shopee = $s != null ? $s->url : $s;
        $project->dana = $d != null ? $d->url : $d;
        $project->gopay = $g != null ? $g->url : $g;

        $data = $project;
        return view('user.projects.edit', compact('data'));
    }

    public function update(Request $request, Project $project)
    {
        $user = Auth::user();
        $request->validate([
            'name' => 'required|max:255',
            'shopee' => 'nullable|url',
            'dana' => 'nullable|url',
            'gopay' => 'nullable|url',
        ]);

        if (!$request->shopee && !$request->dana && !$request->gopay) {
            return redirect()->route('u.projects.edit', $project)->with('error', 'Salah satu URL harus diisi!');
        }

        $data['name'] = $request->input('name');

        DB::beginTransaction();
        $project_id = $project->id;
        $update = $project->update($data);

        if ($request->shopee) {
            $update_shopee = Ewallet::where([
                'project_id' => $project_id,
                'ewallet_id' => 1,
            ])->first();

            if ($update_shopee) {
                $update_shopee->url = $request->shopee;
                $update_shopee->save();
            } else {
                Ewallet::create([
                    'project_id' => $project_id,
                    'ewallet_id' => 1,
                    'url' => $request->shopee
                ]);
            }
        }

        if ($request->dana) {
            $update_dana = Ewallet::where([
                'project_id' => $project_id,
                'ewallet_id' => 2,
            ])->first();

            if ($update_dana) {
                $update_dana->url = $request->dana;
                $update_dana->save();
            } else {
                Ewallet::create([
                    'project_id' => $project_id,
                    'ewallet_id' => 1,
                    'url' => $request->dana
                ]);
            }
        }

        if ($request->gopay) {
            $update_gopay = Ewallet::where([
                'project_id' => $project_id,
                'ewallet_id' => 3,
            ])->first();

            if ($update_gopay) {
                $update_gopay->url = $request->gopay;
                $update_gopay->save();
            } else {
                Ewallet::create([
                    'project_id' => $project_id,
                    'ewallet_id' => 3,
                    'url' => $request->gopay
                ]);
            }
        }

        DB::commit();
        return redirect()->route('user_home')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(Project $project)
    {
        DB::beginTransaction();
        $delete_ewallet = Ewallet::where('project_id', $project->id)->delete();
        $delete_project = $project->delete();
        DB::commit();

        return redirect()->route('user_home')->with('success', 'Data berhasil dihapus!');
    }

    public function visitor(Project $project) {
        $d = Ewallet::where(['project_id' => $project->id])->get();
        $d = $d->map(function ($item) {
            return $item->id;
        });
        $data['log'] = ClickLog::whereIn('url_id',$d)->get();
        $data['project_id'] = $project->id;
        
        return view('user.projects.visitor',compact('data'));
    }

    public function destroyIP($project_id,$id)
    {
        // dd($log);
        $log = ClickLog::find($id);
        DB::beginTransaction();
        $log->delete();
        DB::commit();

        return redirect()->route('u.projects.visitor',$project_id)->with('success', 'Data berhasil dihapus!');
    }

    public function setting()
    {
        $data = Auth::user();
        return view('user.setting', compact('data'));
    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();

        // dd($user);
        DB::beginTransaction();

        $projects = Project::where('user_id', $user->id)->get();

        // dd($projects);
        foreach ($projects as $key => $project) {
            $delete_ewallet = Ewallet::where('project_id', $project->id)->delete();
        }

        if (count($projects) > 0) {
            $projects->delete();
        }

        $user->delete();

        DB::commit();

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda berhasil dihapus.');
    }
}
