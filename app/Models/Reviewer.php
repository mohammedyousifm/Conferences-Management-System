<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Reviewer extends Model
{
    use HasFactory;
    protected $table = 'paper_reviewer';
    protected $fillable = [
        'paper_id',
        'reviewer_id',
        'comment',
        'comment_file',
        'status',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }
}
