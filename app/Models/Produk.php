<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $primaryKey = 'produk_id';
    protected $table = 'produk';
    protected $fillable = ['ktgr_id',    'stok_id',    'supplier_id',    'nama_produk',    'foto_dep',    'foto_bel',    'deskripsi',    'satuan',    'size'];
    public $timestamps = false;
}
