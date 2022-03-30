<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Latihan;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class HasilLatihan extends Model
{
    use HasFactory;
    protected $table = 'hasil_latihan';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'id_siswa', 'id_latihan', 'jawaban', 'nilai'];
    protected $hidden = ['created_at', 'updated_at'];

    public function getSiswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }

    public function getLatihan()
    {
        return $this->belongsTo(Latihan::class, 'id_latihan');
    }
}
