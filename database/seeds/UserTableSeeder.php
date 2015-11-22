<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {
    
    public function run() {
        
        $faker = Faker\Factory::create();
        for($i=0;$i<10;$i++){
            
            \DB::table('users')->insert(array(
                'name'=>$faker->firstName,
                'email'=>$faker->email,
                'created_at' => date('Y-m-d H:m:s'),
                'updated_at' => date('Y-m-d H:m:s'),
                'password'=>\Hash::make('54321')));
        }        
    }
}