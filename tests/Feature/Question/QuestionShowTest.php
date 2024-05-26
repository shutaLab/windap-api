<?php

namespace Tests\Feature\Question;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class QuestionShowTest extends TestCase
{

    use RefreshDatabase;

    public function test_200(): void
    {
        $question = Question::factory()->create();

        $answers = Answer::factory()->count(3)->create(['question_id' => $question->id]);


        $response = $this->getJson("/api/question/{$question->id}");

        dump($response->json());
        $response->assertStatus(200);
    }
}
