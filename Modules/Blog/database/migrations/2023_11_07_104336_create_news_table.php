<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->default(0);
            $table->unsignedBigInteger('state_id')->default(0);
            $table->unsignedBigInteger('city_id')->default(0);
            $table->string('title');
            $table->text('short_description');
            $table->longText('description');
            $table->text('slug');
            $table->string('image')->nullable();
            $table->string('reporter');
            $table->bigInteger('views')->default(0);
            $table->boolean('show_homepage')->default(false);
            $table->boolean('is_popular')->default(false);
            $table->boolean('news_ticker')->default(false);
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->boolean('latest')->default(false);
            $table->text('tags')->nullable();
            $table->boolean('status')->default(0);
            $table->text('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
