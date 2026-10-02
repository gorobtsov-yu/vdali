<?php

use App\Models\TestBase;
use App\Models\TestSession;
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
        Schema::create('test_base_test_session', function (Blueprint $table) {
            $table->foreignIdFor(TestBase::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(TestSession::class)->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->primary(['test_session_id', 'test_base_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_base_test_session');
    }
};
