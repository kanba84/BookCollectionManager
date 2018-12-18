<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <title>検索結果</title>
  <link rel="stylesheet" href="stylesheet.css">
</head>
<div class="navi">
  <a href="index.php">ISBN入力へ</a>
  <a href="search.html">蔵書検索へ</a>
<?php
require_once('connectSQL.php');
$columns = array('isbn','title','volume','series','author','publisher','pubdate','cover');
try {
  $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
  $keyword=$_POST['keyword'];
  if(isset($_POST['qTitle'])){
    $result=$sql->query("select * from {$sqlConfig->getTablename()} where title like '%{$keyword}%'");
    echo "<h3>[タイトル] {$keyword} の検索結果</h3>";
  } elseif(isset($_POST['qAuthor'])) {
    echo "<h3>[著者] {$keyword} の検索結果</h3>";
    $result=$sql->query("select * from {$sqlConfig->getTablename()} where author like '%{$keyword}%'");
  }
  echo "<table><tr>";
  for($i=0;$i<8;$i++){
    echo "<td class='label'>".$columns[$i]."</td>";
  }
  echo "</tr>";
  #$keyword=$_POST['keyword'];
  foreach ($result as $row) {
    echo "<tr>";
    for($i=0;$i<8;$i++){
      echo "<td>".$row[$columns[$i]]."</td>";
    }
    echo "</tr>";
  }
  echo "</table>";
  $sql = null;
} catch ( PDOException $e ) {
    print "ERROR:{$e->getMessage()}";
}
?>
</html>
