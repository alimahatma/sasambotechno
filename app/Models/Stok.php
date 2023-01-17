<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;
    protected $primaryKey = 'stok_id';
    protected $table = 'stok';
    protected $fillable = ['produk_id', 'jumlah', 'harga_beli', 'harga_jual', 'tgl_masuk'];
    public $timestamps = false;
}
