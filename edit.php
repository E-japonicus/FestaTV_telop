<?php
// エラーの表示設定
ini_set('display_errors', "On");
// 文字コードの表示
mb_internal_encoding("UTF-8");

// 文字列のチェックを行う関数
function check_msg($str){
  // 表示できる最大の文字数
  $maxstr = 36;

  // 文字列の長さ
  $strlen = mb_strlen($str, "UTF-8");

  // 文字列の中にある改行タグの個数
  $strbr = mb_substr_count($_POST['txt'], '<br>', "UTF-8");

  // 改行タグがある場合
  if ($strbr !== 0) {

    // 改行タグありで76文字以下の場合
    if ($strlen <= $maxstr*2+4) {
      // 改行タグの場所で文字列を分割
      $div = explode("<br>", $str);
      // それぞれの文字列の長さを判定
      $div_1 = mb_strlen($div[0], "UTF-8");
      $div_2 = mb_strlen($div[1], "UTF-8");

      // 改行タグが1個の場合
      if ($strbr === 1) {

        // それぞれの文字列が36文字以下の場合
        if ($div_1 <= $maxstr and $div_2 <= $maxstr) {
          return $str;

          // どちらかかが37文字以上の場合アラートを表示
        } else {

          return false;
        }

        // 改行タグが2つ以上の場合3行になるのでアラート
      } else {

        return false;
      }

      // 改行タグありで77文字以上の場合3行になるのでアラートを表示
    } else {

      return false;
    }

    // 改行タグがない場合
  } else {

    // 改行タグなしで36文字以下の場合1行で表示されるのでそのまま返す
    if ($strlen <= $maxstr) {
      return $str;

      // 改行タグなしで72文字以下の場合
    } elseif ($strlen <= $maxstr*2) {
      // 37文字目に改行タグを入れて返す
      $str = preg_replace('/^.{0,36}+\K/us', '<br>', $str);
      return $str;

      // 改行タグなしで73文字以上の場合3行になるのでアラートを表示
    } else {

      return false;
    }
  }
}

// 文字列の書き込みを行う関数
function insert_msg($str){
  // 文字列のチェックを行う
  $str = check_msg($str);

  // 文字列にエラーがない時
  if ($str !== false) {
    // 文字列にtxt改行タグを挿入
    $str = $str."\n";
    // telop.txtに文字列を書き込む
    file_put_contents('./telop.txt', $str, FILE_APPEND | LOCK_EX);
    return true;
  } else {
    // 文字列にエラーがあった場合
    return false;
  }
}

// 文字列の削除を行う関数
function delete_msg($id){
  // telop.txtファイル全体を読み込んで配列に格納する
  $handle  = file('./telop.txt');
  // postされた行数を削除する
  array_splice($handle, $id-1, 1);
  // telop.txtに削除された文字列以外を書き込む
  file_put_contents('./telop.txt', $handle);

  return true;
}

?>
