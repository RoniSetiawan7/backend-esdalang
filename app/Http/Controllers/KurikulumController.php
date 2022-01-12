<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Kurikulum;
use App\Models\Materi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KurikulumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $curriculum = Kurikulum::all();
        $subject = Materi::all();
        $filterSubject = Materi::all()->unique('nm_materi');
        $class = Kelas::all();
        if ($request->is('api/*')) {
            return response()->json($curriculum, 200);
        }
        return view('kurikulum.index-kurikulum', compact('curriculum', 'subject', 'class', 'filterSubject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $subject = Materi::all();
        $filterSubject = Materi::all()->unique('nm_materi');
        $class = Kelas::all();
        return view('kurikulum.create-kurikulum', compact('subject', 'class', 'filterSubject'));
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
                'kode_kurikulum' => 'required|unique:kurikulum',
                'id_materi' => 'required',
                'id_kelas' => 'required',
                'file_kurikulum' => 'required|mimes:PDF,pdf|max:2048',
                'keterangan' => 'nullable'
            ],
            [
                'kode_kurikulum.required' => 'ID Kurikulum wajib diisi',
                'kode_kurikulum.unique' => 'ID Kurikulum telah digunakan',
                'id_materi.required' => 'Nama Materi wajib diisi',
                'id_kelas.required' => 'Nama Kelas wajib diisi',
                'file_kurikulum.required' => 'File Kurikulum wajib diisi',
                'file_kurikulum.mimes' => 'File Kurikulum hanya dapat berupa format PDF dan pdf',
                'file_kurikulum.max' => 'Ukuran File Materi tidak boleh lebih dari 2MB',
            ]
        );
        $input = $request->all();

        if ($file = $request->file('file_kurikulum')) {
            $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/kurikulum/', $nama_file);
            $input['file_kurikulum'] = "$nama_file";

            $path = Storage::url('public/kurikulum/' . $nama_file);
            $input['file_path'] = "$path";
        }

        Kurikulum::create($input);
        session()->flash('success', 'Data kurikulum ditambahkan.');
        return redirect()->route('index-kurikulum');
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
        $curriculum = Kurikulum::find($id);
        $subject = Materi::all();
        $filterSubject = Materi::all()->unique('nm_materi');
        $class = Kelas::all();
        return view('kurikulum.edit-kurikulum', compact('curriculum', 'subject', 'class', 'filterSubject'));
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
                'kode_kurikulum' => 'required',
                'id_materi' => 'required',
                'id_kelas' => 'required',
                'file_kurikulum' => 'nullable|mimes:PDF,pdf|max:2048',
                'keterangan' => 'nullable'
            ],
            [
                'kode_kurikulum.required' => 'ID Kurikulum wajib diisi',
                'id_materi.required' => 'Nama Materi wajib diisi',
                'id_kelas.required' => 'Nama Kelas wajib diisi',
                'file_kurikulum.mimes' => 'File Kurikulum hanya dapat berupa format PDF dan pdf',
                'file_kurikulum.max' => 'Ukuran File Materi tidak boleh lebih dari 2MB',
            ]
        );
        $curriculum = Kurikulum::find($id);
        $input = $request->all();

        if ($request->file_kurikulum != '') {
            $path = storage_path() . '/app/public/kurikulum/';

            if ($curriculum->file_kurikulum != ''  && $curriculum->file_kurikulum != null) {
                $file_old = $path . $curriculum->file_kurikulum;
                unlink($file_old);
            }

            if ($file = $request->file('file_kurikulum')) {
                $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/kurikulum/', $nama_file);
                $input['file_kurikulum'] = "$nama_file";

                $path = Storage::url('public/kurikulum/' . $nama_file);
                $input['file_path'] = "$path";
            }
        }

        $curriculum->update($input);
        session()->flash('success', 'Data kurikulum diperbarui.');
        return redirect()->route('index-kurikulum');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curriculum = Kurikulum::find($id);
        $curriculum->delete();
        Storage::delete('public/kurikulum/' . $curriculum->file_kurikulum);
        session()->flash('success', 'Data kurikulum dihapus.');
        return redirect()->route('index-kurikulum');
    }
}
