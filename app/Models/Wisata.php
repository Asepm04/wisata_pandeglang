<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;

    protected $table = 'wisata';

    protected $fillable =
    [
            "id" ,
            "nama_wisata" ,
            "alamat_wisata",
            "tiket",
            "jam_operasional",
            "deskripsi",
            "gambar"
    ];
}
