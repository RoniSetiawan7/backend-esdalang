<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Kurikulum;
use App\Models\Latihan;
use App\Models\Materi;
use App\Models\Pertanyaan;

class DataApiController extends Controller
{

    //API LATIHAN
    public function latihan()
    {
        $exercise = Latihan::select('kode_latihan', 'nm_latihan', 'id_kelas', 'nm_guru')
            ->join('guru', 'guru.nip', '=', 'latihan.id_guru')
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
            'pertanyaan.file_path',
            'kode_materi',
            'nm_materi',
            'bab'
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
                "file_path" => $qs->file_path,
                "kode_materi" => $qs->kode_materi,
                "nm_materi" => $qs->nm_materi,
                "bab" => $qs->bab,
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

    //API MATERI
    public function materi($id_kelas)
    {
        $subject = Materi::select(
            'materi.kode_materi',
            'materi.nm_materi',
            'kelas.nm_kelas',
            'guru.nm_guru',
            'materi.bab',
            'materi.file_materi',
            'materi.file_path'
        )
            ->join('kelas', 'materi.id_kelas', '=', 'kelas.kode_kelas')
            ->join('guru', 'materi.id_guru', '=', 'guru.nip')
            ->where('materi.id_kelas', $id_kelas)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($subject, 200);
    }

    //API KURIKULUM
    public function kurikulum($id_kelas)
    {
        // $curriculum = Kurikulum::where('id_kelas', $id_kelas)->get();
        // return response()->json($curriculum, 200);
        $curriculum = Kurikulum::select(
            'kurikulum.kode_kurikulum',
            'materi.nm_materi',
            'kelas.nm_kelas',
            'kurikulum.file_kurikulum',
            'kurikulum.file_path',
            'kurikulum.keterangan'
        )
            ->join('kelas', 'kurikulum.id_kelas', '=', 'kelas.kode_kelas')
            ->join('materi', 'kurikulum.id_materi', '=', 'materi.kode_materi')
            ->where('kurikulum.id_kelas', $id_kelas)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($curriculum, 200);
    }
}
