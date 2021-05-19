<?php

namespace Database\Factories;

use App\Models\Hotel;
use App\Models\Rate;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class HotelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Hotel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

      $star = [3, 4, 5, 7];
        return [
            'name' => $this->faker->company(),
            'stars' => $this->faker->randomElement($star),
            'address' => $this->faker->address(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

  
}
