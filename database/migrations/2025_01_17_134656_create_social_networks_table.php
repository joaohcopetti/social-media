<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\SocialNetworkEnum;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_networks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')
                ->constrained('profiles');

            $table->string('url');
            $table->enum('social_network', [
                SocialNetworkEnum::FACEBOOK->value,
                SocialNetworkEnum::X_TWITTER->value,
                SocialNetworkEnum::INSTAGRAM->value,
                SocialNetworkEnum::TIKTOK->value,
                SocialNetworkEnum::YOUTUBE->value,
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_networks');
    }
};
