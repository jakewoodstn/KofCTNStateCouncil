<?php

//------------------------------------------------------------------------------             

//*** Japanese (jp_utf8) utf-8

//------------------------------------------------------------------------------

function setLanguage(){ 

    $lang['='] = "=";  // "equal";

    $lang['>'] = ">";  // "bigger";

    $lang['<'] = "<";  // "smaller";

    $lang['add'] = "登録";

    $lang['add_new'] = "+ 新規登録";

    $lang['add_new_record'] = "新規レコード登録";

    $lang['add_new_record_blocked'] = "セキュリティチェック：新規レコード登録は許可されていません。設定を確認してください。";

    $lang['adding_operation_completed'] = "登録が完了しました。";

    $lang['adding_operation_uncompleted'] = "登録が失敗しました。";

    $lang['and'] = "すべて(and)";

    $lang['any'] = "選択してください";

    $lang['ascending'] = "昇順";

    $lang['back'] = "戻る";

    $lang['cancel'] = "キャンセル";

    $lang['cancel_creating_new_record'] = "新規レコード作成を中止しますか？";

    $lang['check_all'] = "すべて選択";

    $lang['clear'] = "クリア";

    $lang['create'] = "作成"; 

    $lang['create_new_record'] = "新規レコード作成";

    $lang['current'] = "現在";

    $lang['delete'] = "削除"; 

    $lang['delete_record'] = "レコード削除";

    $lang['delete_record_blocked'] = "セキュリティチェック：レコード削除は許可されていません。設定を確認してください。";

    $lang['delete_selected'] = "選択済みを削除";

    $lang['delete_selected_records'] = "選択済みレコードを削除しますか？";

    $lang['delete_this_record'] = "このレコードを削除しますか？";

    $lang['deleting_operation_completed'] = "削除が完了しました。";

    $lang['deleting_operation_uncompleted'] = "削除が失敗しました";

    $lang['descending'] = "降順";

    $lang['details'] = "詳細";

    $lang['details_selected'] = "選択済みを照会";

    $lang['edit'] = "編集";

    $lang['edit_selected'] = "選択済みを編集";

    $lang['edit_record'] = "レコード編集"; 

    $lang['edit_selected_records'] = "選択済みレコードを編集しますか？";

    $lang['errors'] = "エラー";            

    $lang['export_to_excel'] = "Excelへエクスポート";

    $lang['export_to_pdf'] = "PDFへエクスポート";

    $lang['export_to_xml'] = "XMLへエクスポート";

    $lang['export_message'] = "<label class=\"default_dg_label\">ファイルの準備ができました: _FILE_<br />ダウンロード終了したら</label> <a class=\"default_dg_error_message\" href=\"javascript: window.close();\">ウィンドウを閉じてください</a>。";

    $lang['field'] = "項目";

    $lang['field_value'] = "項目値";

    $lang['file_find_error'] = "ファイルが見つかりません： <b>_FILE_</b><br />指定されたパスにファイルが存在しているか確認してください。";

    $lang['file_opening_error'] = "ファイルをオープンできません。パーミッションを確認してください。";

    $lang['file_writing_error'] = "ファイルに書き込みができません。パーミッションを確認してください。";

    $lang['file_invalid file_size'] = "不正なファイルサイズ";

    $lang['file_uploading_error'] = "アップロード中にエラーが発生しました。再試行してください。";

    $lang['file_deleting_error'] = "削除中にエラーが発生しました。";

    $lang['first'] = "最初";

    $lang['generate'] = "生成";

    $lang['handle_selected_records'] = "選択済みレコードを処理しますか？";

    $lang['hide_search'] = "検索領域を隠す";

    $lang['last'] = "最後";

    $lang['like'] = "部分一致";

    $lang['like%'] = "前方部分一致%";  // "begins with";

    $lang['%like'] = "%後方部分一致";  // "ends with";

    $lang['%like%'] = "%部分一致%";

    $lang['loading_data'] = "データをロード中...";

    $lang['max'] = "最大";

    $lang['next'] = "次";

    $lang['no'] = "いいえ";

    $lang['no_data_found'] = "データがありません。"; 

    $lang['no_data_found_error'] = "データがありません。コードシンタックスを確認してください。<br />大文字小文字の区別や、不要なシンボルが含まれているかもしれません。";

    $lang['no_image'] = "イメージなし";

    $lang['not_like'] = "異なる";

    $lang['of'] = "中";

    $lang['operation_was_already_done'] = "処理は既に完了しています。再実行できません。";

    $lang['or'] = "または(or)";

    $lang['pages'] = "ページ";

    $lang['page_size'] = "ページサイズ";

    $lang['previous'] = "前";

    $lang['printable_view'] = "印刷プレビュー";

    $lang['print_now'] = "印刷する";

    $lang['print_now_title'] = "このページを印刷するにはここをクリック";

    $lang['record_n'] = "レコード #";

    $lang['refresh_page'] = "最新情報を表示";

    $lang['remove'] = "消去";

    $lang['reset'] = "リセット";

    $lang['results'] = "結果";

    $lang['required_fields_msg'] = "<font color='#cd0000'>*</font> 項目必須";

    $lang['search'] = "検索"; 

    $lang['search_d'] = "検索領域"; // (description)

    $lang['search_type'] = "検索方法";

    $lang['select'] = "選択";

    $lang['set_date'] = "日付設定";

    $lang['sort'] = "並び替え";

    $lang['test'] = "テスト";

    $lang['total'] = "合計";

    $lang['turn_on_debug_mode'] = "デバッグモードで詳細情報を得ることができます。";

    $lang['uncheck_all'] = "選択解除";

    $lang['unhide_search'] = "検索領域表示";

    $lang['unique_field_error'] = "項目 _FIELD_ はユニークな値のみです - 再入力してください。";

    $lang['update'] = "更新";

    $lang['update_record'] = "レコード更新";

    $lang['update_record_blocked'] = "セキュリティチェック：レコード更新は許可されていません。設定を確認してください。";

    $lang['updating_operation_completed'] = "更新が完了しました。";

    $lang['updating_operation_uncompleted'] = "更新が失敗しました。";

    $lang['upload'] = "アップロード";

    $lang['view'] = "照会";

    $lang['view_details'] = "詳細照会";

    $lang['warnings'] = "警告";

    $lang['with_selected'] = "選択済みを";

    $lang['wrong_field_name'] = "不正な項目名";

    $lang['wrong_parameter_error'] = "項目 [<b>_FIELD_</b>] の不正なパラメータ: _VALUE_";

    $lang['yes'] = "はい";                



    // date-time

    $lang['day']    = "日";

    $lang['month']  = "月";

    $lang['year']   = "年";

    $lang['hour']   = "時";

    $lang['min']    = "分";

    $lang['sec']    = "秒";

    $lang['months'][1] = "1月";

    $lang['months'][2] = "2月";

    $lang['months'][3] = "3月";

    $lang['months'][4] = "4月";

    $lang['months'][5] = "5月";

    $lang['months'][6] = "6月";

    $lang['months'][7] = "7月";

    $lang['months'][8] = "8月";

    $lang['months'][9] = "9月";

    $lang['months'][10] = "10月";

    $lang['months'][11] = "11月";

    $lang['months'][12] = "12月";

    

    return $lang;

}

?>