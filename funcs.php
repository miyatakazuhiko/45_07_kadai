<?php
//XSS対応関数
function h($value){
  return htmlspecialchars($value,ENT_QUOTES);
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

//managerLOGIN認証チェック関数
function m_loginCheck(){
  if( !isset($_SESSION["m_chk_ssid"]) || $_SESSION["m_chk_ssid"] !=session_id()){
    echo "LOGIN Error!";
    exit();
  } else {
    session_regenerate_id(true);
    $_SESSION["m_chk_ssid"] = session_id();
  }
}

//SQL実行時にエラー
function QueryError($res,$stmt){
  if($res == false) {
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
  }
}

//index~.phpに入るためのなんか
function logoutCheck(){
    if(isset($_SESSION["chk_ssid"])){
    echo "<script type='text/javascript'>";
    echo 'alert("ログアウトしてから入ってね");';
    echo 'window.location.href="select.php"';
    echo "</script>";
    exit;
  }else{
    if(isset($_SESSION["m_chk_ssid"])){
      echo "<script type='text/javascript'>";
      echo "alert('ログアウトしてから入ってね');";
      echo "window.location.href='manager.php'";
      echo "</script>";
      exit;
    }
  }
}

//強い管理者以外はじきたい
function s_kanri(){
    if($_SESSION["kanri_flg"]!=1){
    echo '<script type="text/javascript">';
    echo "alert('凄い管理者専用ページです。');";
    echo "window.location.href='manager.php'";
    echo '</script>';
    exit;
  }
}

?>