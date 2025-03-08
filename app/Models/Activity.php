<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activity extends Model
{
    use HasFactory;
    protected $table = 'activities';

    protected $fillable = [
        'description',
        'user_id',
        'activity_type',
        'paper_code',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function Activity_User()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
