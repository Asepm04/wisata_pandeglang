<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Http\Requests\WisataRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UpdateWisataRequest;
use App\Http\Resources\WisataResource;

class WisataController extends Controller
{
    public function postWisata(WisataRequest $request)
    {
        $data  = $request->validated();

        Log::info(json_encode($data));

        if($data)
        {
            $file = $data['gambar']->storePubliclyAs('gambar',$data['gambar']->getClientOriginalName(),'public');
            $data['gambar']= $data['gambar']->getClientOriginalName();
            $wisata = Wisata::create($data);
            
            if($wisata)
            {
                return response()->json(['message'=>'success'],201);
            }
            else{

                return response()->json(['message'=>'failed'],400);

            }

        }
        else
        {
            return response()->json(["message"=>"invalid"],400);
        }
    }

    public function UpdateWisata(UpdateWisataRequest $request,$id)
    {
        $data = $request->validated();

        if($data)
        {
            if($request->gambar !== null)
            {
                $file = $data['gambar'];
                $file->storePubliclyAs('image',$file->getClientOriginalName(),'public');
                
                $wisata = Wisata::findOrFail($id);
                $wisata->update($data);

                return response()->json(["message"=>"data berhasil diubah"],200);
            }
            else
            {
                $wisata = Wisata::findOrFail($id);
                $wisata->update($data);

                return response()->json(["message"=>"data berhasil diubah"],200);
            }
        }
        else
        {
            return response()->json(['message'=>'data gagal diubah'],400);
        }
    }

    public function getWisata()
    {
        $data = Wisata::get();

        if($data)
        {
            return WisataResource::collection($data);
        }
        else
        {
            return response()->json(["message"=>"data kosong"],400);
        }
    }

    public function delete($id)
    {
        $data = Wisata::findOrFail($id);

        if($data != null)
        {
            $data->delete();
            return response()->json(["message"=>"berhasil dihapus"],200);
        }
        else
        {
            return response()->json(["message"=>"data tidak ditemukan"],400);
        }
    }
}
