<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wisata;
use App\Http\Requests\WisataRequest;
use Illuminate\Support\Facades\Log;

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
}
