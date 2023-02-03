<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $fillable = ['procus_id',    'member_id',    'sablon_id',    'kurir_id',    'payment_id',    'jml_order',    'pay_status',    'tgl_order',    'stts_produksi',    'status_pesanan'];
    public $timestamps = false;
}
