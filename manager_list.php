<?php
session_start();
include("funcs.php");

m_loginCheck();

//1.  DB接続
$pdo = db_connect();

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
  $view .= '<th style="width:3px">No</th>';
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
  <title>管理者一覧</title>
</head>
<body>
<header>
  <h1>管理者一覧</h1>
</header>
  <p><span style="color:red">No</span>クリックで管理者情報編集</p>
<div>
  <a href="manager.php" style="display:block width:300px">管理者画面へ戻る</a>
</div>


<!-- テーブル表示  -->
  <?=$view?>

</body>
</html>