<?php

namespace App\Contracts\Services;

use App\Models\ActivityType;
use App\Models\User;

interface GigaChatServiceContract
{
    public static function makeRequest(string $userContent, ?string $systemContent, float $temperature, int $maxTokens): string;

    public static function getOpenQuestionExplanation(User $user, string $question, string $answer): string;

    public static function getAssociativeTestExplanation(User $user, ActivityType $activityType): string;
}
