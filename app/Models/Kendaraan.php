<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;
    protected $fillable = ['tahun_keluaran', 'warna', 'harga'];

    protected $casts = [
        'tahun_keluaran' => 'integer',
        'harga' => 'decimal:2',
    ];
}
