<?php
session_start();
include("funcs.php");

$ID = $_POST["ID"];
$pass = $_POST["pass"];

//1.接続
$pdo = db_connect();

//2.データ登録SQL作成
$sql = "SELECT * FROM kadai_07_table WHERE ID=:ID AND pass=:pass";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ID', $ID);
$stmt->bindValue(':pass', $pass);
$res = $stmt->execute();

//SQL実行時にエラー
QueryError($res,$stmt);

//3.抽出データ数を取得
$val = $stmt->fetch();//1レコードだけ取得する

//4.該当レコードがあればSESSIONに値を代入
if( $val["ID"] != "" ){
  $_SESSION["chk_ssid"] = session_id();//ユニークキーを取得する
  $_SESSION["ID"] = $val["ID"];
  $_SESSION["pass"] = $val["pass"];
  $_SESSION["No"]  = $val['No'];
  $_SESSION["書籍名"]  = $val['書籍名'];
  $_SESSIOM["書籍URL"] = $val['書籍URL'];
  $_SESSION["書籍コメント"] = $val['書籍コメント'];
  $_SESSION["登録日時"] = $val["登録日時"];
  // var_dump($val);
  header("Location: select.php");
}else{
  header("Location: login.php");
}
exit();
?>