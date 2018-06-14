<?php
session_start();
include("funcs.php");

m_loginCheck();

s_kanri();

$id = $_GET["id"];

$pdo = db_connect();

$sql = "SELECT * FROM kadai_07_user WHERE No=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
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
  <title>管理者編集画面</title>
</head>
<body>
  
<header>
  <h1>管理者編集画面</h>
</header>

<form method="POST" action="manager_list_insert.php">
  <fieldset>
    <legend>管理者追加</legend>
    <input type="hidden" name="No" value="<?=$row["No"]?>">
    <label>name:<input type="text" name="name" style="60px" value="<?=$row["name"]?>" required></label>
    <br>
    <label>　ID：<input type="text" name="kID" style="30px" value="<?=$row["kID"]?>" required></label>
    <br>
    <label>Pass：<input type"text" name="kpass" style="30px"  value="<?=$row["kpass"]?>" required></label>
    <br>
    <label>管理マスターフラグ：<input type"text" name="kanri_flg" style="5px"  value="<?=$row["kanri_flg"]?>" required></label>
    <br>
    <label>管理フラグ：<input type"text" name="life_flg" style="5px"  value="<?=$row["life_flg"]?>" required></label>
    <br>
    <label><input type="submit" value="登録"></lable>
</form>


<div>
  <a href="manager.php" style="display:block width:300px">管理者画面へ戻る</a>
</div>
<div>
  <a href="manager_list.php" style="display:block width:300px">管理者一覧へ戻る</a>
</div>
</body>
</html>