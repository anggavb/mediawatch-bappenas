<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media_categories', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('order')->nullable();

            $table->timestamps();
        });

        Schema::create('media_groups', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('logo')->nullable();
            $table->integer('order')->nullable();
            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });

        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->foreignId('media_group_id')->constrained('media_groups')->onDelete('set null');
            $table->foreignId('media_category_id')->constrained('media_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('url')->unique();
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            $table->index('media_group_id');
            $table->index('media_category_id');
            $table->index(['media_group_id', 'media_category_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
        Schema::dropIfExists('media_categories');
        Schema::dropIfExists('media_groups');
    }
};
