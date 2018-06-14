<?php
session_start();
include("funcs.php");

if(
  !isset($_POST["name"]) || $_POST["name"]=="" || !isset($_POST["kID"]) || $_POST["kID"]=="" || !isset($_POST["kpass"]) || $_POST["kpass"]==""
){
  exit("入力漏れがあるっ");
}

$name = $_POST["name"];
$kID = $_POST["kID"];
$kpass = $_POST["kpass"];

$pdo = db_connect();

$sql = "INSERT INTO kadai_07_user(No, name, kID, kpass)
VALUES(NULL, :name, :kID, :kpass)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':kID', $kID, PDO::PARAM_STR);
$stmt->bindValue(':kpass', $kpass, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  header("Location: manager_add.php");
  exit;
}

?>