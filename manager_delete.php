<?php
include("funcs.php");

$id = $_GET["id"];

$pdo = db_connect();

$sql = 'DELETE FROM kadai_07_table WHERE No=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errrorInfo();
  exit("QueryError:".$error[2]);

} else {

  header("Location: manager_view.php");
  exit;
}