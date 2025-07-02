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

        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDg5OTYwMywiZXhwIjoxNzQ0OTAzMjAzLCJuYmYiOjE3NDQ4OTk2MDMsImp0aSI6ImZsZWE0TzlPcllpOU9teFciLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PXCyry3C-oWFZ2omrNMM34-VmIs48pKxG_Qum1RMsLc"])
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

    public function testUpdateWisataa()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDg5OTYwMywiZXhwIjoxNzQ0OTAzMjAzLCJuYmYiOjE3NDQ4OTk2MDMsImp0aSI6ImZsZWE0TzlPcllpOU9teFciLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PXCyry3C-oWFZ2omrNMM34-VmIs48pKxG_Qum1RMsLc"])
        ->patch('/api/wisata/update/1',['tiket'=>"70000"])
        ->assertStatus(200)
        ->assertJson(["message"=>"data berhasil diubah"]);
    }

    public function testUpdateWisataFailed()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDg5OTYwMywiZXhwIjoxNzQ0OTAzMjAzLCJuYmYiOjE3NDQ4OTk2MDMsImp0aSI6ImZsZWE0TzlPcllpOU9teFciLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PXCyry3C-oWFZ2omrNMM34-VmIs48pKxG_Qum1RMsLc"])
        ->patch('/api/wisata/update/1',[''])
        ->assertStatus(400)
        ->assertJson(["message"=>"data gagal diubah"]);
    }

    public function testGetData()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc1MDU5OTY2NSwiZXhwIjoxNzUwNjAzMjY1LCJuYmYiOjE3NTA1OTk2NjYsImp0aSI6IkZzTndUY3o2MDhyQUt0UksiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.Tmdpkbv_rwcTQW0I0lScP-5TY3w8KPIvVmER5ctT3zU"])
        ->get('/api/wisata/')
        ->assertStatus(200)
        ->assertJson([""]);
    }

    public function testDelete()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDg5OTYwMywiZXhwIjoxNzQ0OTAzMjAzLCJuYmYiOjE3NDQ4OTk2MDMsImp0aSI6ImZsZWE0TzlPcllpOU9teFciLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PXCyry3C-oWFZ2omrNMM34-VmIs48pKxG_Qum1RMsLc"])
        ->delete('api/wisata/delete/3')
        ->assertStatus(200)
        ->assertJson(["message"=>"berhasil dihapus"]);
    }

    public function testDeleteFail()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDg5OTYwMywiZXhwIjoxNzQ0OTAzMjAzLCJuYmYiOjE3NDQ4OTk2MDMsImp0aSI6ImZsZWE0TzlPcllpOU9teFciLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.PXCyry3C-oWFZ2omrNMM34-VmIs48pKxG_Qum1RMsLc"])
        ->delete('api/wisata/delete/3')
        ->assertStatus(400)
        ->assertJson(["message"=>"data tidak ditemukan"]);
    }

 
    
}
