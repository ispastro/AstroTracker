<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('celestial_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->enum('type', [
                'meteor_shower',
                'eclipse',
                'planet',
                'satellite',
                'comet',
                'asteroid'
            ]);
            $table->timestamp('starts_at');
            $table->timestamp('ends_at');
            $table->json('visibility_regions')->nullable();
            $table->boolean('is_global')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('celestial_events');
    }
};
