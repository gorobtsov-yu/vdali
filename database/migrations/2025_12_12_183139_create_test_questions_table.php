<?php

use App\Models\TestQuestionGroup;
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
        Schema::create('test_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TestQuestionGroup::class)->constrained();
            $table->string('text');
            $table->unsignedInteger('queue_position');
            $table->string('code')->unique();
            $table->timestamps();

            $table->index(['test_question_group_id', 'code']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_questions');
    }
};
