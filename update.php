<?php
//1.取得
$No = $_POST["No"];
$title = $_POST["title"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError'.$e->getMessage());
}

//3.UPDATE
$sql = 'UPDATE kadai_07_table SET 書籍名=:title, 書籍url=:url, 書籍コメント=:memo WHERE No = :No';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url',   $url,   PDO::PARAM_STR);
$stmt->bindValue(':memo',  $memo,  PDO::PARAM_STR);
$stmt->bindValue(':No',    $No,    PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else {
  header("Location: select.php");
  exit;
}



?>