<?php
session_start();
include("funcs.php");

$pdo = db_connect();

m_loginCheck();

$stmt = $pdo->prepare('SELECT ID, pass FROM kadai_07_table GROUP BY ID' );
//GROUP BY ''で重複データを1つだけ表示
$status = $stmt->execute();

$view="";
if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);
}else{

  $view .= '<table width="400px" border="1">';
  $view .= '<tr>';
  $view .= '<th>ID</th>';
  $view .= '<th>pass</th>';
  $view .= '</tr>';

  while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';
    $view .= '<td>';
    $view .= '<a href="manager_index_view.php?id='.h$result["ID"].'">';
    $view .= h$result['ID'];
    $view .= '</a>';
    $view .= '</td>';
    $view .= '<td>';
    $view .= h$result['pass'];
    $view .= '</td>';
    $view .= '</tr>';
  }
  $view .= '</table>';
}

$val = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>manager_index</title>
</head>
<body>
  <h1>Bookmark登録者情報/編集画面</h1>  

  <p>IDクリックでID/pass編集</p>
  <a href="manager.php">TOPページへ戻る。</a>
<div>
  <?=$view?>
</div> 

</body>
</html>