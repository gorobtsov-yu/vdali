<?php

use App\Models\TestAnswer;
use App\Models\TestBase;
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
        Schema::create('test_answer_test_base', function (Blueprint $table) {
            $table->foreignIdFor(TestAnswer::class)->constrained();
            $table->foreignIdFor(TestBase::class)->constrained();
            $table->timestamps();

            $table->primary(['test_answer_id', 'test_base_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_answer_test_base');
    }
};
