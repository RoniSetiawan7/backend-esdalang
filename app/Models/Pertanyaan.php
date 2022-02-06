<?php

namespace App\Models;

use App\Models\Latihan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id', 'soal', 'jawaban_benar', 'jawaban_salah_1', 'jawaban_salah_2', 'jawaban_salah_3',
        'ket_gambar', 'file_path', 'id_materi', 'id_latihan'
    ];
    protected $hidden = ["created_at", "updated_at"];

    public function getLatihan()
    {
        return $this->belongsTo(Latihan::class, 'id_latihan');
    }

    public function getMateri()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }
}
