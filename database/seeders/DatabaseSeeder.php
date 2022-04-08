<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\FoodTable;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Event::factory()->count(5)->create();
        FoodTable::factory()->count(5)->create();
        Menu::factory()->count(5)->create();
        MenuItem::factory()->count(5)->create();
    }
}
