<?php
session_start();
include("funcs.php");

$pdo = db_connect();

m_loginCheck();

s_kanri();

$stmt = $pdo->prepare('SELECT * FROM kadai_07_user');
$status = $stmt->execute();

$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);

}else{
  //テーブル
  $view .= '<table width="776px" border="1">';
  $view .= '<tr>';
  $view .= '<th style="width:50px">No</th>';
  $view .= '<th style="width:220px">name</th>';
  $view .= '<th style="width:220px">kID</th> ';
  $view .= '<th style="width:220px">kpass</th> ';
  $view .= '<th style="width:160px">管理マスター<br>フラグ</th>';
  $view .= '<th style="width:140px">管理フラグ</th>';
  $view .= '</tr>';

  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= "<td>";
    $view .= '<a href="manager_u_list.php?id='.$result["No"].'">';
    $view .= $result["No"];
    $view .= '</a>';
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["name"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["kID"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["kpass"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["kanri_flg"]);
    $view .= "</td>";
    $view .= "<td>";
    $view .= h($result["life_flg"]);
    $view .= "</td>";
    $view .= '</tr>';
  }
  $view .= '</table>';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>管理者追加</title>
</head>
<body>

<header>
  <h1>管理者追加画面</h1>
</header>

<form method="POST" action="manager_add_insert.php">
  <h2>管理者追加</h2>
  <label>name:<input type="text" name="name"  required></label>
  <br>
  <label>　ID：<input type="text" name="kID"  required></label>
  <br>
  <label>Pass：<input type"text" name="kpass" required></label>
  <br>
  <input type="submit" value="登録" style="margin-left:190px;">
</form>


<div style="margin-top:20px;">
  <a href="manager.php" style="display:block width:300px">管理者画面へ戻る</a>
</div>
  <h2 style=margin-top:20px>管理者一覧</h2>
  <p><span style="color:red">No</span>クリックで管理者情報編集</p>

<div>
  <?=$view?>
</div>
</body>
</html>