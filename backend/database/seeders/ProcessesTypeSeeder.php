<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProcessesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('processes_type')->insert([
            'type' => 'VOWELS_COUNT',
            'command' => 'vowels_count.js',
        ]);
    }
}
