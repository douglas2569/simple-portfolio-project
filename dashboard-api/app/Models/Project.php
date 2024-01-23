<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

}
