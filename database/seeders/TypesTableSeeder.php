<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;
use App\Helpers\CustomHelper;

class TypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['FrontEnd', 'BackEnd', 'Full-Stack'];

        foreach($data as $type) {
          $new_type = new Type();
          $new_type->name = $type;
          $new_type->slug = CustomHelper::generateSlug(new Type() , $type);
          $new_type->save();
        }
    }
}
