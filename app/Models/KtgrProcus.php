<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KtgrProcus extends Model
{
    use HasFactory;
    protected $primaryKey = 'ktgr_procus_id';
    protected $table = 'ktgr_prdk_custom';
    protected $fillable = ['ktgr_id',    'jenis_procus',    'foto_procus',    'des_ktgrprocus'];
    public $timestamps = false;
}
