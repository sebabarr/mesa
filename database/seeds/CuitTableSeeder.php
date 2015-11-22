<?php

use Illuminate\Database\Seeder;

class CuitTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker\Factory::create();
        
        for($i=0;$i<15;$i++){
        \DB::table('cuits')->insert(array(
            'descripcion'=>$faker->company,
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
            'cuit'=>$faker->randomNumber(2).'-'.$faker->randomNumber(8).'-'.$faker->randomNumber(1)));
        }
    }
}