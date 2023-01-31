<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warna extends Model
{
    use HasFactory;
    protected $table = 'warna';
    protected $primaryKey = 'warna_id';
    protected $fillable = ['nama_warna', 'jml_stok', 'created_at', 'updated_at'];
    public $timestamps = false;
}
