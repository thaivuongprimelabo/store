<?php

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $vendors = [];
        for($i = 1; $i < 50; $i++) {
            $vendor = [   
                'id' => $i,
                'name' => str_random(10),
                'name_url' => str_random(10),
                'logo' => '',
                'description' => str_random(200),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
            
            array_push($vendors, $vendor);
        }
        
        DB::table('vendors')->delete();
        DB::table('vendors')->insert($vendors);
    }
}
