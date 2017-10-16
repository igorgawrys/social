<?php

use Illuminate\Database\Seeder;
use App\friends;
class friends2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($x = 0; $x <= 100; $x++) {
        $faker = Faker\Factory::create('pl_PL');
        $friends = new friends();
        $friends->one_friends_id = rand(0,103);
        $friends->two_friends_id = rand(0,103);
          $friends->status = 'success';
        $friends->save();
  }
  //for ($x = 0; $x <= 100; $x++) {
    //$faker = Faker\Factory::create();
    //$friends = new friends();
  //  $friends->one_friends_id = 103;
    //$friends->two_friends_id = $x;
    //$friends->status = 'success';
    //$friends->save();
//}
    }
}
