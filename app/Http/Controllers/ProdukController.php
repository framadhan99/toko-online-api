<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukUpdateRequest;
use App\Http\Resources\ProdukCollection;
use App\Models\Produk;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProdukResource;
use App\Http\Requests\ProdukCreateRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

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

    public function list() : JsonResponse
    {
        $user = Auth::user();
        $produk = Produk::where('user_id', $user->id)->get();
        if (!$produk) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return response()->json([
            'message' => "success",
            'data'=> $produk,
        ]);
    }

    public function update(ProdukUpdateRequest $request, $id) : ProdukResource
    {
        $user = Auth::user();
        $produk = Produk::where('id', $id)->where('user_id', $user->id)->first();
        if (!$produk) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $data = $request->validated();
        $produk->fill($data);
        $produk->update();

        return new ProdukResource($produk);
    }

    public function show($id) : ProdukResource
    {
        $user = Auth::user();
        $produk = Produk::where('id', $id)->where('user_id', $user->id)->first();
        if (!$produk) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        return new ProdukResource($produk);
    }

    public function delete($id) : JsonResponse
    {
        $user = Auth::user();
        $produk = Produk::where('id', $id)->where('user_id', $user->id)->first();
        if (!$produk) {
            throw new HttpResponseException(response()->json([
                'errors' => [
                    "message" => [
                        "not found"
                    ]
                ]
            ])->setStatusCode(404));
        }

        $produk->delete();

        return response()->json([
            'data'=> true,
            'message' => 'berhasil di hapus'
        ]);
    }

    public function search(Request $request) : ProdukCollection
    {
        $user = Auth::user();
        $page = $request->input('page', 1);
        $size = $request->input('size', 10);

        $produk = Produk::query()->where('user_id', $user->id);
        $produk = $produk->where(function(Builder $builder) use ($request){
            $nama_produk = $request->input('nama_produk');
            if($nama_produk){
                $builder->where('nama_produk', 'like', '%'.$nama_produk.'%');
            }

            $harga = $request->input('harga');
            if($harga){
                $builder->where('harga', 'like', '%'.$harga.'%');
            }
        });

        $produk = $produk->paginate(perPage:$size, page: $page);

        return new ProdukCollection($produk);
    }
}
