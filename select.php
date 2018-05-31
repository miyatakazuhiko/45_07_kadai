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

<?php

include("funcs.php");

//1.  DB接続
try {
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM kadai_07_table');
$status = $stmt->execute();

//３．データ表示
$view="";//データ表示のための変数
if($status==false) {
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);

}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .= "<p>";
    $view .= $result["No"]."：";
    $view .= '<a href="u_view.php?id='.$result["No"].'">';
    $view .= h($result["書籍名"]);
    $view .= '</a>';
    $view .= "：".h($result["書籍URL"])."　■メモ【 ".h($result["書籍コメント"]);
    $view .= " 】 ☆".h($result["登録日時"]);
    $view .= '　';
    $view .= '<a href="delete.php?id='.$result["No"].'">';
    $view .= '[削除]';
    $view .= '</a>';
    $view .= "</p>";
    //.= がないと前のデータに上書きになる。
  }
}
?>

<?php
  include("index.php");
?>

<!-- Main[Start] -->
<div>
    <div class="open"><?=$view?></div>
</div>
<!-- ここの$viewでページ上で表示する。  -->
<!-- Main[End] -->

</body>
</html>
