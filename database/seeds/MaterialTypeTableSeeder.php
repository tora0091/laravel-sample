<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // maybe it's test data!! 
        $dataList = [
            [ 'material_code' => 1, 'material_name' => 'アブドミナル', ],
            [ 'material_code' => 2, 'material_name' => 'アブクランチ', ],
            [ 'material_code' => 3, 'material_name' => 'トレッドミル', ],
            [ 'material_code' => 4, 'material_name' => 'ロウアーバック', ],
            [ 'material_code' => 5, 'material_name' => 'チェストプレス', ],
            [ 'material_code' => 6, 'material_name' => 'ショルダープレス', ],
            [ 'material_code' => 7, 'material_name' => 'レッグプレス', ],
            [ 'material_code' => 8, 'material_name' => 'レッグカール', ],
            [ 'material_code' => 9, 'material_name' => 'スクワットマシン', ],
        ];

        foreach ($dataList as $data) {
            DB::table('material_type')->insert($data);
        }
    }
}
