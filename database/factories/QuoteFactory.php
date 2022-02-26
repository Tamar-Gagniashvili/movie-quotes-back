<?php

namespace Database\Factories;

use App\Models\Movie;
use App\Models\Quote;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class QuoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Quote::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $image = $this->faker->image();
        $imageFile = new File($image);
        return [
            'movie_id'  => Movie::factory(),
            'thumbnail' => Storage::disk('public')->putFile('thumbnails', $imageFile),
            'text'      => [
                'en' => $this->faker->words(4, true),
                'ka' => $this->faker->words(5, true),
            ],
        ];
    }
}
