<?php
session_start();
include("funcs.php");

m_loginCheck();

$pdo = db_connect();

$stmt = $pdo->prepare('SELECT * FROM kadai_07_table WHERE 書籍名 IS NOT NULL AND 書籍名 !="" AND 書籍URL IS NOT NULL AND 書籍URL !="" ');
$status = $stmt->execute();

$view="";
if($status==false) {
  $error = $stmt->errorInfo();
  exit("sqlError".$error[2]);

}else{
   //テーブル。
   $view .= '<table width="776px" border="1"  style="word-break: break-all; word-wrap: break-all">';
   $view .= '<tr>';
   $view .= '<th style="width:50px">No</th>';
   $view .= '<th style="width:80px">ID</th>';
   $view .= '<th style="width:150px">書籍名</th>';
   $view .= '<th style="width:220px">書籍URL</th> ';
   $view .= '<th style="width:150px">書籍コメント</th>';
   $view .= '<th style="width:100px">登録日時</th>';
   $view .= '<th style="width:50px">削除</th>';
   $view .= '</tr>';
 
   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
     $view .= '<tr>';
     $view .= "<td>";
     $view .= '<a href="manager_u_view.php?id='.$result["No"].'">';
     $view .= $result["No"];
     $view .= '</a>';
     $view .= "</td>";
     $view .= "<td>";
     $view .= h($result["ID"]);
     $view .= "</td>";
     $view .= "<td>";
     $view .= h($result["書籍名"]);
     $view .= "</td>";
     $view .= "<td>";
     $view .= h($result["書籍URL"]);
     $view .= "</td>";
     $view .= "<td>";
     $view .= h($result["書籍コメント"]);
     $view .= "</td>";
     $view .= "<td>";
     $view .= h($result["登録日時"]);
     $view .= "</td>";
     $view .= "<td>";
     $view .= '<a href="manager_delete.php?id='.$result["No"].'">';
     $view .= '削除';
     $view .= '</a>';
     $view .= "</p>";
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
  <title>ブックマーク一覧</title>
</head>
<body>

<h1>ブックマーク一覧</h1>

<div>
  <a href="manager.php" style="display:block width:300px">管理者画面へ戻る</a>
</div>

<div>
  <?=$view?>
</div>

</body>
</html>