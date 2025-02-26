<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Paper_controller extends Model
{
    use HasFactory;
    protected $table = 'paper_controller';
    protected $fillable = [
        'paper_id',
        'controller_id',
        'report_comment',
        'report_file',
    ];

    public function paper()
    {
        return $this->belongsTo(Paper::class, 'paper_id', 'id');
    }

    public function controller()
    {
        return $this->belongsTo(User::class, 'controller_id');
    }
}
