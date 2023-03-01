<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $primaryKey = 'contact_us_id';
    protected $fillable = ['nama',    'email',    'telepon',    'saran'];
    public $timestamps = false;
}
