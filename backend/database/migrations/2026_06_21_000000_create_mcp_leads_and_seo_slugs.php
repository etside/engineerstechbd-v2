<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mcp_leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->string('service_interest')->nullable();
            $table->string('budget_range')->nullable();
            $table->string('platform_source')->default('web'); // chatgpt|claude|tencent|web
            $table->text('conversation_summary')->nullable();
            $table->string('status')->default('new');          // new|contacted|qualified|closed
            $table->integer('lead_score')->default(0);
            $table->timestamp('contacted_at')->nullable();
            $table->timestamps();
        });

        // Add slug + seo_description to projects/portfolio table
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
            $table->string('seo_description', 320)->nullable()->after('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mcp_leads');
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn(['slug', 'seo_description']);
        });
    }
};
