<?php
// エラーの表示設定
ini_set('display_errors', "On");
// 文字コードの表示
mb_internal_encoding("UTF-8");

// POSTされた時
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // edit.phpを読み込む
  require("./edit.php");

  // txtが送信された場合
  if (!empty($_POST['txt'])) {
    // 文字列を書き込む関数の呼び出し
    if (!insert_msg($_POST['txt'])) {
      // 文字列にエラーがあった場合アラートを表示
      print '<script>
      alert("文字列にエラーがあります．\n文字数，改行位置を確認してください．");
      location.href = "./all_list.php";
      </script>';
    }
  }

  // 削除が選択された時
  if (!empty($_POST['id'])) {
    // postされたidを数値に変換
    $id = intval($_POST['id']);
    // 文字列を削除する関数の呼び出し
    delete_msg($id);
  }
}

// telop.txtの内容を読み込み配列に格納する
$handle = file('./telop.txt');

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <!-- CSSファイルの読み込み -->
  <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css" >

  <title>テロップ追加ページ</title>
</head>
<body>
  <div class="container">
    <div class="page-header">
      <h1>テロップの追加ページ</h1>
    </div>

    <form name="telop" action="./all_list.php" method="post">
      <table class="table lead">
        <thead>
          <tr class="row">
            <th lass="col-lg-12" colspan="2">テロップに表示したい文章をボックス内に記入後，送信ボタンを押してください．</th>
          </tr>
        </thead>

        <tbody>
          <tr class="row">
            <td class="col-lg-11"><input type="text" name="txt" class="form-control"></td>
            <td class="col-lg-1"><input type="submit" class="btn btn-primary" value="送信" onclick="check()"></td>
          </tr>
        </tbody>
      </table>
    </form>
    <div class="panel panel-warning">
      <div class="panel-heading">
        <h3 class="panel-title">テロップに関する注意事項</h3>
      </div>
      <div class="panel-body lead well-sm">
        <ul>
          <li>文章の長さは最大72文字です．また36文字目で自動で改行されます．</li>
          <li>任意の場所で改行したい場合は，改行したい位置に&lt;br&gt;と書き込んでください．(改行は1回まで)</li>
          <li>改行を行う場合は，1行目，2行目ともに36文字以下になるようにしてください．</li>
          <li>改行タグ(&lt;br&gt;)は文字数としてカウントされません．(&lt;br&gt;を含めないで72文字まで記載可能)</li>
          <li>テロップを削除したい場合は削除したい文章の削除ボタンを押してください．</li>
        </ul>
      </div>
    </div>

    <table class="table table-striped">
      <thead>
        <tr class="row lead">
          <th class="col-lg-11">表示中のテロップ</th>
          <th class="col-lg-1">削除</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($handle as $key => $value) : ?>
          <tr class="row lead">
            <td class="col-lg-11">
              <?php echo $value ?>
            </td>
            <td class="col-lg-1">
              <form name="edit" action="./all_list.php" method="post" onclick='return confirm("削除してもいいですか？");'>
                <input type="hidden" name="id" value="<?php echo $key+1 ?>">
                <input type="submit" name="delete" value="削除" class="btn btn-danger">
              </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- 文字入力がない場合の警告ポップアップ -->
  <script language="JavaScript">
  function check() {
    if(document.telop.txt.value == "") { //formのtxtの値が空欄だった場合
      alert("文字を入力してください．");    //alertを表示する
    }
  }
  </script>

</body>
</html>
