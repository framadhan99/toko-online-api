<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;

    protected $table = "produks";

    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(Produk::class, "user_id", "id");
    }
}
