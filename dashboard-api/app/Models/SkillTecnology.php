<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillTecnology extends Model
{
    use HasFactory;

    protected $fillable = [
        'skill_id',
        'technology_id',
    ];

    public function skill():HasMany
    {
        return $this->hasMany(Skill::class);
    }

    public function technology():HasMany
    {
        return $this->hasMany(Technology::class);
    }
}
