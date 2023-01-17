<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriProduk extends Model
{
    use HasFactory;
    protected $primaryKey = 'ktgr_id';
    protected $table = 'ktgr_produk';
    protected $fillable = ['jenis_kategori', 'foto_ktgr'];
    public $timestamps = false;
}
