<?php
//1.GETでid取得
$id = $_GET["id"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続出来ませんでした。'.$e->getMessage());
}

//3.UPDATE
$sql = 'DELETE FROM kadai_07_table WHERE No=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error = $stmt->errrorInfo();
  exit("QueryError:".$error[2]);

} else {

  header("Location: select.php");
  exit;
}