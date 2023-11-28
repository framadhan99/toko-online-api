<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProdukResource;
use App\Http\Requests\ProdukCreateRequest;

class ProdukController extends Controller
{
    public function create(ProdukCreateRequest $request) : ProdukResource
    {
        $data = $request->validated();
        $user = Auth::user();

        $produk = new Produk($data);
        $produk->user_id = $user->id;
        $produk->save();

        return new ProdukResource($produk);
        
    }
}
