<?php

namespace App\Models;

use App\Models\Materi;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = 'kurikulum';
    protected $primaryKey = 'kode_kurikulum';
    protected $fillable = ['kode_kurikulum', 'id_materi', 'id_kelas', 'file_kurikulum', 'file_path', 'keterangan'];
    protected $hidden = ["created_at", "updated_at"];
    public $incrementing = false;

    public function getMateri()
    {
        return $this->belongsTo(Materi::class, 'id_materi');
    }

    public function getKelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
