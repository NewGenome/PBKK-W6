<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Project>
 */
class ProjectFactory extends Factory
{
    protected $model = Project::class;
    
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected array $themes = [
            'Ollama',
            'LangChain',
            'CrewAI',
            'AutoGen',
            'MetaGPT',
            'AutoGPT',
            'SuperAGI',
            'BabyAGI',
            'LlamaIndex',
            'Haystack',
    ];

    protected array $subjects = [
            'Autonomous Research Assistant',
            'Multi-Agent Code Review System',
            'Adaptive Customer Support Agent',
            'Self-Healing CI/CD Pipeline Agent',
            'Agentic RAG for Academic Literature',
            'Personalized Learning Path Agent',
            'Autonomous Data Cleaning Agent',
            'Smart Contract Audit Agent',
            'Multi-Agent Supply Chain Optimizer',
            'Agentic Meeting Summarizer',
            'Autonomous Bug Triage Assistant',
            'Conversational Database Analyst Agent',
    ];

    public function definition(): array {
        $subject = fake()->randomElement($this->subjects);
        $theme   = fake()->randomElement($this->themes);
        
        return [
            'judul'          => "{$subject}: {$theme} Implementation",
            'deskripsi'      => fake()->paragraph(4),
            'tema_agent'     => $theme,
            'api_key_secure' => 'sk-' . Str::random(48),
            'user_id'        => User::factory(),
        ];
    }
}
