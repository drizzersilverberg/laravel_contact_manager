<?php

use Illuminate\Database\Seeder;

// 1. Load Faker Library
use Faker\Factory as Faker;

class ContactTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        
        $users = [];
        for($i=1; $i <= 3; $i++){
            $users[] = [
                'name' => "User {$i}",
                'email' => "user{$i}@gmail.com",
                'password' => bcrypt("user{$i}")
            ];
        }
        DB::table('users')->insert($users);

        DB::table('contacts')->truncate();

        // Instantiate Faker Object
        $faker = Faker::create();
        // create array for insert batch
        $contacts = [];

        // create insert batch
        foreach (range(1,20) as $index){
        	$contacts[] = [
        		'name' => $faker->name,
        		'email' => $faker->email,
        		'phone' => $faker->phoneNumber,
        		'address' => "{$faker-> streetName} {$faker->postCode} {$faker->city}",
        		'company' => $faker->company,
        		'group_id' => rand(1,3),
                'user_id' => rand(1,3),
        		'created_at' => new DateTime, 
        		'updated_at' => new DateTime, 
        	];
        }

        // insert the batch
        DB::table('contacts')->insert($contacts);
    }
}
