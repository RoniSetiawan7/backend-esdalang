<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\HasilLatihan;
use App\Models\Kurikulum;
use App\Models\Latihan;
use App\Models\Materi;
use App\Models\Pertanyaan;

class DataApiController extends Controller
{
    //** API MATERI
    public function materi($id_kelas)
    {
        $subject = Materi::select(
            'nm_materi',
        )
            ->where('materi.id_kelas', $id_kelas)
            ->get()
            ->unique('nm_materi');

        foreach ($subject as $sub) {

            $data[] = [
                "nm_materi" => $sub->nm_materi,
            ];
        }

        if (isset($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json([]);
        }
    }

    //** API SUB MATERI
    public function subMateri($nm_materi)
    {
        $subSubject = Materi::select(
            'kode_materi',
            'nm_materi',
            'nm_kelas',
            'nm_guru',
            'bab',
            'file_materi',
            'materi_path'
        )
            ->join('kelas', 'materi.id_kelas', '=', 'kelas.kode_kelas')
            ->join('guru', 'materi.id_guru', '=', 'guru.nip')
            ->where('materi.nm_materi', $nm_materi)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($subSubject, 200);
    }

    //** API LATIHAN
    public function latihan($id_kelas)
    {
        $exercise = Latihan::select('kode_latihan', 'nm_latihan', 'id_kelas', 'nm_guru')
            ->join('guru', 'guru.nip', '=', 'latihan.id_guru')
            ->where('id_kelas', $id_kelas)
            ->where('status', 1)
            ->get();

        foreach ($exercise as $ex) {

            $data[] = [
                "kode_latihan" => $ex->kode_latihan,
                "nm_latihan" => $ex->nm_latihan,
                "id_kelas" => $ex->id_kelas,
                "nm_guru" => $ex->nm_guru,
            ];
        }

        if (isset($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json([]);
        }
    }

    //** API PERTANYAAN
    public function pertanyaan($id_latihan)
    {
        $question = Pertanyaan::select(
            'id_latihan',
            'id',
            'soal',
            'jawaban_benar',
            'jawaban_salah_1',
            'jawaban_salah_2',
            'jawaban_salah_3',
            'ket_gambar',
            'image_path',
            'kode_materi',
            'nm_materi',
            'bab',
            'materi_path'
        )
            ->join('materi', 'materi.kode_materi', '=', 'pertanyaan.id_materi')
            ->join('latihan', 'latihan.kode_latihan', '=', 'pertanyaan.id_latihan')
            ->where('pertanyaan.id_latihan', $id_latihan)
            ->get();

        foreach ($question as $qs) {

            $data[] = [
                "id_latihan" => $qs->id_latihan,
                "id" => $qs->id,
                "soal" => $qs->soal,
                "ket_gambar" => $qs->ket_gambar,
                "image_path" => $qs->image_path,
                "kode_materi" => $qs->kode_materi,
                "nm_materi" => $qs->nm_materi,
                "bab" => $qs->bab,
                "materi_path" => $qs->materi_path,
                "jawaban_benar" => $qs->jawaban_benar,
                "jawaban_salah" => array(
                    $qs->jawaban_salah_1, $qs->jawaban_salah_2, $qs->jawaban_salah_3
                )

            ];
        }

        if (isset($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json([]);
        }
    }

    //** API HASIL LATIHAN
    public function hasilLatihan($id_latihan, $id_siswa)
    {
        $result = HasilLatihan::select(
            'id',
            'id_siswa',
            'id_latihan',
            'jawaban',
            'nilai'
        )
            ->where('hasil_latihan.id_siswa', $id_siswa)
            ->where('hasil_latihan.id_latihan', $id_latihan)
            ->get();

        return response()->json($result, 200);
    }

    //** API KURIKULUM
    public function kurikulum($id_kelas)
    {
        $curriculum = Kurikulum::select(
            'kode_kurikulum',
            'nm_materi',
            'nm_kelas',
            'file_kurikulum',
            'kurikulum_path',
            'keterangan'
        )
            ->join('kelas', 'kurikulum.id_kelas', '=', 'kelas.kode_kelas')
            ->join('materi', 'kurikulum.id_materi', '=', 'materi.kode_materi')
            ->where('kurikulum.id_kelas', $id_kelas)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($curriculum, 200);
    }
}
