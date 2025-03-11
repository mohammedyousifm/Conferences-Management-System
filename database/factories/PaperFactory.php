<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Paper; // Change to the correct model name

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Paper>
 */
class PaperFactory extends Factory
{
    /**
     * The name of the model that this factory corresponds to.
     *
     * @var string
     */
    protected $model = Paper::class; // Change to the correct model name

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 5,
            'conference_id' => \App\Models\Conference::factory(),
            'paper_title' => $this->faker->sentence(6),
            'abstract' => $this->faker->paragraph(3),
            'paper_file' => $this->faker->filePath(),
            'version' => $this->faker->randomDigitNotNull(),
            'keywords' => implode(', ', $this->faker->words(5)),
            'status' => $this->faker->randomElement(['In process', 'Approved', 'Rejected']),
            'author_name' => $this->faker->name(),
            'paper_code' => str_pad($this->faker->unique()->numberBetween(1, 99999), 5, '0', STR_PAD_LEFT),
            'phone' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'number_of_authors' => $this->faker->randomDigitNotNull(),
            'address' => $this->faker->address(),
        ];
    }
}
