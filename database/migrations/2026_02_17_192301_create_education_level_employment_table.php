<?php

use App\Models\EducationLevel;
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
        Schema::create('education_level_employment', function (Blueprint $table) {
            $table->foreignIdFor(Employment::class)->constrained();
            $table->foreignIdFor(EducationLevel::class)->constrained();
            $table->timestamps();

            $table->primary(['employment_id', 'education_level_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_level_employment');
    }
};
