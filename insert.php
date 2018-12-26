<link rel="stylesheet" href="stylesheet.css">
<?php
require_once('connectSQL.php');
try {
  $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
  $query="insert into {$sqlConfig->getTablename()} (isbn,title,volume,series,author,publisher,pubdate,cover) values ('{$_POST['isbn']}','{$_POST['title']}','{$_POST['volume']}','{$_POST['series']}','{$_POST['author']}','{$_POST['publisher']}','{$_POST['pubdate']}','{$_POST['cover']}')";
  #$sql->query()
  #echo $query;
  $sql->query($query);
  echo "<div class=message>登録が完了しました。</div>";
  $sql = null;
} catch ( PDOException $e ) {
    print "ERROR:{$e->getMessage()}";
}
?>
<br><a href="show.php">SHOW TABLE</a>
<br><a href="isbnSearch.php">ISBNから書籍を追加</a>
