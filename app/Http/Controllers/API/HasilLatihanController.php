<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use App\Models\HasilLatihan;
use App\Models\Latihan;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Validator;

class HasilLatihanController extends BaseController
{
    public function create(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id_siswa' => 'required',
                'id_latihan' => 'required',
                'jawaban' => 'required',
                'nilai' => 'required',
            ],
            [
                'id_siswa.required' => 'NIS wajib diisi',
                'id_latihan.required' => 'Kode Latihan wajib diisi',
                'jawaban.required' => 'Jawaban wajib diisi',
                'nilai.required' => 'Nilai wajib diisi',
            ]
        );

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $hasil = HasilLatihan::create($input);

        $success['id_siswa'] = $hasil->id_siswa;
        $success['id_latihan'] = $hasil->id_latihan;
        $success['jawaban'] = $hasil->jawaban;
        $success['nilai'] = $hasil->nilai;

        return $this->sendResponse($success, 'Jawaban anda telah disimpan di server');
    }

    public function index(Request $request)
    {
        $result = HasilLatihan::all();
        $student = Siswa::all();
        $exercise = Latihan::all();
        return view('hasilLatihan.index-hasilLatihan', compact('result', 'student', 'exercise'));
    }

    public function show($id)
    {
        $result = HasilLatihan::find($id);
        return view('hasilLatihan.show-hasilLatihan', compact('result'));
    }

    public function destroy($id)
    {
        $result = HasilLatihan::find($id);
        $result->delete();
        session()->flash('success', 'Data hasil latihan dihapus.');
        return redirect()->route('index-hasilLatihan');
    }
}
