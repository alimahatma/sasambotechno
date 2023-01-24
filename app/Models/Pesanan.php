<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $fillable = ['produk_id',    'sablon_id',    'kurir_id',    'status_pesanan',    'tgl_checkout', 'created_at', 'updated_at'];
    public $timestamps = false;
}
