<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status'=> true,
            'data'=>[
                'id'=> $this->id,
                'kode_produk'=> $this->kode_produk,
                'nama_produk'=> $this->nama_produk,
                'harga' => $this->harga,
            ]
        ];
    }
}
