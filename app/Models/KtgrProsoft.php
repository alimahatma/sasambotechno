<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KtgrProsoft extends Model
{
    use HasFactory;
    protected $primaryKey = 'ktgr_prosoft_id';
    protected $table = 'ktgr_prdk_software';
    protected $fillable = ['ktgr_id',    'jenis_prosoft',    'foto_prosoft',    'des_ktgrprosoft'];
    public $timestamps = false;
}
