<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Helpers\CustomHelper;
use App\Models\Technology;

class TechnologiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data = ['HTML', 'CSS', 'JavaScript', 'Vue.JS', 'Vite', 'Php', 'Sql', 'Laravel'];

      foreach($data as $technology) {
        $new_technology = new Technology();
        $new_technology->name = $technology;
        $new_technology->slug = CustomHelper::generateSlug(new Technology, $technology);
        $new_technology->save();
      }
    }
}
