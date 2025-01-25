<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use AshAllenDesign\ShortURL\Models\ShortURL;
use AshAllenDesign\ShortURL\Models\ShortURLVisit;
use AshAllenDesign\ShortURL\Classes\Builder;
use Carbon\Carbon;

class DashboardController extends Controller
{
    //
    public function index()
    {
        // dd($url_visit);
        return view('user.home');
    }

    // public function create()
    // {
    //     DB::beginTransaction();
    //     // $builder = new \AshAllenDesign\ShortURL\Classes\Builder();
    //     $builder = new Builder();


    //     $shortURLObject = $builder->destinationUrl(request()->url)->make();

    //     $me = Auth::user();

    //     $url = ShortURL::find($shortURLObject->id);
    //     // dd($url);

    //     $url->user_id = $me->user_id;
    //     $url->save();
    //     db::commit();


    //     return back()->with('success', 'URL berhasil dipendekkan ');
    // }

    // public function update($id)
    // {
    //     DB::beginTransaction();

    //     $url = ShortURL::find($id);
    //     $url->url_key = request()->url;
    //     $url->destination_url = request()->destination;
    //     $short = $url->default_short_url;
    //     $e_short = explode('/', $short);
    //     $e_short[4] = request()->url;
    //     $short = implode("/", $e_short);
    //     // dd($short);
    //     $url->default_short_url = $short;
    //     $url->save();
    //     db::commit();

    //     return back()->with('success', 'URL berhasil diperbarui. ');
    // }

    // public function activate($id)
    // {
    //     # code...
    //     DB::beginTransaction();

    //     $url = ShortURL::find($id);
    //     // $mytime = \Carbon\Carbon::now();
    //     $url->deactivated_at = null;
    //     $url->save();
    //     db::commit();

    //     return back()->with('success', 'URL berhasil dinonaktifkan. ');
    // }

    // public function deactivate($id)
    // {
    //     DB::beginTransaction();

    //     $url = ShortURL::find($id);
    //     $mytime = Carbon::now();
    //     $url->deactivated_at = $mytime;
    //     $url->save();
    //     db::commit();

    //     return back()->with('success', 'URL berhasil dinonaktifkan. ');
    //     # code...
    // }
}
