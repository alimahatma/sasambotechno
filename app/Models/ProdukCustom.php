<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukCustom extends Model
{
    use HasFactory;
    protected $primaryKey = 'procus_id';
    protected $table = 'produk_custom';
    protected $fillable = ['ktgr_id',    'supplier_id',    'ktgr_procus_id',    'warna_id',    'nama_produk',    'foto_dep',    'foto_bel',    'satuan',    'jenis_kain',    'size',    'harga_beli',    'harga_jual',    'tgl_masuk',    'deskripsi'];
    public $timestamps = false;
}
