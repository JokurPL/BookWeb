<?php

use Illuminate\Database\Seeder;


class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<50;$i++) {
            $author = new \App\Author();
            $author->name = $faker->name;
            $author->save();
        }

    }
}
