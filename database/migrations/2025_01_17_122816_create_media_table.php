<?php

use App\Enums\MediaTypeEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->constrained('profiles');

            $table->string('description')->nullable();
            $table->boolean('is_free')->default(false);
            $table->boolean('show_on_home')->default(false);
            $table->string('path');
            $table->string('thumbnail_path');
            $table->unsignedBigInteger('size');
            $table->enum('type', [
                MediaTypeEnum::IMAGE->value,
                MediaTypeEnum::VIDEO->value
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
