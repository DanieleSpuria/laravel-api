<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Helpers\CustomHelper;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
      for ($i = 0; $i < 50; $i++) {
        $new_project = new Project();
        $new_project->type_id = Type::inRandomOrder()->first()->id;
        $new_project->title = $faker->sentence();
        $new_project->slug = CustomHelper::generateSlug(new Project(), $new_project->title);
        $new_project->date = $faker->date();
        $new_project->description = $faker->text(1000);
        $new_project->save();
      }
    }
}
