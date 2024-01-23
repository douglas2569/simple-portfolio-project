<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = [
        'icon',
        'name'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function technology():BelongsToMany
    {
        return $this->belongsToMany(Technology::class);
    }

}
