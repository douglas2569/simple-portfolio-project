<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement($this->createView());
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement($this->dropView());
    }

    private function createView():string
    {
        return "
            CREATE VIEW view_skills_technologies
            AS
            SELECT technologies.id, technologies.id AS technology_id, technologies.name AS technology_name, technologies.color AS technology_color, technologies.id AS technology_id, technologies.created_at AS technology_created_at, technologies.updated_at AS technology_updated_at,
            skills.id AS skill_id, skills.icon AS skill_icon, skills.name AS skill_name, skills.created_at AS skill_created_at, skills.updated_at AS skill_updated_at
            FROM skill_technology
            INNER JOIN skills
            ON skills.id = skill_technology.skill_id
            INNER JOIN technologies
            ON technologies.id = skill_technology.technology_id";
    }

    private function dropView():string
    {
        return "DROP VIEW IF EXISTS 'view_skills_technologies';";
    }


};
