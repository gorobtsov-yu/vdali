<?php

namespace App\Services;

use App\Contracts\Services\GigaChatServiceContract;
use App\Helpers\UserTextDataHelper;
use App\Models\ActivityType;
use App\Models\User;
use App\Services\Service;
use App\Traits\HasUserContext;
use Override;
use Tigusigalpa\GigaChat\Laravel\GigaChat;
use Tigusigalpa\GigaChat\Models\GigaChatModels;

class GigaChatService extends Service implements GigaChatServiceContract
{
    public static function makeRequest(string $userContent, ?string $systemContent = null, float $temperature = 0.5, int $maxTokens = 1000): string
    {
        $messages = [
            [
                'role' => 'system', 
                'content' => $systemContent,
            ],
            [
                'role' => 'user',
                'content' => $userContent,
            ]
        ];

        $response = GigaChat::chat($messages, [
            'temperature' => $temperature,
            'max_tokens' => $maxTokens,
            'model' => GigaChatModels::GIGACHAT_2_PRO
        ]);

        return $response['choices'][0]['message']['content'];
    }

    public static function getOpenQuestionExplanation(User $user, string $question, string $answer): string
    {
        $systemContent = UserTextDataHelper::forUser($user)->getUserTextData();
        $systemContent .= 'Исходный вопрос: ' . $question . '. ';
        $systemContent .= 'Сформулируй на основе выбранных предпочтений возможные сильные стороны пользователя, на которые он может опереться при выборе будущей занятости. Веди диалог с пользователем, обращяйся учтиво.';
        $systemContent .= 'Не используй дополнительное форматирование текста, но придерживайся правил пунктуации в тексте. Ответь одним сообщением - текстом, без лишних дополнений.';

        return self::makeRequest($answer, $systemContent, 1.5, 2000);
    }

    public static function getAssociativeTestExplanation(User $user, ActivityType $activityType): string
    {
        $systemContent = UserTextDataHelper::forUser($user)->getUserTextData();
        $systemContent .= 'Сформулируй на основе выбранных предпочтений возможные сильные стороны пользователя, на которые он может опереться при выборе будущей занятости. Веди диалог с пользователем, обращяйся учтиво.';
        $systemContent .= 'Не используй дополнительное форматирование текста, но придерживайся правил пунктуации в тексте. Ответь одним сообщением - текстом, без лишних дополнений.';

        $userContent = 'Полученный мною тип деятельности: ' . $activityType->name . '. ';
        $userContent = 'Указано, что для этого типа деятельности свойтсвенны характеристики: ';
        $activityType->characteristics->each(function ($characteristic) use (&$userContent) {
            $userContent .= $characteristic->name . ' ';
        });

        return self::makeRequest($userContent, $systemContent, 1.5, 2000);
    }
}
