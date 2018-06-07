<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/login_style.css">
  <title>本をブックマーク</title>
</head>
<body>

<header>
  <h1>Bookmark</h1>
</header>  

  <div class="flex">  
    <div class="favo_size">
      <div class="ippan_size_in">
        <a href="index.php">一般の方はこちら</a>
      </div>
    </div>    

  <div class="login_size">
    <form class="login_size_in flex_in" method="post" action="login_act.php">
      <div>
        <label><input type="text" name="lid" placeholder="ID" required class="login_text"></label>
        <label><input type="text" name="lpw" placeholder="password" required class="login_text"></label>
        <!-- <label>PW:<input type="text" name="lpw"></label> PW:とinputをひとまとめにするには？divでは無理-->
      </div>
      <div>
        <label><input class="login_btn" type="submit" value="ログイン" ></label>
      </div>  
      </form>
    </div> 
  </div>

</body>
</html>


  
