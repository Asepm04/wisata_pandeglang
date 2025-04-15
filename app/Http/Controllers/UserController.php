<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UsrResource;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
   public function getUser()
   {
    $user = User::get();

    return  UsrResource::collection($user);
   }

   public function addUser(PostRequest $request)
   {
      $data = $request->validated();

      if($data)
      {
         $data['password'] = bcrypt($data['password']);
         $user =  User::create($data);

         return response()->json(["success"=>"data berhasil ditambahkan"],201);
      }
   }

   public function deleteUser($id)
   {
      if($id !== null)
      {
         $user = User::where("id",$id)->delete();
         if($user)
         {
            return response()->json(["success"=>"data berhasil dihapus"],200);
         }else{
            return response()->json(["failed"=>"data tidak ditemukan"],400);
         }

      }
      
   }

   public function UpdateUser(UpdateUserRequest $request,$id)
   {
      $user = User::findOrFail($id);

      if($user)
      {
         $user->update($request->validated());
         return response()->json(["success"=>"data berhasil diubah"],200);
      }
      else{
         return response()->json(["failed"=>"data gagal diubah"],400);

      }
   }
}

