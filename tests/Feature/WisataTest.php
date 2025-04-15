<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;

class WisataTest extends TestCase
{
    public function testPostWisata()
    {
        $file = UploadedFile::fake()->create('curug.png');

        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDczMjA4MywiZXhwIjoxNzQ0NzM1Njg0LCJuYmYiOjE3NDQ3MzIwODQsImp0aSI6IlRvd3RpQ1Frb0N5SGJRV0UiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9._Xo1Nn9npKBV8TyMxemlro0TiZtc_qn2W959ZAdFj8I"])
        ->post('/api/wisata/add',
        [
            'nama_wisata'=>'curug carita',
            'alamat_wisata'=>'carita labuan',
            'tiket'=>'3000',
            "jam_operasional"=>'10:00-18:00',
            "deskripsi"=>"wisata curug carita",
            "gambar"=>$file
            ])
        ->assertStatus(201)
        ->assertJson(['message'=>"success"]);
        
    }

 
    
}
