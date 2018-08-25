/**
 * 最新版(v3.3.1)のjQueryでは、safariで動作しない部分が多数あり append 等々
 * 今回の対象ブラウザは safari がメインとなるため利用する jQuery のバージョンを下げて実装
 * 
 * jQuery v1.9.1
 */
$(function() {

    /**
     * 予定入力: カレンダー
     */
    $("schedule-input-form").ready(function() {
        $("#from").datepicker();
        $("#to").datepicker();
    });

    /** 
     * 予定入力: キャンセルボタンアクション
     */
    $("#schedule-cancel-button").click(function () {
        window.location.href = '/schedule/';
    });

    /** 
     * 予定入力: キャンセルボタンアクション（編集）
     */
    $("#schedule-edit-cancel-button").click(function () {
        window.location.href = '/schedule/listed';
    });

    /**
     * 予定入力: 追加ボタンアクション
     */
    $("#schedule-add-work-button").click(function () {
        $("#work-title-tr-area").clone().appendTo("#schedule-add-work-table");
    });

    /**
     * 予定入力: 機材追加ボタンアクション
     */
    $("#schedule-add-matirial-button").click(function () {
        $("#material-tr-area").clone().appendTo("#schedule-add-matirial-table");
    });
});