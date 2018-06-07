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

<header>
  <h1>Bookmark</h1>
</header>  

<div class="flex">

  <div class="left">
    <form method="POST" action="insert.php">
      <fieldset><!-- フォームの入力項目をグループ化する際に使用 -->
        <legend>ユーザー登録</legend><!-- <FIELDSET>タグでグループ化されたフォームの入力項目にタイトルを付けるタグ -->
          <label>　ID：<input type="text" name="ID" required  class="text_size"></label><br>
          <label>pass：<input type="text" name="pass" required class="text_size"></label><br>
          <input type="submit" value="送信">
      </fieldset>
  </div>
  
  <div class="favo_size">
    <div class="favo_size_in">
      <a href="login.php" class="favo">ログイン画面へ</a>
    </div>
  </div>    
</div>

</body>
</html>