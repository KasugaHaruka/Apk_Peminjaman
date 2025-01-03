<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\JenisAlat;


class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alat = Alat::all();
        return view('alat', ['alat' => $alat]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = JenisAlat::all();
        return view('fungsi.tambahalat', compact('jenis'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Alat::create($request->except(['_token', 'submit']));
        return redirect('/admin/alat');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $alat = Alat::Find($id);
        $jenis = JenisAlat::all();
        return view('fungsi.editalat', compact(['alat','jenis']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $alat = Alat::Find($id);
        $alat ->update($request->except('_token','submit'));
        return redirect('/admin/alat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $alat = Alat::Find($id);
        $alat -> delete();
        return redirect('/admin/alat');
    }
}
