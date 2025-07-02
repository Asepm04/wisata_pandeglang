<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WisataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return 
        [
            "id"=> $this->id,
            "nama" =>$this->nama_wisata,
            "alamat"=>$this->alamat_wisata,
            "tiket"=>$this->tiket,
            "operasional"=>$this->jam_operasional,
            "deskripsi"=>$this->deskripsi,
            "gambar"=> asset('storage/gambar/'.$this->gambar),
            "url_update"=> url('api/wisata/update/'.$this->id),
            "url_delete"=> url('api/wisata/delet/'.$this->id)
        ];
    }

}