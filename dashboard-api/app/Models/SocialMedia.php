<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SocialMedia extends Model
{
    use HasFactory;
    protected $fillabled = [        
        'icon',  
        'name',
        'about_id',
    ];

    public function about():BelongsTo
    {
        return $this->belongsTo(About::class);
    }
}
