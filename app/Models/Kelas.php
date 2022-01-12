<?php

namespace App\Models;

use App\Models\Siswa;
use App\Models\Materi;
use App\Models\Kurikulum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';
    protected $primaryKey = 'kode_kelas';
    protected $fillable = ['kode_kelas', 'nm_kelas'];

    public function getSiswa()
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }

    public function getMateri()
    {
        return $this->hasMany(Materi::class, 'id_kelas');
    }

    public function getLatihan()
    {
        return $this->hasMany(Latihan::class, 'id_kelas');
    }

    public function getKurikulum()
    {
        return $this->hasMany(Kurikulum::class, 'id_kelas');
    }
}
