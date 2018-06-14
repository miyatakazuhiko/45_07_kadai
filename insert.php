<?php
include("funcs.php");

//受け取りチェック
if (
  !isset($_POST["title"]) || $_POST["title"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" 
){
  exit("入力漏れがあるよ");
}

//POSTデータ
$ID = $_POST["ID"];
$pass = $_POST["pass"];
$title = $_POST["title"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//DB接続
$pdo = db_connect();

//3.データ登録SQL作成
$sql = "INSERT INTO kadai_07_table(No ,ID ,pass, 書籍名 ,書籍URL ,書籍コメント ,登録日時)
VALUES(NULL, :ID, :pass, :title, :url, :memo ,sysdate())";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':ID', $ID, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  header("Location: select.php");
  exit;
}

?>