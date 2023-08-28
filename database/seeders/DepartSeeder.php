<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\Depart;

class DepartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Depart::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'GARMEN', 'AUDIT'
        ];

        foreach($data as $value){
            Depart::insert([
                'depart' => $value
            ]);
        }
    }
}
