<?php

use App\Models\ActivityType;
use App\Models\Employment;
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
        Schema::create('activity_type_employment', function (Blueprint $table) {
            $table->foreignIdFor(Employment::class)->constrained();
            $table->foreignIdFor(ActivityType::class)->constrained();
            $table->timestamps();

            $table->primary(['employment_id', 'activity_type_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_type_employment');
    }
};
