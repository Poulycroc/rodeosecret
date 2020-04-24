<?php

use Illuminate\Database\Seeder;

use App\Models\Competition;

class CompetitionsTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      factory(Competition::class, 10)->create();
    }
}
