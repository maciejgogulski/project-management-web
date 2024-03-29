<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'content'
    ];

    public function project() {
        return $this->belongsTo(Project::class);
    }

    public function task() {
        return $this->belongsTo(Task::class);
    }
}
