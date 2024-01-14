<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class About extends Model
{
    use HasFactory;

    protected $fillable = [        
        'cover_photo',        
        'profile_photo',
        'name',
        'position',
        'title',
        'description',
    ];

    public function socialMedia():HasMany
    {
        return $this->hasMany(SocialMedia::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
