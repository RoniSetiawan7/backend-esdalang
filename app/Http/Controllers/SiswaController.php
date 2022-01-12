<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $class = Kelas::all();
        $student = Siswa::all();
        return view('siswa.index-siswa', compact('student', 'class'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Siswa::find($id);
        return view('siswa.show-siswa', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $student = Siswa::find($id);
        $class = Kelas::all();
        return view('siswa.edit-siswa', compact('student', 'class'));
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
                'nis' => 'required',
                'nm_siswa' => 'required',
                'jk' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tgl_lahir' => 'nullable',
                'agama' => 'nullable',
                'alamat' => 'nullable',
                'no_telp' => 'nullable',
                'id_kelas' => 'nullable',
                'sub_kelas' => 'nullable',
            ],
            [
                'nis.required' => 'NIS wajib diisi',
                'nm_siswa.required' => 'Nama wajib diisi',
            ]
        );
        $student = Siswa::find($id);
        $student->update($request->all());
        session()->flash('success', 'Data siswa diperbarui.');
        return redirect()->route('index-siswa');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Siswa::find($id);
        $student->delete();
        session()->flash('success', 'Data siswa dihapus.');
        return redirect()->route('index-siswa');
    }
}
