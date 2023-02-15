<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $primaryKey = 'partner_id';
    protected $table = 'partner';
    protected $fillable = ['nama_prshn', 'logo_prshn', 'alamat'];
    public $timestamps = false;
}
