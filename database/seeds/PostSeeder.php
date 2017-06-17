<?php

use Illuminate\Database\Seeder;
use App\Post;
use Illuminate\Support\Facades\DB;
use Faker\Factory;
class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = factory::create();
        foreach (range(1, 50) as $i){
          Post::create([
              'title'=>$faker->sentence,
              'description'=>$faker->paragraph(mt_rand(5, 15)),
          ]);    
        }
        
    }
}
