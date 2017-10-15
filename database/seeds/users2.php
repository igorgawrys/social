<?php

use Illuminate\Database\Seeder;
use App\User;
class users2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for ($x = 0; $x <= 50; $x++) {
        $faker = Faker\Factory::create('pl_PL');
        $user = new User();
        $user->name = $faker->name('female');
        $user->email =  $faker->email;
        $user->password  = bcrypt('123456');
        $user->sex = 0;
        $user->images = 'img/women/'.rand(1,50).'.jpg';
        $user->save();
      }
      for ($x = 0; $x <= 50; $x++) {
        $faker = Faker\Factory::create('pl_PL');
        $user = new User();
        $user->name = $faker->name('male');
        $user->email =  $faker->email;
        $user->password  = bcrypt('123456');
        $user->sex = 1;
        $user->images = 'img/men/'.rand(1,50).'.jpg';
        $user->save();
      }
      $user = new User();
      $user->name = 'Igor Gawryś';
      $user->email =  'programista.igorgawrys@gmail.com';
      $user->password  = bcrypt('igor2006');
      $user->sex = 1;
      $user->images = 'img/men/igor.jpg';
      $user->save();
    }
}
