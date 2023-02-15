<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trx_sablon extends Model
{
    use HasFactory;
    protected $table = 'trx_sablon';
    protected $primaryKey = 'trx_sablon_id';
    protected $fillable = ['member_id', 'sablon_id', 'jml', 'tgl_trx', 'created_at', 'updated_at'];
    public $timestamps = false;

    public function scopeJoinToMember($query)
    {
        return $query->join('member', 'member.member_id', '=', 'trx_sablon.member_id');
    }
    public function scopeJoinToSablon($query)
    {
        return $query->join('sablon', 'sablon.sablon_id', '=', 'trx_sablon.sablon_id');
    }
}
