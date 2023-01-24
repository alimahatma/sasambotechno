<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sablon extends Model
{
    use HasFactory;
    protected $table = 'sablon';
    protected $primaryKey = 'sablon_id';
    protected $fillable = ['ukuran_sablon',    'harga', 'created_at', 'updated_at'];
    public $timestamps = false;
}
