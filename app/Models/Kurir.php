<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurir extends Model
{
    use HasFactory;
    protected $table = 'kurir';
    protected $primaryKey = 'kurir_id';
    protected $fillable = ['nama_jakir',    'jenis_jakir', 'created_at', 'updated_at'];
    public $timestamps = false;
}
