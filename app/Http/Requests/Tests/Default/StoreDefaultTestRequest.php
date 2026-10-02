<?php

namespace App\Http\Requests\Tests\Default;

use App\Models\TestAnswer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Validator;

class StoreDefaultTestRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'test_id' => [
                'required',
                'integer',
                'exists:tests,id',
            ],
            'answers' => [
                'required',
                'array',
            ],
            'answers.*' => [
                'required',
                'integer',
                'exists:test_answers,id',
            ],
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $answers = $this->input('answers');
            if (! is_array($answers)) {
                return;
            }

            $testId = $this->input('test_id');

            $validQuestionIds = DB::table('test_questions')
                ->join('test_question_groups', 'test_questions.test_question_group_id', '=', 'test_question_groups.id')
                ->where('test_question_groups.test_id', $testId)
                ->pluck('test_questions.id')
                ->toArray();

            if (empty($validQuestionIds)) {
                $validator->errors()->add('test_id', 'Тест не содержит вопросов.');

                return;
            }

            foreach ($answers as $questionId => $answerId) {
                if (! in_array($questionId, $validQuestionIds)) {
                    $validator->errors()->add(
                        "answers.{$questionId}",
                        "Question #{$questionId} does not belong to test #{$testId}."
                    );

                    continue;
                }

                $answerExists = TestAnswer::where('id', $answerId)
                    ->where('test_question_id', $questionId)
                    ->exists();

                if (! $answerExists) {
                    $validator->errors()->add(
                        "answers.{$questionId}",
                        "Answer #{$answerId} is not valid for question #{$questionId}."
                    );
                }
            }
        });
    }
}
