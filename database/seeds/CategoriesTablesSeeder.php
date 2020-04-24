<?php

use Illuminate\Database\Seeder;

use App\Models\Category;

class CategoriesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $categories = [
        ["name" => "Cadeaux"],
        ["name" => "Musique et concert"],
        ["name" => "Spectavle"],
        ["name" => "Voyage"],
        ["name" => "Sport"]
      ];
      
      foreach ($categories as $value)
      {
        $category = new Category();
        $category->name = $value["name"];
        $category->save();
      }
    }
}
