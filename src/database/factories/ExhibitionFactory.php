<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Exhibition;

class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Exhibition::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word . ' 商品',
            'detail' => $this->faker->sentence(10),
            'category' => $this->faker->randomElement(['家電', '本', 'ファッション', 'おもちゃ', '家具']),
            //'product_image' => 'images/sample' . rand(1, 5) . '.jpg', // 画像は仮
            'product_image' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/400/300',
            'condition' => $this->faker->numberBetween(0, 2), // 0:新品, 1:美品, 2:使用感あり
            'price' => $this->faker->numberBetween(1000, 20000),
        ];
    }
}
