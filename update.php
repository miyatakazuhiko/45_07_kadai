<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/style.css">
  <title>本をブックマーク</title>
</head>
<body>

<?php
//1.取得
$No = $_POST["No"];
$title = $_POST["title"];
$url = $_POST["url"];
$memo = $_POST["memo"];

//2.DB接続
try {
  $pdo = new PDO('mysql:dbname=kadai_07;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('dbError'.$e->getMessage());
}

//3.UPDATE
$sql = 'UPDATE kadai_07_table SET 書籍名=:title, 書籍url=:url, 書籍コメント=:memo WHERE No = :No';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url',   $url,   PDO::PARAM_STR);
$stmt->bindValue(':memo',  $memo,  PDO::PARAM_STR);
$stmt->bindValue(':No',    $No,    PDO::PARAM_INT);
$status = $stmt->execute();

//4.データ登録処理後
if($status==false){
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
} else {
  header("Location: select.php");
  exit;
}

?>

<header>
  <h1>Bookmark</h1>
</header>  

<div class="flex">

  <div class="left">
    <form method="POST" action="insert.php">
      <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
        <legend>お気に入りを保存</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
          <label>タイトル：<input type="text" name="title" required  class="text_size"></label><br>
          <label>　　URL：<input type="text" name="url" required class="text_size"></label><br>
          <label>
            <div class="flex_in">
              <p>　　メモ：<p>
              <textarea name="memo" class="text_size text_size_h"></textarea>
            </div>
          </label>
          <input type="submit" value="送信">
      </fieldset>
  </div>
  
  <div class="favo_size">
    <div class="favo_size_in">
      <a href="view.php" class="favo">お気に入り表示</a>
    </div>
  </div>    
</div>

</body>
</html>