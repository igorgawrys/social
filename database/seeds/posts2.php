<?php

use Illuminate\Database\Seeder;
use App\posts;
class posts2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($x = 0; $x <= 1000; $x++) {
        $faker = Faker\Factory::create('pl_PL');
        $posts = new posts();
        $posts->content = $faker->text;
        $posts->ower_id = rand(0,103);
        $posts->save();
  }
    }
}
