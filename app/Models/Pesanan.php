<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $primaryKey = 'pesanan_id';
    protected $fillable = [
        'procus_id',
        'color',
        'member_id',
        'size_order',
        'sablon_id',
        'kurir_id',
        'payment_id',
        'jml_order',
        'jml_dp',
        'jml_lunas',
        'all_total',
        'desain1',
        'desain2',
        'desain3',
        'b_dp',
        'b_lunas',
        't_pesan',
        'pay_status',
        'tgl_order',
        'stts_produksi',
        'status_pesanan'
    ];
    public $timestamps = false;

    public function scopeJoinToProdukCustom($query)
    {
        return $query->join('produk_custom', 'produk_custom.procus_id', '=', 'pesanan.procus_id');
    }

    public function scopeJoinToKategoriProdukCustom($query)
    {
        return $query->join('ktgr_prdk_custom', 'ktgr_prdk_custom.ktgr_procus_id', '=', 'produk_custom.ktgr_procus_id');
    }

    public function scopeJoinToWarna($query)
    {
        return $query->join('warna', 'warna.warna_id', 'produk_custom.warna_id');
    }

    public function scopeJoinToMember($query)
    {
        return $query->join('member', 'member.member_id', '=', 'pesanan.member_id');
    }

    public function scopeJoinToSablon($query)
    {
        return $query->join('sablon', 'sablon.sablon_id', '=', 'pesanan.sablon_id');
    }
    public function scopeJoinToKurir($query)
    {
        return $query->join('kurir', 'kurir.kurir_id', '=', 'pesanan.kurir_id');
    }
    public function scopeJoinToPayment($query)
    {
        return $query->join('payment', 'payment.payment_id', '=', 'pesanan.payment_id');
    }
}
