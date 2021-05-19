<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\Hotel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

      $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
      $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d H:i:s').' +2 days');
      
      $hotel_id = Hotel::where('id' ,'>' ,0)->pluck('id')->toArray();

        return [
            'hotel_id' => $this->faker->randomElement($hotel_id),
            'start_date' => $start,
            'end_date' => $end,
            'adult_rate' => $this->faker->numberBetween($min = 200, $max = 300),
            'child_rate' => $this->faker->numberBetween($min = 50, $max = 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

  
}
