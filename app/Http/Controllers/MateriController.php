<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Materi::all();
        $filterSubject = Materi::all()->unique('nm_materi');
        $class = Kelas::all();
        return view('materi.index-materi', compact('subject', 'class', 'filterSubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $class = Kelas::all();
        $teacher = Guru::all();
        return view('materi.create-materi', compact('class', 'teacher'));
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
                'kode_materi' => 'required|unique:materi',
                'nm_materi' => 'required',
                'bab' => 'required',
                'id_kelas' => 'required',
                'id_guru' => 'required',
                'file_materi' => 'required|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:5120',
            ],
            [
                'kode_materi.required' => 'ID Materi wajib diisi',
                'kode_materi.unique' => 'ID Materi telah digunakan',
                'nm_materi.required' => 'Nama Materi wajib diisi',
                'bab.required' => 'Bab Materi wajib diisi',
                'id_kelas.required' => 'Kelas wajib diisi',
                'id_guru.required' => 'Guru Pengajar wajib diisi',
                'file_materi.required' => 'File Materi wajib diisi',
                'file_materi.mimes' => 'File Materi hanya dapat berupa format doc,docx,xls,xlsx,ppt,pptx,pdf',
                'file_materi.max' => 'Ukuran File Materi tidak boleh lebih dari 5MB',
            ]
        );
        $input = $request->all();

        if ($file = $request->file('file_materi')) {
            $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/materi/', $nama_file);
            $input['file_materi'] = "$nama_file";

            $path = Storage::url('public/materi/' . $nama_file);
            $input['materi_path'] = "$path";
        }

        Materi::create($input);
        session()->flash('success', 'Data materi ditambahkan.');
        return redirect()->route('index-materi');
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
        $subject = Materi::find($id);
        $class = Kelas::all();
        $teacher = Guru::all();
        return view('materi.edit-materi', compact('subject', 'class', 'teacher'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, Materi $subject)
    {
        $request->validate(
            [
                'kode_materi' => 'required',
                'nm_materi' => 'required',
                'bab' => 'required',
                'id_kelas' => 'required',
                'id_guru' => 'required',
                'file_materi' => 'nullable|mimes:doc,docx,xls,xlsx,ppt,pptx,pdf|max:5120'
            ],
            [
                'kode_materi.required' => 'ID Materi wajib diisi',
                'nm_materi.required' => 'Nama Materi wajib diisi',
                'bab.required' => 'Bab Materi wajib diisi',
                'id_kelas.required' => 'Kelas wajib diisi',
                'id_guru.required' => 'Guru Pengajar wajib diisi',
                'file_materi.mimes' => 'File Materi hanya dapat berupa format doc,docx,xls,xlsx,ppt,pptx,pdf',
                'file_materi.max' => 'Ukuran File Materi tidak boleh lebih dari 5MB',
            ]
        );
        $subject = Materi::find($id);
        $input = $request->all();

        if ($request->file_materi != '') {
            $path = storage_path() . '/app/public/materi/';

            if ($subject->file_materi != ''  && $subject->file_materi != null) {
                $file_old = $path . $subject->file_materi;
                unlink($file_old);
            }

            if ($file = $request->file('file_materi')) {
                $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/materi/', $nama_file);
                $input['file_materi'] = "$nama_file";

                $path = Storage::url('public/materi/' . $nama_file);
                $input['materi_path'] = "$path";
            }
        }

        $subject->update($input);
        session()->flash('success', 'Data materi diperbarui.');
        return redirect()->route('index-materi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Materi::find($id);
        $subject->delete();
        Storage::delete('public/materi/' . $subject->file_materi);
        session()->flash('success', 'Data materi dihapus.');
        return redirect()->route('index-materi');
    }
}
