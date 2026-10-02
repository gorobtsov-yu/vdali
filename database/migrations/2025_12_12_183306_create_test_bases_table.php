<?php

use App\Models\Test;
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
        Schema::create('test_bases', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class)->constrained();
            $table->string('name');
            $table->string('code')->unique();
            $table->timestamps();

            $table->index(['code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_bases');
    }
};
