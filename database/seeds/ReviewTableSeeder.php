<?php

use Illuminate\Database\Seeder;

class ReviewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Review::class,50)->create()->each(function($u){
            $u->save(factory(App\Review::class)->make());
        });
    }
}
