<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $primaryKey = 'instansi_id';
    protected $table = 'instansi';
    protected $fillable = ['nama_instansi', 'logo', 'visi', 'misi', 'alamat', 'facebook', 'instagram', 'whatsapp', 'telepon', 'github'];
    public $timestamps = false;
}
