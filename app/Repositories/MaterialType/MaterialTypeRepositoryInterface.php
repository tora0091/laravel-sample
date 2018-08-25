<?php

namespace App\Repositories\MaterialType;

interface MaterialTypeRepositoryInterface
{
    /**
     * リスト作成データ取得
     *
     * @return array 取得データ
     */
    public function materialTypeList();
}