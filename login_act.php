<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
<?php
session_start();//ページ跨いでデータを使える。
$lid= $_POST["lid"];
$lpw = $_POST["lpw"];

//1.接続
try{
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('DbConnectError:'.$e->getMessage());
}

//2.データ登録SQL作成
$sql = "SELECT * FROM kadai_07_table WHERE No=:lid AND pass=:lpw";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':lid', $lid);
$stmt->bindValue(':lpw', $lpw);
$res = $stmt->execute();

//SQL実行時にエラー
if($res == false) {
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}

//3.抽出データ数を取得
$val = $stmt->fetch();//1レコードだけ取得する

//4.該当レコードがあればSESSIONに値を代入
if( $val["No"] != "" ){
  $_SESSION["chk_ssid"]   = session_id();//ユニークキーを取得する
  $_SESSION["No"]       = $val['No'];
  // $_SESSION["id"]  = $val['id'];
  header("Location: select.php");
}else{
  header("Location: login.php");
}
exit();
?>
</body>
</html>