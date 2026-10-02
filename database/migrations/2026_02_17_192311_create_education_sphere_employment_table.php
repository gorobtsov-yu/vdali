<?php

use App\Models\EducationSphere;
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
        Schema::create('education_sphere_employment', function (Blueprint $table) {
            $table->foreignIdFor(Employment::class)->constrained();
            $table->foreignIdFor(EducationSphere::class)->constrained();
            $table->timestamps();

            $table->primary(['employment_id', 'education_sphere_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('education_sphere_employment');
    }
};
