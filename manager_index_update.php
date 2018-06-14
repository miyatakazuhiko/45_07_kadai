<?php
include("funcs.php");

$ID = $_POST["ID"];
$pass = $_POST["pass"];

$pdo = db_connect();

$sql = 'UPDATE kadai_07_table SET  pass=:pass WHERE ID=:ID';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':ID'  ,$ID    ,PDO::PARAM_STR);
$stmt->bindValue(':pass',$pass  ,PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  header("Location: manager_index.php");
  exit;
}
?>