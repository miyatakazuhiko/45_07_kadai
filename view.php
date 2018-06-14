<?php
session_start();
include("funcs.php");

loginCheck();

//1.DB接続
$pdo = db_connect();

//２．データ登録SQL作成
// $stmt = $pdo->prepare('SELECT * FROM kadai_07_table');
// $status = $stmt->execute();
$sql = "SELECT * FROM kadai_07_table WHERE ID=:ID AND pass=:pass";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ID', $_SESSION["ID"]);
$stmt->bindValue(':pass', $_SESSION["pass"]);
$res = $stmt->execute();

//３．データ表示
$view="";//データ表示のための変数
// if($status==false) {
// 一部表示
if($res==false){
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);

}else{
  //テーブル。
  $view .= '<table width="776px" border="1">';
  $view .= '<tr>';
  $view .=  '<th style="width:50px">No</th>';
  $view .=  '<th style="width:150px">書籍名</th>';
  $view .=  '<th style="width:200px">書籍URL</th> ';
  $view .=  '<th style="width:200px">書籍コメント</th>';
  $view .=  '<th style="width:80px">登録日時</th>';
  $view .=  '<th style="width:50px">削除</th>';
  $view .= '</tr>';

  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<tr>';
    $view .= "<td>";
    $view .= '<a href="u_view.php?id='.$result["No"].'">';
    $view .= $result["No"];
    $view .= '</a>';
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["書籍名"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["書籍URL"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["書籍コメント"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["登録日時"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= '<a href="delete.php?id='.$result["No"].'">';
    $view .= '削除';
    $view .= '</a>';
    $view .= "</td>";
    $view .= '</tr>';
  }

  $view .= '</table>';
}

// メモ
// echo "あ";
// echo ($_SESSION["ID"]);
// echo ($_SESSION["pass"]);
// echo ($_SESSION["No"]);
// echo ($_SESSION["書籍名"]);
// echo ($_SESSION["書籍URL"]); //なぜか取得してくれない。なぜだろう
// echo ($_SESSION["登録日時"]);
// echo ($_SESSION["書籍コメント"]);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>本をブックマーク</title>
</head>
<body>
  
<header>
  <h1>Bookmark</h1>
</header>  

<div class="flex">

  <div class="left">
    <form method="POST" action="insert.php">
      <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
        <legend>お気に入りを保存</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
          <input type="hidden" name="ID" value="<?=$_SESSION["ID"]?>" >
          <input type="hidden" name="pass" value="<?=$_SESSION["pass"]?>">
          <label>タイトル：<input type="text" name="title" required  class="text_size"></label><br>
          <label>　　URL：<input type="text" name="url" required class="text_size"></label><br>
          <label>
            <div class="flex_in">
              <p>　　メモ：<p>
              <textarea name="memo" class="text_size text_size_h"></textarea>
            </div>
          </label>
          <input type="submit" value="送信">
      </fieldset>
  </div>
  
  <div class="favo_size">
  </div>    
</div>

<!-- お気に入り表示 -->
<div class="open">

  <?=$view?>

</div>
<!-- [End] -->

<div class="logout_flex_in">
  <div class="logout_position">
    <div class="logout_size flex_in">
          <a href="logout.php">ログアウト</a>
    </div>
  </div>
</div>

</body>
</html>
