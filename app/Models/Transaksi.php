<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $primaryKey = 'transaksi_id';
    protected $fillable = ['user_id',    'produk_id',    'sablon_id', 'tanggal_transaksi', 'created_at', 'updated_at'];
    public $timestamps = false;
}
