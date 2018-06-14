<?php
include("funcs.php");

if (
  !isset($_POST["ID"]) || $_POST["ID"]=="" ||
  !isset($_POST["pass"]) || $_POST["pass"]=="" 
){
  exit("入力漏れがあります");
}

$ID = $_POST["ID"];
$pass = $_POST["pass"];

$pdo = db_connect();
  
$sql = "INSERT INTO kadai_07_table(ID, pass) VALUES(:ID,:pass)";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':ID', $ID, PDO::PARAM_STR);
$stmt->bindValue(':pass', $pass, PDO::PARAM_STR);
$status = $stmt->execute();

if($status==false){
  $error = $stmt->errorInfo();
  exit("sqlError:".$error[2]);
}else{
  echo '<script type="text/javascript">' ;
  echo "alert('ID:　{$ID}　　pass:　{$pass}');" ;
  echo "window.location.href='login.php'";
  echo '</script>' ;
    // header("Location: login.php");
  exit;
}

?>