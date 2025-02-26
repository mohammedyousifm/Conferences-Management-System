<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Conference extends Model
{
    use HasFactory;
    protected $table = 'conferences';
    protected $fillable = [
        'title',
        'description',
        'start_date',
        'end_date',
        'registration_deadline',
        'location',
        'status',
        'controller_id',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
