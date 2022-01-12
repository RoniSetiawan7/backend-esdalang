<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $teacher = Guru::all();
        return view('guru.index-guru', compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('guru.create-guru');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'nip' => 'required|unique:guru',
                'nm_guru' => 'required',
                'jk' => 'required',
                'alamat' => 'required',
                'no_telp' => 'nullable',
            ],
            [
                'nip.required' => 'NIP wajib diisi',
                'nip.unique' => 'NIP telah digunakan oleh guru lain',
                'nm_guru.required' => 'Nama wajib diisi',
                'jk.required' => 'Jenis Kelamin wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
            ]
        );
        Guru::create($request->all());
        session()->flash('success', 'Data guru ditambahkan.');
        return redirect()->route('index-guru');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teacher = Guru::find($id);
        return view('guru.edit-guru', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'nip' => 'required',
                'nm_guru' => 'required',
                'jk' => 'required',
                'alamat' => 'required',
                'no_telp' => 'nullable',
            ],
            [
                'nip.required' => 'NIP wajib diisi',
                'nm_guru.required' => 'Nama wajib diisi',
                'jk.required' => 'Jenis Kelamin wajib diisi',
                'alamat.required' => 'Alamat wajib diisi',
            ]
        );
        $teacher = Guru::find($id);
        $teacher->update($request->all());
        session()->flash('success', 'Data guru diperbarui.');
        return redirect()->route('index-guru');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $teacher = Guru::find($id);
        $teacher->delete();
        session()->flash('success', 'Data guru dihapus.');
        return redirect()->route('index-guru');
    }
}
