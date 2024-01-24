<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'video_youtube_id',
        'description',
        'thumbnail'
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function externallink():HasMany
    {
        return $this->hasMany(ExternalLink::class);
    }

}
