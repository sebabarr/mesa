<?php

use Illuminate\Database\Seeder;

class OperacionTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker\Factory::create();
        for($i=0;$i<10;$i++){
            
            \DB::table('operaciones')->insert(array(
                'moneda'=>$faker->randomElement($array = array ('Dolar','Real','Euro')),
                'comprador'=>$faker->firstNameMale,
                'vendedor'=>$faker->firstNameMale,
                'tipo_mov'=>$faker->randomElement($array = array ('compra','venta','aporte','retiro')), // 'b',
                'cotizacion'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = 20), // 48.8932
                'importe'=>$faker->randomFloat($nbMaxDecimals = 2, $min = 1, $max = NULL), // 48.8932
                
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s')));
                
        }        
    }
}