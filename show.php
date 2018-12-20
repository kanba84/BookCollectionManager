<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <title>書籍一覧</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<a href="index.php">ISBN入力へ</a><br>
<?php
#require_once('connectSQL.php');
require_once('connectSQL.php');
$columns = array('isbn','title','volume','series','author','publisher','pubdate','cover');
function makeForm($isbn,$title){
  $tag0 = "<form name='f{$isbn}' action='lending.php' method='post'>";
  $tag1 = "<input type='hidden' name='isbn' value='{$isbn}'>";
  $tag2 = "<input type='hidden' name='title' value='{$title}'>";
  $tag3 = "<a href='lending.php' onClick='document.f{$isbn}.submit();return false;'>{$title}</a></form>";
  return $tag0.$tag1.$tag2.$tag3;
}
try {
  $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
  #$sql->query($query);
  #echo "<table>";
  echo "<table><tr>";
  for($i=0;$i<8;$i++){
    echo "<td class='label'>".$columns[$i]."</td>";
  }
  echo "</tr>";
  foreach ($sql->query("select * from {$sqlConfig->getTablename()}") as $row) {
    echo "<tr>";
    for($i=0;$i<8;$i++){
      if($i==1){
        echo "<td>".makeForm($row[$columns[0]],$row[$columns[1]])."</td>";
      } else{
        echo "<td>".$row[$columns[$i]]."</td>";
      }
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
