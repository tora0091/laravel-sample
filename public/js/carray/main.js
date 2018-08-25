$(function() {

    /**
     * 持出テキストエリアにフォーカスをあてる
     */
    $("#carray-input-textarea").ready(function() {
        $("#carray-input-textarea").focus();
    });

    /**
     * 戻るボタンを押された際の処理
     */
    $("#carray-backlist-button").click(function() {
        window.location.href = '/carray/listed';
    });
});