<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->truncate();
    	
        DB::table('currencies')->insert([
                ['name' => 'US Dollar','code' => 'usd','symbol' => '&#36;','rate' => '1.00'],
                ['name' => 'Pound Sterling','code' => 'gbp','symbol' => '&pound;','rate' => '0.65'],
                ['name' => 'Europe','code' => 'eur','symbol' => '&euro;','rate' => '0.88'],
                ['name' => 'India','code' => 'inr','symbol' => '&#x20B9;','rate' => '66.24'],
                ]);
    }
}
