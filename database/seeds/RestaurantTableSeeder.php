<?php
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class RestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Resto::class,50)->create()->each(function($u){
            $u->save(factory(App\Resto::class)->make());
        });
    }
}
