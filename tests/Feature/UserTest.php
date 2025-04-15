<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testLogin()
    {
        $this->post("api/login",["email"=>"yadi@gmail.com","password"=>"1234567"])
        ->assertJson([""]);

    }

    public function testGetUser()
    {
        $this->withHeaders(["Authorization"=> "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->get("/api/user")
        ->assertJson([""]);
    }

    public function testGetUserFailed()
    {
        $this->withHeaders(["Authorization"=> "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->get("/api/user")
        ->assertJson([""]);
    }

    public function testAddUser()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->post("api/user/add", 
        [
            "name"=>"yadhi",
            "email"=>"yadhi8@gmail.com",
            "password"=>"12345678"
        ])
        ->assertStatus(201)
        ->assertJson(["success"=>"data berhasil ditambahkan"]);
    }

    public function testAddUserFailed()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->post("api/user/add", 
        [
            "name"=>"",
            "email"=>"yadhi1@gmail.com",
            "password"=>"12345678"
        ])
        ->assertStatus(400)
        ->assertJson(["success"=>"failed"]);
    }

    public function testDeleteUser()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->get('api/user/4')
        ->assertStatus(200)
        ->assertJson(["success"=>"data berhasil dihapus"]);
    }
    public function testDeleteUserFailed()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->get('api/user/4')
        ->assertStatus(400)
        ->assertJson(["failed"=>"data tidak ditemukan"]);
    }

    public function testUpdateUser()
    {
        $this->withHeaders(["Authorization"=>"Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0L2FwaS9sb2dpbiIsImlhdCI6MTc0NDY0MjExMywiZXhwIjoxNzQ0NjQ1NzEzLCJuYmYiOjE3NDQ2NDIxMTMsImp0aSI6IlFQWUo2bmVhT0FybUhWTkIiLCJzdWIiOiIxIiwicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.kI6mfVocvnIYpjS1KNPtVKvnh1TlbCUG8AApZ1WKmvc"])
        ->patch('api/userUpdate/5',["name"=>"arin2"])
        ->assertStatus(200)
        ->assertJson(["success"=>"data berhasil diubah"]);
    }
}
