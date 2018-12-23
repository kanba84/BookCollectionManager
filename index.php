<?php
function getISBN(){
  if(isset($_GET["isbn"])){
    $isbn = array($_GET["1"],$_GET["2"],$_GET["3"],$_GET["4"],$_GET["5"]);
  } else {
    $isbn = array("","","","","");
  }
  return $isbn;
}
$isbn = getISBN();
 ?>
<!DOCTYPE html>
<html lang="ja">
 <head>
 <meta charset="utf-8">
 <title>書籍検索</title>
 <meta name="description" content="サイトキャプションを入力">
 <meta name="keywords" content="サイトキーワードを,で区切って入力">
 <link rel="stylesheet" href="index.css">
 <!--[if lt IE 9]>
 <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
 <![endif]-->
 <script src="sample.js"></script>
 </head>

 <body>
 <!----- ヘッダー ----->
 <header>
   <h1>書籍検索</h1>
   <h2>ISBNコードから書籍を検索</h2>
 </header>
 <!-- <nav>ナビ</nav> -->
 <!----- ヘッダー END ----->

 <!----- メインコンテンツ ----->
 <main>
   <form action="bookInfo.php" method="post">
     <input class="isbn" type="text" name="isbn0" value="<?php echo $isbn[0];?>">
     <input class="isbn" type="text" name="isbn1" value="<?php echo $isbn[1];?>">
     <input class="isbn" type="text" name="isbn2" value="<?php echo $isbn[2];?>">
     <input class="isbn" type="text" name="isbn3" value="<?php echo $isbn[3];?>">
     <input class="isbn" type="text" name="isbn4" value="<?php echo $isbn[4];?>"><br>
     <input class="submit" name="openbd" type="submit" value="OPEN BDで検索">
     <input class="submit" name="google" type="submit" value="GoogleAPIで検索">
   </form>
   <form action="index.php" method="get">
     <input class="button" type="submit" value = "入力をクリア">
   </form>
 </main>
 <!----- メインコンテンツ END ----->

 <!----- フッター ----->
 <footer>
   <a href="show.php">蔵書一覧</a><br>
   <a href="search.html">蔵書検索</a>
 </footer>
 <!----- フッター END ----->

 </body>
</html>
