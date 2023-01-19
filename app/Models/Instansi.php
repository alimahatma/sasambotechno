<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $primaryKey = 'inst_id';
    protected $table = 'instansi';
    protected $fillable = ['nama_instansi', 'logo', 'visi', 'misi', 'tentang', 'alamat', 'domain', 'email', 'whatsapp', 'instagram', 'facebook', 'building'];
    public $timestamps = false;
}
