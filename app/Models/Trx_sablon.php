<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_sablon extends Model
{
    // <!-- user_id	sablon_id	'kurir_id',	'payment_id',	'bdp',	'bl',	jml	'pay_status',	'stts_produksi',	'trx_status' -->
    use HasFactory;
    protected $table = 'trx_sablon';
    protected $primaryKey = 'trx_sablon_id';
    protected $fillable = ['user_id', 'sablon_id', 'kurir_id',    'payment_id',    'bdp',    'bl', 'jml', 'tgl_trx', 'pay_status',    'stts_produksi',    'trx_status'];
    public $timestamps = false;

    public function scopeJoinToUser($query)
    {
        return $query->join('users', 'users.user_id', '=', 'trx_sablon.user_id');
    }
    public function scopeJoinToSablon($query)
    {
        return $query->join('sablon', 'sablon.sablon_id', '=', 'trx_sablon.sablon_id');
    }

    public function scopeJoinToPayment($query)
    {
        return $query->join('payment', 'payment.payment_id', '=', 'trx_sablon.payment_id');
    }
    public function scopeJoinToKurir($query)
    {
        return $query->join('kurir', 'kurir.kurir_id', '=', 'trx_sablon.payment_id');
    }
}
