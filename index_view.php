<?php
session_start();
include("funcs.php");

logoutCheck();

$pdo = db_connect();

$stmt = $pdo->prepare('SELECT * FROM `kadai_07_table` WHERE `書籍名` IS NOT NULL AND `書籍名`!="" ');
$status = $stmt->execute();

$view="";

if($status==false){
  $error = $stmt-errorInfo();
  exit("sqlError".$error[2]);
}else{
  $view .= '<table width="776px" border="1">';
  $view .= '<tr>';
  $view .=  '<th style="width:200px">書籍名</th>';
  $view .=  '<th style="width:376px">書籍URL</th> ';
  $view .=  '<th style="width:200px">書籍コメント</th>';
  $view .= '</tr>';

  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= '<tr>';
    $view .= "<td style=width:220px>";
    $view .= h($result["書籍名"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["書籍URL"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["書籍コメント"]);
    $view .= "</td>";
    $view .= '</tr>';
  }

  $view .= '</table>';
}
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
    <form method="POST" action="index_insert.php">
      <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
        <legend>ユーザー登録</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
          <label>　ID：<input type="text" name="ID" required  class="text_size"></label><br>
          <label>pass：<input type="text" name="pass" required class="text_size"></label><br>
          <input type="submit" value="送信">
      </fieldset>
  </div>
  
  <div class="favo_size">
    <div class="favo_size_in">
      <a href="login.php" class="favo">ログイン画面へ</a>
    </div>
  </div>    
</div>

<div style="width:800px"><?=$view?></div>
</body>
</html>