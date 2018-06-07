<?php
//XSS対応関数
function h($value){
  return htmlspecialchars($value,ENT_QUOTES);
}

//LOGIN認証チェック関数
function loginCheck(){
  if( !isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] !=session_id()){
    echo "LOGIN Error!";
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["chk_ssid"] = session_id();
  }
}

//DB接続
function db_connect(){
  try {
    $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
  } catch (PDOException $e) {
    exit('dbError'.$e->getMessage());
  }
  return $pdo;//関数の外に出す。
}

?>