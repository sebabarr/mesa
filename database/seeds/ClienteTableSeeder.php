<?php

use Illuminate\Database\Seeder;

class ClienteTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker\Factory::create();
        for($i=0;$i<10;$i++){
            
            \DB::table('clientes')->insert(array(
                'razonsocial'=>$faker->firstName." ".$faker->lastName,
                'direccion'=>$faker->streetName." ".$faker->buildingNumber,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
                'limite_chp' =>$faker->numberBetween($min = 10000, $max = 90000),
                'limite_cht' =>$faker-> numberBetween($min = 30000, $max = 90000),
                'tasa_desc'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 3, $max = 6),
                'tasa_gasto'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 3),
                'gasto_fijo'=>$faker->numberBetween($min = 10, $max = 40),
                'telefono'=>$faker->phoneNumber));
                
        }        
    }
}