<?php
session_start();
include("funcs.php");

m_loginCheck();

$id = $_GET["id"];

$pdo = db_connect();

$sql = "SELECT * FROM kadai_07_table WHERE No=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

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
  <title>ブックマーク編集</title>
</head>
<body>

<h1>ブックマーク編集</h1>

<form method="POST" action="manager_view_update.php">
  <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
    <legend>お気に入りを保存</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
      <label>タイトル：<input type="text" name="title" value="<?=$row["書籍名"]?>" required></label><br>
      <label>　　URL：<input type="text" name="url" value="<?=$row["書籍URL"]?>" required></label><br>
      <label>
        <div>
          <p style="display:inline-block">　　メモ：</p>
          <textarea name="memo" style="width:300px; height:80px"><?=$row["書籍コメント"]?></textarea>
        </div>
      </label>
      <input type="hidden" name="No" value="<?=$row["No"]?>">
      <input type="submit" value="送信">
  </fieldset>
</form> 

<div>
  <a href="manager_view.php" style="display:block width:300px">ブックマーク一覧へ戻る</a><br>
  <a href="manager.php" style="display:block width:300px">管理者画面へ戻る</a>
</div>
</body>
</html>