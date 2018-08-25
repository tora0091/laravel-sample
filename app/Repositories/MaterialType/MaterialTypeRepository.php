<?php

namespace App\Repositories\MaterialType;

use App\Models\MaterialType;

class MaterialTypeRepository implements MaterialTypeRepositoryInterface
{
    /**
     * リスト作成データ
     *
     * @return Array リスト作成データ 
     */
    public function materialTypeList()
    {
        return MaterialType::all(['material_code', 'material_name'])
                ->where('delete_flag', '=', 0)
                ->sortBy('id')
                ->toArray();
    }
}
