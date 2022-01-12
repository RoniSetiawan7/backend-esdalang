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
            $question = Pertanyaan::select(
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
                ->where('pertanyaan.id_latihan', '=', $ex->kode_latihan)
                ->get();

            foreach ($question as $qs) {

                $data[] = [
                    "kode_latihan" => $ex->kode_latihan,
                    "nm_latihan" => $ex->nm_latihan,
                    "id_kelas" => $ex->id_kelas,
                    "nm_guru" => $ex->nm_guru,
                    "pertanyaan"  => [[
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
                    ]]
                ];
            }
        }

        if (isset($data)) {
            return response()->json($data, 200);
        } else {
            return response()->json([]);
        }
    }

    //API MATERI
    public function materi7()
    {
        $materi7 = Materi::select(
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
            ->where('materi.id_kelas', 7)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($materi7, 200);
    }
    public function materi8()
    {
        $materi8 = Materi::select(
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
            ->where('materi.id_kelas', 8)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($materi8, 200);
    }
    public function materi9()
    {
        $materi9 = Materi::select(
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
            ->where('materi.id_kelas', 9)
            ->orderBy('nm_materi', 'asc')
            ->get();

        return response()->json($materi9, 200);
    }

    //API KURIKULUM
    public function kurikulum7()
    {
        $curriculum7 = Kurikulum::where('id_kelas', 7)->get();
        return response()->json($curriculum7, 200);
    }
    public function kurikulum8()
    {
        $curriculum8 = Kurikulum::where('id_kelas', 8)->get();
        return response()->json($curriculum8, 200);
    }
    public function kurikulum9()
    {
        $curriculum9 = Kurikulum::where('id_kelas', 9)->get();
        return response()->json($curriculum9, 200);
    }
}
