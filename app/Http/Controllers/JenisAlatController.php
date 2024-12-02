<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JenisAlat;

class JenisAlatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis = JenisAlat::all();
        return view('jenisalat', ['jenis' => $jenis]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fungsi.tambahjenisalat');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        JenisAlat::create($request->except(['_token', 'submit']));
        return redirect('/admin/jenisalat');
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
        $jenis = JenisAlat::Find($id);
        return view('fungsi.editjenisalat', compact(['jenis']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $jenis = JenisAlat::Find($id);
        $jenis ->update($request->except('_token','submit'));
        return redirect('/admin/jenisalat');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jenis = JenisAlat::Find($id);
        $jenis -> delete();
        return redirect('/admin/jenisalat');
    }
}