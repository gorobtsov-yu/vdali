<?php

use App\Models\Employment;
use App\Models\User;
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
        Schema::create('user_employment_interactions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Employment::class)->constrained()->onDelete('cascade');
            
            $table->boolean('is_favorite')->default(false);
            $table->timestamp('viewed_at')->nullable();
            
            $table->unique(['user_id', 'employment_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_employment_interactions', function (Blueprint $table) {
            $table->dropForeign(['employment_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('user_employment_interactions');
    }
};
