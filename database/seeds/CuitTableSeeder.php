<?php

use Illuminate\Database\Seeder;

class CuitTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker\Factory::create();
        for($i=0;$i<20;$i++){
            
            \DB::table('cuits')->insert(array(
                'razonsocial'=>$faker->firstName." ".$faker->lastName,
                'numero'=>$faker->numberBetween($min = 1, $max = 99).
                 $faker->numberBetween($min = 10000000, $max = 99000000)
                .$faker->numberBetween($min = 1, $max = 9),
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')
                ));
                
        }        
    }
}