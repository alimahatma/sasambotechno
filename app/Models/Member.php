<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $primaryKey = 'member_id';
    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'telepon',
        'gender',
        'desa',
        'kecamatan',
        'kabupaten',
        'provinsi'
    ];
    public $timestamps = false;


    // query vaeibale scope for join table member to user
    public function scopeJoinMemberToUser($query)
    {
        return $query->join('users', 'users.user_id', '=', 'member.user_id');
    }
}
