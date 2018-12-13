<?php

use Illuminate\Database\Seeder;

class ProductTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->delete();
    	
        DB::table('product_types')->insert([
                ['id'=>'1','name' => 'File'],
                ['id'=>'2','name' => 'Code'],
                ['id'=>'3','name' => 'Service']
            ]);
    }
}
