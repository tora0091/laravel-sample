<?php

namespace App\Validator;

use App\Models\Sequence;

class CustomValidator extends \Illuminate\Validation\Validator
{
    /**
     * 空配列かつ空配列でなくとも空文字の要素だけであればエラーとする
     *
     * @param string $attribute 属性
     * @param array $values 値
     * @param array $parameters パラメータ
     * @return boolean true: OK  false: NG
     */
    public function validateArrayRequired($attribute, $values, $parameters)
    {
        if (is_array($values) && count($values) > 0) {
            foreach ($values as $value) {
                if (strlen($value) > 0) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 機材と数量に対するバリデーション
     * 機材が入力されておりかつ対応する数値が存在する場合をtrueとする
     *
     * @param string $attribute 属性
     * @param array $values 値
     * @param array $parameters パラメータ
     * @return boolean true: OK  false: NG
     */
    public function validateMaterialNumber($attribute, $values, $parameters)
    {
        // 機材リスト
        $materials = $values;
        // 数量リスト取得
        $numbers = $this->getValue($parameters[0]);
        
        foreach ($materials as $key => $materialNo) {
            // 入力パターン下記4つ
            //   機材入力 かつ 数値入力 : OK
            //   機材入力 かつ 数値未入力 : NG
            //   機材未入力 かつ 数値入力 : NG
            //   機材未入力 かつ 数値未入力 : OK
            if ($materialNo !== null && $numbers[$key] === null) {
                return false;
            }
            if ($materialNo === null && $numbers[$key] !== null) {
                return false;
            }
        }
        return true;
    }

    /**
     * 配列の内容が数値であることを確認するバリデーション
     *
     * @param string $attribute 属性
     * @param array $values 値
     * @param array $parameters パラメータ
     * @return boolean true: OK  false: NG
     */
    public function validateArrayNumbers($attribute, $values, $parameters)
    {
        foreach ($values as $value) {
            if ($value !== null && !preg_match('/^\d+$/', $value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * スケジュール管理番号に対するバリデーション
     *
     * @param string $attribute 属性
     * @param array $values 値
     * @param array $parameters パラメータ
     * @return boolean true: OK  false: NG
     */
    public function validateScheduleNoFormat($attribute, $values, $parameters)
    {
        // 必須ではないので空の場合はtrueを返す
        if (strlen($values) === 0) {
            return true;
        }

        // フォーマットチェック
        $patterns = '/^[' . Sequence::PREFIX_SCHEDULE . '|' . Sequence::PREFIX_SCHEDULE_NEW . ']\d{10}/';
        if (preg_match($patterns, $values)) {
            return true;
        }
        return false;
    }
}
