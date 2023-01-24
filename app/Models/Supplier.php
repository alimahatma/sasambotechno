<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table = 'supplier';
    protected $primaryKey = 'supplier_id';
    protected $fillable = ['nama_supplier',    'alamat',    'contact', 'created_at', 'updated_at'];
    public $timestamps = false;
}
