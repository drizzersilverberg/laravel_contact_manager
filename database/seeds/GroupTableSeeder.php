<?php

use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->truncate();

        // create array of insert batch
        $groups = [
        	['id' => 1, 'name' => 'Family', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        	['id' => 1, 'name' => 'Friends', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        	['id' => 1, 'name' => 'Clients', 'created_at' => new DateTime, 'updated_at' => new DateTime],
        ];
    
    	// insert the batch
        DB::table('groups')->insert($groups);

    }
}
