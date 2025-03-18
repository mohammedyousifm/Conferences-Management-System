<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invitation extends Model
{
    use HasFactory;
    protected $table = 'invitations';
    protected $fillable = [
        'expires_at',
        'controller_id',
        'email',
        'token',
        'used',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];
}
