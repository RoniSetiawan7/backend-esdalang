<?php

namespace App\Models;

use App\Models\Materi;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Guru extends Model
{
    use HasFactory;
    protected $table = 'guru';
    protected $primaryKey = 'nip';
    protected $fillable = ['nip', 'nm_guru', 'jk', 'alamat', 'no_telp'];
    protected $hidden = ["created_at", "updated_at"];

    public function getMateri()
    {
        return $this->hasMany(Materi::class, 'id_guru');
    }

    public function getLatihan()
    {
        return $this->hasMany(Latihan::class, 'id_guru');
    }
}
