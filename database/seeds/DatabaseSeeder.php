<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(posts2::class);
        $this->call(comments2::class);
        $this->call(friends2::class);
        $this->call(users2::class);
    }
}
