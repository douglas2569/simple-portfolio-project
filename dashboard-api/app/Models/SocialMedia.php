<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillable = [
        'icon',
        'name',
        'about_id',
        'url',
    ];

    public function about():BelongsTo
    {
        return $this->belongsTo(About::class);
    }
}
