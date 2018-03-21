<?php

use Illuminate\Database\Seeder;

class CompHasLinksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = DB::table('company')->where('name', 'Rings With Bing')->first();

    }
}
