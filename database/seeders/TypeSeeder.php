<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Type;

use Faker\Generator;

class TypeSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run(Generator $faker)
  {
    $_types = [
      "Html_Css",
      "Git_Vs_code",
      "Javascript",
      "Php",
      "Vite",
      "Vue3",
      "Db_SQL",
      "Laravel",
    ];

    foreach ($_types as $_type) {
      $type = new Type();
      $type->label = $_type;
      $type->color = $faker->hexColor();
      $type->save();
    }
  }
}