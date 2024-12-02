<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kelas = Kelas::all();
        return view('kelas', ['kelas' => $kelas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fungsi.tambahkelas');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Kelas::create($request->except(['_token', 'submit']));
        return redirect('/admin/kelas');
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
        $kelas = Kelas::Find($id);
        return view('fungsi.editkelas', compact(['kelas']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $kelas = Kelas::Find($id);
        $kelas ->update($request->except('_token','submit'));
        return redirect('/admin/kelas');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = Kelas::Find($id);
        $kelas -> delete();
        return redirect('/admin/kelas');
    }
}
