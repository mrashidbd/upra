<?php

namespace Database\Factories;

use App\Models\ShareInformation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShareInformation>
 */
class ShareInformationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ShareInformation::class;

    public function definition(): array
    {
        $unitBuyingPrice = $this->faker->randomFloat(2, 25, 35);
        $sold = $this->faker->boolean();
        $unitSoldPrice = $sold ? $this->faker->randomFloat(2, 3, 10) : null;
        $shareUnit = $this->faker->numberBetween(50, 1500);
        $calculatedLoss = $sold ? ($unitBuyingPrice - $unitSoldPrice) * $shareUnit : ($unitBuyingPrice - 2) * $shareUnit;

        return [
            'user_id' => User::factory(),
            'share_unit' => $shareUnit,
            'unit_buying_price' => $unitBuyingPrice,
            'is_sold' => $sold,
            'unit_sold_price' => $unitSoldPrice,
            'calculated_loss' => $calculatedLoss,
            'note' => $this->faker->sentence(),
            'supporting_document_path' => $this->faker->filePath(),
        ];
    }
}
