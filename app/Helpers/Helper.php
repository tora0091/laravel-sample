<?php

/**
 * function: _viewhelper_work_title_input_box
 */
if (!function_exists('_viewhelper_work_title_input_box')) {
    /**
     * 件名入力ボックスヘルパー
     *
     * @param SchedulePostDto $dto 予約管理データオブジェクト
     * @param integer $listNum リストの初期数値
     * @return string 作成したHTML
     */
    function _viewhelper_work_title_input_box($dto, $listNum) {
        $htmlTag = "";
        if ($dto->work_title === null) {
            for ($i = 0; $i < $listNum; $i++) {
                $htmlTag .= '<tr><td><input type="text" id="subject" name="work_title[]" class="form-control"></td></tr>';
            }
        } else {
            for ($i = 0; $i < count($dto->work_title); $i++) {
                $htmlTag .= '<tr><td><input type="text" id="subject" name="work_title[]" value="' . e($dto->work_title[$i]) . '" class="form-control"></td></tr>';
            }
        }
        return $htmlTag;
    }
}
/**
 * function: _viewhelper_material_input_box
 */
if (!function_exists('_viewhelper_material_input_box')) {
    /**
     * 機材入力ボックスヘルパー
     *
     * @param SchedulePostDto $dto 予約管理データオブジェクト
     * @param integer $listNum リストの初期数値
     * @param array $materialTypeList 機材名リスト
     * @return string 作成したHTML
     */
    function _viewhelper_material_input_box($dto, $listNum, $materialTypeList) {
        $htmlTag = "";
        if ($dto->material === null) {
            // 初回時表示
            for ($i = 0; $i < $listNum; $i++) {
                $htmlTag .= '<tr>';
                $htmlTag .= '<td>' . _make_selected_tag($materialTypeList, NULL) . '</td>';
                $htmlTag .= '<td><input type="number" id="number" name="number[]" value="" class="form-control" min="1" max="99"></td>';
                $htmlTag .= '</tr>';
            }
        } else {
            // 登録済みデータ表示
            for ($i = 0; $i < count($dto->material); $i++) {
                $htmlTag .= '<tr>';
                $htmlTag .= '<td>' . _make_selected_tag($materialTypeList, $dto->material[$i]) . '</td>';
                $htmlTag .= '<td><input type="number" id="number" name="number[]" value="' . e($dto->number[$i]) . '" class="form-control" min="1" max="99"></td>';
                $htmlTag .= '</tr>';
            }
        }
        return $htmlTag;
    }

    /**
     * セレクトボックスの作成
     *
     * @param array $materialTypeList 機材名リスト
     * @param string $default selected値
     * @return string 作成したHTML
     */
    function _make_selected_tag($materialTypeList, $default) {
        $selectedTag = '<select id="material" name="material[]" class="form-control">';
        $selectedTag .= '<option></option>';
        foreach ($materialTypeList as $materialType) {
            $format = '<option value="%s" %s>%s</option>';
            $selectedTag .= sprintf($format,
                    e($materialType['material_code']),
                    ($materialType['material_code'] == $default) ?  "selected='true'" : "",
                    e($materialType['material_name']));
        }
        $selectedTag .= '</select>';
        return $selectedTag;
    }
}
/**
 * function: _viewhelper_hidden_table
 */
if (!function_exists('_viewhelper_hidden_table')) {
    /**
     * 件名・機材で入力項目を追加する際に利用するテーブル
     * ※戻るで値が入力された状態で追加を押すと値も引き継がれるためから項目を作成
     *
     * @param array $materialTypeList 機材種別リスト
     * @return string テーブルHTML
     */
    function _viewhelper_hidden_table($materialTypeList) {
        $htmlTag = '<table style="display:none;">';
        $htmlTag .= '<tr id="work-title-tr-area"><td><input type="text" id="subject" name="work_title[]" class="form-control"></td></tr>';
        $htmlTag .= '<tr id="material-tr-area">';
        $htmlTag .= '<td>' . _make_selected_tag($materialTypeList, NULL) . '</td>';
        $htmlTag .= '<td><input type="number" id="number" name="number[]" value="" class="form-control" min="1" max="99"></td>';
        $htmlTag .= '</tr>';
        $htmlTag .= '</table>';
        return $htmlTag;
    }
}
/**
 * function: _get_material_name
 */
if (!function_exists('_get_material_name')) {
    /**
     * 機材コードから機材名を取得
     *
     * @param string $materialCode 機材コード
     * @param array $materialTypeList 機材種別リスト
     * @return string 機材名
     */
    function _get_material_name($materialCode, $materialTypeList) {
        foreach ($materialTypeList as $material) {
            if ($materialCode == $material['material_code']) {
                return e($material['material_name']);
            }
        }
        return "";
    }
}
/**
 * function: _date_format
 */
if (!function_exists('_date_format')) {
    /**
     * 日付文字列のフォーマットをYYYY/mm/ddに変換して返す
     *
     * @param string $date_string
     * @return string フォーマット後の文字列
     */
    function _date_format($date_string) {
        return date('Y/m/d', strtotime($date_string));
    }
}