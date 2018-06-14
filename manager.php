<?php
session_start();
include("funcs.php");

m_loginCheck();

$pdo = db_connect();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>manager</title>
</head>
<body>

<h1>管理者画面</h1>

<p><?php echo $_SESSION["name"]; ?>さんこんにちは。やきにくたべたい。</p>

<a href="manager_list.php">管理者一覧</a><br><br>

<?php if($_SESSION["kanri_flg"]==1){?>
<a href="manager_add.php">管理者追加・変更</a><br><br>
<?php }?>

<a href="manager_index.php">Bookmark登録者情報一覧</a><br><br>

<a href="manager_view.php">Bookmark一覧/編集・削除</a><br><br>

<a href="logout.php">ログアウト/ログイン画面へ戻る</a><br><br>
</body>
</html>