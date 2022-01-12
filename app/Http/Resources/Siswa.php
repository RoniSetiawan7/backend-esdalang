<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Siswa extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'nm_siswa' => $this->nm_siswa,
            'jk' => $this->jk,
            'tempat_lahir' => $this->tempat_lahir,
            'tgl_lahir' => $this->tgl_lahir,
            'agama' => $this->agama,
            'alamat' => $this->alamat,
            'no_telp' => $this->no_telp,
            'id_kelas' => $this->id_kelas,
            'sub_kelas' => $this->sub_kelas,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
        ];
    }
}
