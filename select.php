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
    <div class="favo_size_in">
      <a href="view.php" class="favo">お気に入り表示</a>
    </div>
  </div>    
</div>

<div class="logout_flex_in">
  <div class="logout_position">
    <div class="logout_size flex_in">
          <a href="logout.php">ログアウト</a>
    </div>
  </div>
</div>

</body>
</html>
