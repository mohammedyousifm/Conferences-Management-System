<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Paper extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'conference_id',
        'reviewer_id',
        'paper_title',
        'abstract',
        'paper_file',
        'paperFileV2',
        'version',
        'keywords',
        'paper_code',
        'status',
        // author
        'user_id',
        'author_name',
        'phone',
        'email',
        'number_of_authors',
        'address',
    ];

    // Define relationship with User (Author)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Define relationship with Conference
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    public function comment_paper()
    {
        return $this->hasMany(Reviewer::class, 'paper_id', 'id');
    }

    public function controller_report()
    {
        return $this->hasMany(paper_controller::class, 'paper_id', 'id');
    }

    // Define relationship with Reviewer
    public function reviewers()
    {
        return $this->belongsToMany(User::class, 'paper_reviewer', 'paper_id', 'reviewer_id');
    }
}
