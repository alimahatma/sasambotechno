<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KtgrProcus extends Model
{
    use HasFactory;
    protected $primaryKey = 'ktgr_procus_id';
    protected $table = 'ktgr_prdk_custom';
    protected $fillable = ['ktgr_id',    'jenis_procus',    'foto_procus',    'deskripsi_kategori_produk_custom'];
    public $timestamps = false;

    public function scopeJoinToKategori($query)
    {
        return $query->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_custom.ktgr_id');
    }
    public function scopeJoinProdukCostum($query)
    {
        return $query->join('produk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id');
    }
}
