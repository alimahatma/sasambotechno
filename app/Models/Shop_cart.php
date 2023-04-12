<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop_cart extends Model
{
    use HasFactory;
    protected $table = 'cart_shop';
    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id',    'procus_id',    'warna_id',    'sablon_id', 'size_order',    'jumlah_order',    'harga_satuan',    'harga_totals'];
    public $timestamps = false;

    public function scopeJoinProcus($query)
    {
        return $query->leftJoin('produk_custom', 'produk_custom.procus_id', '=', 'cart_shop.procus_id');
    }
    public function scopeJoinToWarna($query)
    {
        return $query->leftJoin('warna', 'warna.warna_id', '=', 'cart_shop.warna_id');
    }
    public function scopeJoinTableSablon($query)
    {
        return $query->leftJoin('sablon', 'sablon.sablon_id', '=', 'cart_shop.sablon_id');
    }
}
