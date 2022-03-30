<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\Pertanyaan;
use App\Models\Guru;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Latihan extends Model
{
    use HasFactory;
    protected $table = 'latihan';
    protected $primaryKey = 'kode_latihan';
    protected $fillable = ['kode_latihan', 'nm_latihan', 'id_kelas', 'id_guru'];
    protected $hidden = ["created_at", "updated_at", "status"];
    public $incrementing = false;

    public function getPertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_latihan');
    }

    public function getGuru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    public function getHasilLatihan()
    {
        return $this->hasOne(HasilLatihan::class, 'id_latihan');
    }
}
