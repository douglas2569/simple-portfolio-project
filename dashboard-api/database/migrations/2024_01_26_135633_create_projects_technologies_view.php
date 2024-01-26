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
            CREATE VIEW view_projects_technologies
            AS
            SELECT technologies.id, technologies.id AS technology_id, technologies.name AS technology_name, technologies.color AS technology_color, technologies.id AS technology_id, technologies.created_at AS technology_created_at, technologies.updated_at AS technology_updated_at,
            projects.id AS project_id, projects.thumbnail AS project_thumbnail, projects.name AS project_name, projects.created_at AS project_created_at, projects.updated_at AS project_updated_at, projects.video_youtube_id AS project_video_youtube_id, projects.description AS project_description
            FROM project_technology
            INNER JOIN projects
            ON projects.id = project_technology.project_id
            INNER JOIN technologies
            ON technologies.id = project_technology.technology_id";
    }

    private function dropView():string
    {
        return "DROP VIEW IF EXISTS 'view_projects_technologies';";
    }


};
