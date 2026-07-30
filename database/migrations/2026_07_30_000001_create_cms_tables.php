<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('group')->default('general')->index();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name_vi');
            $table->string('name_en')->nullable();
            $table->string('slug_vi')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->string('type')->default('post')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('status')->default('published')->index();
            $table->timestamps();
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->constrained('pages')->nullOnDelete();
            $table->string('type')->default('static')->index();
            $table->string('title_vi');
            $table->string('title_en')->nullable();
            $table->string('slug_vi')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->text('excerpt_vi')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_vi')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('seo_title_vi')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_vi')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->string('og_image')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });

        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('author_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('title_vi');
            $table->string('title_en')->nullable();
            $table->string('slug_vi')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->text('excerpt_vi')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_vi')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('attachment')->nullable();
            $table->boolean('is_featured')->default(false)->index();
            $table->string('status')->default('draft')->index();
            $table->timestamp('published_at')->nullable()->index();
            $table->string('seo_title_vi')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_vi')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->string('og_image')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('title_vi')->nullable();
            $table->string('title_en')->nullable();
            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();
            $table->string('image_desktop');
            $table->string('image_mobile')->nullable();
            $table->string('link_url')->nullable();
            $table->boolean('open_in_new_tab')->default(false);
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('title_vi');
            $table->string('title_en')->nullable();
            $table->string('slug_vi')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->text('description_vi')->nullable();
            $table->text('description_en')->nullable();
            $table->string('cover_image')->nullable();
            $table->date('event_date')->nullable();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->string('seo_title_vi')->nullable();
            $table->string('seo_title_en')->nullable();
            $table->text('seo_description_vi')->nullable();
            $table->text('seo_description_en')->nullable();
            $table->timestamps();
        });

        Schema::create('album_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->cascadeOnDelete();
            $table->string('image_path');
            $table->string('alt_vi')->nullable();
            $table->string('alt_en')->nullable();
            $table->string('caption_vi')->nullable();
            $table->string('caption_en')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_cover')->default(false);
            $table->timestamps();
        });

        Schema::create('board_members', function (Blueprint $table) {
            $table->id();
            $table->string('name_vi');
            $table->string('name_en')->nullable();
            $table->string('position_vi')->nullable();
            $table->string('position_en')->nullable();
            $table->string('title_vi')->nullable();
            $table->string('title_en')->nullable();
            $table->string('organization_vi')->nullable();
            $table->string('organization_en')->nullable();
            $table->string('photo')->nullable();
            $table->text('bio_vi')->nullable();
            $table->text('bio_en')->nullable();
            $table->string('term')->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('training_programs', function (Blueprint $table) {
            $table->id();
            $table->string('title_vi');
            $table->string('title_en')->nullable();
            $table->string('slug_vi')->unique();
            $table->string('slug_en')->nullable()->unique();
            $table->text('excerpt_vi')->nullable();
            $table->text('excerpt_en')->nullable();
            $table->longText('content_vi')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('featured_image')->nullable();
            $table->string('location_vi')->nullable();
            $table->string('location_en')->nullable();
            $table->string('organizer_vi')->nullable();
            $table->string('organizer_en')->nullable();
            $table->string('format_vi')->nullable();
            $table->string('format_en')->nullable();
            $table->string('registration_url')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->string('program_status')->default('upcoming')->index();
            $table->string('status')->default('draft')->index();
            $table->unsignedInteger('sort_order')->default(0);
            $table->timestamps();
        });

        Schema::create('member_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('academic_title')->nullable();
            $table->string('specialty')->nullable();
            $table->string('organization')->nullable();
            $table->string('job_title')->nullable();
            $table->string('phone')->nullable();
            $table->string('email');
            $table->string('address')->nullable();
            $table->string('province')->nullable();
            $table->string('member_type')->nullable();
            $table->string('attachment')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('new')->index();
            $table->json('extra_fields')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();
        });

        Schema::create('member_application_status_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_application_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('from_status')->nullable();
            $table->string('to_status');
            $table->text('note')->nullable();
            $table->timestamps();
        });

        Schema::create('contact_submissions', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->string('status')->default('new')->index();
            $table->string('ip_address', 45)->nullable();
            $table->timestamp('handled_at')->nullable();
            $table->timestamps();
        });

        Schema::create('slug_redirects', function (Blueprint $table) {
            $table->id();
            $table->string('old_slug');
            $table->string('new_slug');
            $table->string('type')->default('post');
            $table->timestamps();
            $table->unique(['type', 'old_slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('slug_redirects');
        Schema::dropIfExists('contact_submissions');
        Schema::dropIfExists('member_application_status_logs');
        Schema::dropIfExists('member_applications');
        Schema::dropIfExists('training_programs');
        Schema::dropIfExists('board_members');
        Schema::dropIfExists('album_images');
        Schema::dropIfExists('albums');
        Schema::dropIfExists('banners');
        Schema::dropIfExists('posts');
        Schema::dropIfExists('pages');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('settings');
    }
};
