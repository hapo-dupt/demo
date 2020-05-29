<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Project;

class Task extends Model
{
    protected $fillable = [
        'title', 'description', 'member_id', 'projects_id', 'status', 'begin_at', 'finish_at'
    ];

    public function projects()
    {
        return $this->belongsTo(Project::Class);
    }

    public function members()
    {
        return $this->belongsTo(Member::class);
    }
}
