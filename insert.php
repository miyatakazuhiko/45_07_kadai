<?php
//受け取りチェック
if (
  !isset($_POST["title"]) || $_POST["title"]=="" ||
  !isset($_POST["url"]) || $_POST["url"]=="" 
){
  exit("入力漏れがあるよ");
}

//POSTデータ
$title = $_POST["title"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//DB接続
try {
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOEexception $e) {
  exit ('DbConnectError:'.$e->getMessage());
}

//3.データ登録SQL作成
$sql = "INSERT INTO kadai_07_table(No , 書籍名 ,書籍URL ,書籍コメント ,登録日時)
VALUES(NULL, :title, :url, :memo ,sysdate())";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':memo', $memo, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  header("Location: index.php");
  exit;
}



?>