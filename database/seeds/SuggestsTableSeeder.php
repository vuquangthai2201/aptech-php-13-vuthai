<?php

use Illuminate\Database\Seeder;

class SuggestsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Suggest::class, 5)->create();
    }
}
