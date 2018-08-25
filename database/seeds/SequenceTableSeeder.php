<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SequenceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = date('Y-m-d H:i:s');

        // maybe it's test data!!
        $dataList = [
            [ 'prefix' => 'S', 'number' => 0, 'created_at' => $now, 'updated_at' => $now ],
            [ 'prefix' => 'N', 'number' => 0, 'created_at' => $now, 'updated_at' => $now ],
        ];

        foreach ($dataList as $data) {
            DB::table('sequence')->insert($data);
        }
    }
}