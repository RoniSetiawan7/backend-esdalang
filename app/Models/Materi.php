<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Kurikulum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;
    protected $table = 'materi';
    protected $primaryKey = 'kode_materi';
    protected $fillable = ['kode_materi', 'nm_materi', 'id_kelas', 'id_guru', 'bab', 'file_materi', 'materi_path'];
    protected $hidden = ["created_at", "updated_at"];
    public $incrementing = false;

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function getGuru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function getKurikulum()
    {
        return $this->hasOne(Kurikulum::class, 'id_materi');
    }

    public function getPertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_materi');
    }
}
