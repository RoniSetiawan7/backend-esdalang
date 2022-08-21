<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $class = Kelas::all();
        $student = Siswa::all();
        return view('siswa.create-siswa', compact('class', 'student'));
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
                'nis' => 'required|unique:siswa',
                'nm_siswa' => 'required',
                'jk' => 'nullable',
                'tempat_lahir' => 'nullable',
                'tgl_lahir' => 'nullable',
                'agama' => 'nullable',
                'alamat' => 'nullable',
                'no_telp' => 'nullable',
                'id_kelas' => 'required',
                'sub_kelas' => 'required',
                'foto_siswa' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',

            ],
            [
                'nis.required' => 'NIS wajib diisi',
                'nis.unique' => 'NIS telah digunakan oleh siswa lain',
                'nm_siswa.required' => 'Nama wajib diisi',
                'id_kelas.required' => 'ID Kelas wajib diisi',
                'sub_kelas.required' => 'Sub Kelas wajib diisi',
                'foto_siswa.mimes' => 'Foto Siswa hanya berupa file jpeg,bmp,png,jpg',
                'foto_siswa.max' => 'Ukuran Foto Siswa tidak boleh lebih dari 2MB',
            ]
        );
        $input = $request->all();

        if ($file = $request->file('foto_siswa')) {
            $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/profile/', $nama_file);
            $input['foto_siswa'] = "$nama_file";

            $path = Storage::url('public/profile/' . $nama_file);
            $input['foto_path'] = "$path";
        }

        Siswa::create($input);
        session()->flash('success', 'Data siswa ditambahkan.');
        return redirect()->route('index-siswa');
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
                'id_kelas' => 'required',
                'sub_kelas' => 'required',
                'foto_siswa' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
            ],
            [
                'nis.required' => 'NIS wajib diisi',
                'nm_siswa.required' => 'Nama wajib diisi',
                'id_kelas.required' => 'ID Kelas wajib diisi',
                'sub_kelas.required' => 'Sub Kelas wajib diisi',
                'foto_siswa.mimes' => 'Foto Siswa hanya berupa file jpeg,bmp,png,jpg',
                'foto_siswa.max' => 'Ukuran Foto Siswa tidak boleh lebih dari 2MB',
            ]
        );
        $student = Siswa::find($id);
        $input = $request->all();

        if ($request->foto_siswa != '') {
            $path = storage_path() . '/app/public/profile/';

            if ($student->foto_siswa != ''  && $student->foto_siswa != null) {
                $file_old = $path . $student->foto_siswa;
                unlink($file_old);
            }

            if ($file = $request->file('foto_siswa')) {
                $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/profile/', $nama_file);
                $input['foto_siswa'] = "$nama_file";

                $path = Storage::url('public/profile/' . $nama_file);
                $input['foto_path'] = "$path";
            }
        }

        $student->update($input);
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
        Storage::delete('public/profile/' . $student->foto_siswa);
        session()->flash('success', 'Data siswa dihapus.');
        return redirect()->route('index-siswa');
    }
}
