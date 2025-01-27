<?php

namespace App\Http\Controllers\Admin\Master;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\MasterEwallet;

class MasterEwalletController extends Controller
{
    //
     /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = MasterEwallet::all();
        return view('admin.master.ewallet.index',compact('data'));   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.master.ewallet.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validasi format hex color
            'color2' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validasi format hex color
        ]);

        $data['name'] = $request->input('name');
        $data['color'] = $request->input('color');
        $data['color2'] = $request->input('color2');

        $create = MasterEwallet::create($data);

        return redirect()->route('ewallet.index')->with('success', 'Data berhasil disimpan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(MasterEwallet $ewallet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MasterEwallet $ewallet)
    {
        $data = $ewallet;
        return view('admin.master.ewallet.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MasterEwallet $ewallet)
    {
        $request->validate([
            'name' => 'required|max:255',
            'color' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validasi format hex color
            'color2' => 'required|regex:/^#[0-9A-Fa-f]{6}$/', // Validasi format hex color
        ]);

        $data['name'] = $request->input('name');
        $data['color'] = $request->input('color');
        $data['color2'] = $request->input('color2');

        $update = $ewallet->update($data);

        return redirect()->route('ewallet.index')->with('success', 'Data berhasil Diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MasterEwallet $ewall)
    {
        //
    }
}
