<?php
session_start();
include("funcs.php");

//POSTデータ
$kID = $_POST["kID"];
$kpass = $_POST["kpass"];

//DB接続
$pdo = db_connect();

//データ登録SQL
$spl = "SELECT * FROM kadai_07_user WHERE kID=:kID AND kpass=:kpass";
$stmt = $pdo->prepare($spl);
$stmt->bindValue(':kID',$kID);
$stmt->bindValue(':kpass',$kpass);
$res = $stmt->execute();

//SQL実行時エラー
QueryError($res,$stmt);

//抽出データ数を取得
$val = $stmt->fetch();

//該当レコードがあればSESSIONに値を代入
if($val["kID"] != ""){
  $_SESSION["m_chk_ssid"] = session_id();
  $_SESSION["kID"]= $val["kID"];
  $_SESSION["kpass"]= $val["kpass"];
  $_SESSION["life_flg"]= $val["life_flg"];
  $_SESSION["name"] = $val["name"];
  $_SESSION["kanri_flg"] = $val["kanri_flg"];
  header("Location: manager.php");
}else{
  header("Location: login.php");
}
exit();
?>