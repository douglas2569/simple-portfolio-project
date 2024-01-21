<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CoverPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'url',
        'size',
        'about_id'
    ];

    public function about():BelongsTo
    {
        return $this->belongsTo(About::class);
    }

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
