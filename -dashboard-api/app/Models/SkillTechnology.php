<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillTechnology extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'technology_id',
    ];

    public $table = "skill_technology";

    public function skill():BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }

    public function technology():BelongsTo
    {
        return $this->belongsTo(Technology::class);
    }
}
