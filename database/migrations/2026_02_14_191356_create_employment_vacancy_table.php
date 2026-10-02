<?php

use App\Models\ActivityType;
use App\Models\Employment;
use App\Models\Vacancy;
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
        Schema::create('employment_vacancy', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Vacancy::class)->constrained();
            $table->foreignIdFor(Employment::class)->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_vacancy');
    }
};
