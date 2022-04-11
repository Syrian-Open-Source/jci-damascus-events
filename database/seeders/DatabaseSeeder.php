<?php

namespace Database\Seeders;

use App\Models\ChairTable;
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
        \App\Models\User::factory()->create([
            'name' => 'Karam Mustafa',
            'email' => 'karam2mustafa@gmail.com',
            'password' => '12345678',
            'role' => 'admin',
        ]);
        $event = Event::factory()->create([
            'cover' => public_path('images/event-test.jpg')
        ]);

        $data = ['event_id' => $event->id];

        for ($i=0; $i <= 1; $i++){
            $table = FoodTable::factory()->create($data);

            ChairTable::factory()->count(7)->create([
                'food_table_id' => $table->id,
            ]);

        }

        $menu = Menu::factory()->create($data);

        MenuItem::factory()->count(5)->create([
            'menu_id' => $menu->id,
        ]);
    }
}
