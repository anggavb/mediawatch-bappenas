<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sentiments', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('description')->nullable();

            $table->timestamps();
        });

        Schema::create('speakers', function (Blueprint $table) {
            $table->id();

            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->text('additional_info')->nullable();

            $table->timestamps();
        });

        Schema::create('medmons', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->bigInteger('media_id')->unsigned()->nullable();
            $table->string('url');
            $table->timestamp('datetime')->nullable();
            $table->text('content')->nullable();
            $table->text('summary')->nullable();
            $table->foreignId('sentiment_id')->nullable();
            $table->foreignId('speaker_id')->nullable();
            $table->text('tags')->nullable();

            $table->timestamps();
        });

        // tambahkan kolom tsvector (search_vector)
        DB::statement("ALTER TABLE medmons ADD COLUMN search_vector tsvector");

        // inisialisasi nilai search_vector untuk data lama (jika ada)
        // gunakan konfigurasi 'simple' untuk bahasa umum (Indonesia tidak punya stemming default baik)
        DB::statement("
            UPDATE medmons
            SET search_vector = 
                setweight(to_tsvector('simple', coalesce(title,'')), 'A') || 
                setweight(to_tsvector('simple', coalesce(content,'')), 'B')
        ");

        // buat GIN index pada search_vector
        DB::statement("CREATE INDEX medmons_search_vector_gin ON medmons USING GIN(search_vector)");

        // buat trigger untuk maintain search_vector otomatis saat INSERT/UPDATE
        // gunakan tsvector_update_trigger yang tersedia di Postgres.
        DB::statement("
            CREATE TRIGGER medmons_search_vector_update
            BEFORE INSERT OR UPDATE ON medmons
            FOR EACH ROW EXECUTE FUNCTION
                tsvector_update_trigger(
                    search_vector, 
                    'pg_catalog.simple', 
                    title, 
                    content
                );
        ");
        
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('media_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('url');
            $table->timestamp('published_at');
            $table->foreignId('sentiment_id')->nullable();
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
        // drop trigger, index, column, tabel
        DB::statement("DROP TRIGGER IF EXISTS medmons_search_vector_update ON medmons");
        DB::statement("DROP INDEX IF EXISTS medmons_search_vector_gin");
        Schema::table('medmons', function (Blueprint $table) {
            $table->dropColumn('search_vector');
        });
        Schema::dropIfExists('medmons');
        Schema::dropIfExists('speakers');
        Schema::dropIfExists('sentiments');
    }
};
