<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukSoftware extends Model
{
    use HasFactory;
    protected $table = 'prdk_software';
    protected $primaryKey = 'prosoft_id';
    protected $fillable = ['ktgr_id',    'ktgr_prosoft_id',    'jenis_software',    'foto_software',    'deskripsi_prosoft'];
    public $timestamps = false;

    public function scopeJoinToKategoriProdukSoftware($query)
    {
        return $query->join('ktgr_prdk_software', 'ktgr_prdk_software.ktgr_prosoft_id', '=', 'prdk_software.ktgr_prosoft_id');
    }

    public function scopeJoinToKategoriProduk($query)
    {
        return $query->join('ktgr_produk', 'ktgr_produk.ktgr_id', '=', 'ktgr_prdk_software.ktgr_id');
    }
}
