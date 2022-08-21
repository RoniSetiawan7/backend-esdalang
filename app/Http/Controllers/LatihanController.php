<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Latihan;
use App\Models\Materi;
use App\Models\Pertanyaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LatihanController extends Controller
{
    public function indexLatihan()
    {
        $ex = Latihan::all();
        return view('latihan.indexLatihan')->with(['ex' => $ex]);
    }

    public function createLatihan()
    {
        $class = Kelas::all();
        $teacher = Guru::all();
        return view('latihan.createLatihan')->with(['class' => $class, 'teacher' => $teacher]);
    }

    public function storeLatihan(Request $request)
    {
        $request->validate(
            [
                'kode_latihan' => 'required|unique:latihan',
                'nm_latihan' => 'required',
                'id_kelas' => 'required',
                'id_guru' => 'required',
            ],
            [
                'kode_latihan.required' => 'Kode Latihan wajib diisi',
                'kode_latihan.unique' => 'Kode Latihan telah digunakan',
                'nm_latihan.required' => 'Nama Latihan wajib diisi',
                'id_kelas.required' => 'Kelas wajib diisi',
                'id_guru.required' => 'Guru Pengajar wajib diisi',
            ]
        );

        $ex = new Latihan;
        $ex->kode_latihan = $request->kode_latihan;
        $ex->nm_latihan = $request->nm_latihan;
        $ex->id_kelas = $request->id_kelas;
        $ex->id_guru = $request->id_guru;

        $ex->save();
        $request->session()->put('ex-key', $ex->kode_latihan);
        $request->session()->put('ex', $ex);
        session()->flash('success', 'Data latihan ditambahkan.');
        return redirect()->route('createPertanyaan');
    }

    public function editLatihan(Latihan $ex)
    {
        $class = Kelas::all();
        $teacher = Guru::all();
        return view('latihan.editLatihan')->with(['class' => $class, 'teacher' => $teacher, 'ex' => $ex]);
    }

    public function updateLatihan(Request $request, Latihan $ex)
    {
        $request->validate(
            [
                'kode_latihan' => 'required',
                'nm_latihan' => 'required',
                'id_kelas' => 'required',
                'id_guru' => 'required',
            ],
            [
                'kode_latihan.required' => 'Kode Latihan wajib diisi',
                'nm_latihan.required' => 'Nama Latihan wajib diisi',
                'id_kelas.required' => 'Kelas wajib diisi',
                'id_guru.required' => 'Guru Pengajar wajib diisi',
            ]
        );

        $ex->kode_latihan = $request->kode_latihan;
        $ex->nm_latihan = $request->nm_latihan;
        $ex->id_kelas = $request->id_kelas;
        $ex->id_guru = $request->id_guru;

        $ex->update();
        session()->flash('success', 'Data latihan diperbarui.');
        return redirect()->route('detailLatihanPertanyaan', $ex->kode_latihan);
    }

    public function deleteLatihan(Latihan $ex)
    {
        $ex->delete();
        session()->flash('success', 'Data latihan dihapus.');
        return redirect()->route('indexLatihan');
    }

    public function createPertanyaan()
    {
        $subject = Materi::all();
        return view('latihan.createPertanyaan')->with(['subject' => $subject]);
    }

    public function storePertanyaan(Request $request)
    {
        $request->validate(
            [
                'soal' => 'required',
                'jawaban_benar' => 'required',
                'jawaban_salah_1' => 'required',
                'jawaban_salah_2' => 'required',
                'jawaban_salah_3' => 'required',
                'ket_gambar' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
                'image_path' => 'nullable',
                'id_materi' => 'required',
            ],
            [
                'soal.required' => 'Soal wajib diisi',
                'jawaban_benar.required' => 'Jawaban Benar wajib diisi',
                'jawaban_salah_1.required' => 'Jawaban Salah Ke-1 wajib diisi',
                'jawaban_salah_2.required' => 'Jawaban Salah Ke-2 wajib diisi',
                'jawaban_salah_3.required' => 'Jawaban Salah Ke-3 wajib diisi',
                'ket_gambar.mimes' => 'Keterangan Gambar hanya berupa file jpeg,bmp,png,jpg',
                'ket_gambar.max' => 'Ukuran Keterangan Gambar tidak boleh lebih dari 2MB',
                'id_materi.required' => 'Nama Materi wajib diisi',
            ]
        );

        $qs = new Pertanyaan;
        $qs->soal = $request->soal;
        $qs->jawaban_benar = $request->jawaban_benar;
        $qs->jawaban_salah_1 = $request->jawaban_salah_1;
        $qs->jawaban_salah_2 = $request->jawaban_salah_2;
        $qs->jawaban_salah_3 = $request->jawaban_salah_3;
        $qs->id_materi = $request->id_materi;

        $id_latihan = session()->get('ex-key');
        $qs['id_latihan'] = "$id_latihan";

        if ($file = $request->file('ket_gambar')) {
            $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/latihan/', $nama_file);
            $qs['ket_gambar'] = "$nama_file";

            $path = Storage::url('public/latihan/' . $nama_file);
            $qs['image_path'] = "$path";
        }

        $qs->save();
        session()->flash('success', 'Data soal ditambahkan.');
        return redirect()->route('createPertanyaan');
    }

    public function editPertanyaan(Pertanyaan $qs)
    {
        $subject = Materi::all();
        return view('latihan.editPertanyaan')->with(['qs' => $qs, 'subject' => $subject]);
    }

    public function updatePertanyaan(Request $request, Pertanyaan $qs)
    {
        $request->validate(
            [
                'soal' => 'required',
                'jawaban_benar' => 'required',
                'jawaban_salah_1' => 'required',
                'jawaban_salah_2' => 'required',
                'jawaban_salah_3' => 'required',
                'ket_gambar' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
                'image_path' => 'nullable',
                'id_materi' => 'required',
            ],
            [
                'soal.required' => 'Soal wajib diisi',
                'jawaban_benar.required' => 'Jawaban Benar wajib diisi',
                'jawaban_salah_1.required' => 'Jawaban Salah Ke-1 wajib diisi',
                'jawaban_salah_2.required' => 'Jawaban Salah Ke-2 wajib diisi',
                'jawaban_salah_3.required' => 'Jawaban Salah Ke-3 wajib diisi',
                'ket_gambar.mimes' => 'Keterangan Gambar hanya berupa file jpeg,bmp,png,jpg',
                'ket_gambar.max' => 'Ukuran Keterangan Gambar tidak boleh lebih dari 2MB',
                'id_materi.required' => 'Nama Materi wajib diisi',
            ]
        );

        $input = $request->all();

        if ($request->ket_gambar != '') {
            $path = storage_path() . '/app/public/latihan/';

            if ($qs->ket_gambar != ''  && $qs->ket_gambar != null) {
                $file_old = $path . $qs->ket_gambar;
                unlink($file_old);
            }

            if ($file = $request->file('ket_gambar')) {
                $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
                $file->storeAs('public/latihan/', $nama_file);
                $input['ket_gambar'] = "$nama_file";

                $path = Storage::url('public/latihan/' . $nama_file);
                $input['image_path'] = "$path";
            }
        }

        $qs->update($input);
        session()->flash('success', 'Soal diperbarui.');
        return redirect()->route('detailLatihanPertanyaan',  $qs->id_latihan);
    }

    public function deletePertanyaan(Pertanyaan $qs)
    {
        $qs->delete();
        Storage::delete('public/latihan/' . $qs->ket_gambar);
        session()->flash('success', 'Soal dihapus.');
        return redirect()->back();
    }

    public function addMorePertanyaan(Latihan $ex)
    {
        $subject = Materi::all();
        return view('latihan.addMorePertanyaan')->with(['ex' => $ex, 'subject' => $subject]);
    }

    public function storeMorePertanyaan(Request $request, Latihan $ex)
    {
        $request->validate(
            [
                'soal' => 'required',
                'jawaban_benar' => 'required',
                'jawaban_salah_1' => 'required',
                'jawaban_salah_2' => 'required',
                'jawaban_salah_3' => 'required',
                'ket_gambar' => 'nullable|mimes:jpeg,bmp,png,jpg|max:2048',
                'image_path' => 'nullable',
                'id_materi' => 'required',
            ],
            [
                'soal.required' => 'Soal wajib diisi',
                'jawaban_benar.required' => 'Jawaban Benar wajib diisi',
                'jawaban_salah_1.required' => 'Jawaban Salah Ke-1 wajib diisi',
                'jawaban_salah_2.required' => 'Jawaban Salah Ke-2 wajib diisi',
                'jawaban_salah_3.required' => 'Jawaban Salah Ke-3 wajib diisi',
                'ket_gambar.mimes' => 'Keterangan Gambar hanya berupa file jpeg,bmp,png,jpg',
                'ket_gambar.max' => 'Ukuran Keterangan Gambar tidak boleh lebih dari 2MB',
                'id_materi.required' => 'Nama Materi wajib diisi',
            ]
        );

        $qs = new Pertanyaan;
        $qs->soal = $request->soal;
        $qs->jawaban_benar = $request->jawaban_benar;
        $qs->jawaban_salah_1 = $request->jawaban_salah_1;
        $qs->jawaban_salah_2 = $request->jawaban_salah_2;
        $qs->jawaban_salah_3 = $request->jawaban_salah_3;
        $qs->ket_gambar = $request->ket_gambar;
        $qs->image_path = $request->image_path;
        $qs->id_materi = $request->id_materi;
        $qs->id_latihan = $ex->kode_latihan;

        if ($file = $request->file('ket_gambar')) {
            $nama_file = time() . '-' . str_replace(' ', '_', $file->getClientOriginalName());
            $file->storeAs('public/latihan/', $nama_file);
            $qs['ket_gambar'] = "$nama_file";

            $path = Storage::url('public/latihan/' . $nama_file);
            $qs['image_path'] = "$path";
        }

        $qs->save();
        session()->flash('success', 'Soal ditambahkan.');
        return redirect()->route('detailLatihanPertanyaan',  $ex->kode_latihan);
    }

    public function detailLatihanPertanyaan(Latihan $ex)
    {
        return view('latihan.detailLatihanPertanyaan')->with(['qs' => $ex->getPertanyaan, 'ex' => $ex]);
    }

    public function updateStatus(Request $request)
    {
        $ex = Latihan::findOrFail($request->kode_latihan);
        $ex->status = $request->status;
        $ex->save();

        return response(['message' => 'Status latihan diperbarui.']);
    }
}
