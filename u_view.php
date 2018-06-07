<?php
//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
try{
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続出来ませんでした。'.$e->getMessage());
}


//3.SELECT
$sql = "SELECT * FROM kadai_07_table WHERE No=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ表示
$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
} else {
  $row = $stmt->fetch();
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
    <form method="POST" action="update.php">
      <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
        <legend>お気に入りを保存</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
          <label>タイトル：<input type="text" name="title" value="<?=$row["書籍名"]?>" required  class="text_size"></label><br>
          <label>　　URL：<input type="text" name="url" value="<?=$row["書籍URL"]?>" required class="text_size"></label><br>
          <label>
            <div class="flex_in">
              <p>　　メモ：<p>
              <textarea name="memo" class="text_size text_size_h"><?=$row["書籍コメント"]?></textarea>
            </div>
          </label>
          <input type="hidden" name="No" value="<?=$row["No"]?>">
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