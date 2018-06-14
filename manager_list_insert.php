<?php

include("funcs.php");

//1.取得
$No = $_POST["No"];
$name = $_POST["name"];
$kID = $_POST["kID"];
$kpass = $_POST["kpass"];
$kanri_flg = $_POST["kanri_flg"];
$life_flg = $_POST["life_flg"];

//2.DB接続
$pdo = db_connect();

//3.UPDATE
$sql = 'UPDATE kadai_07_user SET No=:No, name=:name, kID=:kID, kpass=:kpass, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE No=:No';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':No',        $No,        PDO::PARAM_INT);
$stmt->bindValue(':name',      $name,      PDO::PARAM_STR);
$stmt->bindValue(':kID',       $kID,       PDO::PARAM_STR);
$stmt->bindValue(':kpass',     $kpass,     PDO::PARAM_STR);
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);
$stmt->bindValue(':life_flg',  $life_flg,  PDO::PARAM_INT);

$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else {
  header("Location: manager_list.php");
  exit;
}

?>