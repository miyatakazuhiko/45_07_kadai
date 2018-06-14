<?php
session_start();
include("funcs.php");

$id = $_GET["id"];

$pdo = db_connect();

m_loginCheck();

$stmt = $pdo->prepare('SELECT ID, pass FROM kadai_07_table WHERE ID=:id');
$stmt->bindValue(':id', $id, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);
} else {
  $row = $stmt->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>manager_index_update</title>
</head>
<body>
<form method="POST" action="manager_index_update.php" style="width:400px">
  <fieldset>
      <legend>ユーザーpass：編集</legend>
      <input type="hidden" name="ID" value="<?=$row['ID']?>">
      <label>pass：<input type="text" name="pass" value="<?=$row['pass']?>" required></label><br>
      <input type="submit" value="送信">
  </fieldset>
  <a href="manager_index.php">前のページへ戻る</a>
</body>
</html>