<?php

use Illuminate\Database\Seeder;
use App\comments;
class comments2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($x = 0; $x <= 10000; $x++) {
        $faker = Faker\Factory::create('pl_PL');
        $comments = new comments();
        $comments->content = $faker->text;
        $comments->post_id = rand(0,1000);
        $comments->ower_id = rand(0,103);
        $comments->save();
  }
    }
}
