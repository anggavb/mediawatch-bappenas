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
        Schema::create('medmons', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('url');
            $table->timestamp('datetime')->nullable();
            $table->text('content')->nullable();
            $table->text('summary')->nullable();
            $table->string('tone_content')->nullable();

            $table->timestamps();
        });

        Schema::create('sentiments', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('description')->nullable();

            $table->timestamps();
        });
        
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('url');
            $table->timestamp('published_at');
            $table->foreignId('sentiment_id')->constrained()->onDelete('set null')->nullable();
            $table->jsonb('tags')->nullable();
            $table->string('speaker')->nullable();
            
            $table->timestamps();
        });

        Schema::create('news_contents', function (Blueprint $table) {
            $table->id();

            $table->foreignId('news_id')->constrained()->onDelete('cascade')->index();
            $table->text('content');
            $table->text('summary');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_contents');
        Schema::dropIfExists('news');
        Schema::dropIfExists('sentiments');
        Schema::dropIfExists('medmons');
    }
};
