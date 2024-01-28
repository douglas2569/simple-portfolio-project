<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Technology extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'color'
    ];

    public function skills():BelongsToMany
    {
        return $this->belongsToMany(Skill::class);
    }

    public function projects():BelongsToMany
    {
        return $this->belongsToMany(Project::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function skillTechnology():BelongsTo
    {
        return $this->belongsTo(skillTechnology::class);
    }

}
