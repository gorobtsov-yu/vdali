<?php

use App\Models\ActivityType;
use App\Models\Characteristic;
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
        Schema::create('activity_type_characteristic', function (Blueprint $table) {
            $table->foreignIdFor(ActivityType::class)->constrained();
            $table->foreignIdFor(Characteristic::class)->constrained();
            $table->timestamps();

            $table->primary(['activity_type_id', 'characteristic_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_type_characteristic');
    }
};
