<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\MenuItem;
use App\Models\MenuItemMember;
use App\Models\UserId;

class MenuItemMemberFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItemMember::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(4),
            'menu_item_id' => MenuItem::factory(),
            'user_id' => UserId::factory(),
        ];
    }
}
