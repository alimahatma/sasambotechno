<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukCustom extends Model
{
    use HasFactory;
    protected $primaryKey = 'procus_id';
    protected $table = 'produk_custom';
    protected $fillable = ['supplier_id',    'ktgr_procus_id',    'warna_id',    'nama_produk',    'foto_dep',    'foto_bel',    'satuan',    'jenis_kain',    'size',    'harga_satuan', 'tgl_masuk'];
    public $timestamps = false;

    // implementasi variable scope eloquent for join
    public function scopeJoinKategoriProdukCostum($query)
    {
        return $query->leftJoin('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id');
    }
    public function scopeJoinWarna($query)
    {
        return $query->join('warna', 'warna.warna_id', 'produk_custom.warna_id');
    }

    public function scopeJoinToSupplier($query)
    {
        $query->join('supplier', 'supplier.supplier_id', '=', 'produk_custom.supplier_id');
    }
}
