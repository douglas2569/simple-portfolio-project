<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
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
            CREATE VIEW view_projects_external_links
            AS
            SELECT external_links.id AS external_link_id, external_links.name AS external_link_name, external_links.url,
                   external_links.created_at, external_links.updated_at,
                   projects.id AS project_id, projects.name AS project_name, projects.thumbnail, projects.video_youtube_id, projects.description, projects.user_id
            FROM external_links
            INNER JOIN projects
            ON projects.id = external_links.project_id";
    }

    private function dropView():string
    {
        return "DROP VIEW IF EXISTS 'view_projects_external_links';";
    }
};
