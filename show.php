<!DOCTYPE html>
<html lang="ja">
  <head>
  <meta charset="utf-8">
  <title>書籍一覧</title>
  <meta name="description" content="サイトキャプションを入力">
  <meta name="keywords" content="サイトキーワードを,で区切って入力">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<a href="index.html">書籍管理ホーム</a>
<a href="isbnSearch.php">ISBNから書籍を追加</a><br>
<?php
#require_once('connectSQL.php');
require_once('connectSQL.php');
require_once('makeForm.php');
$columns = array('title','author','publisher','pubdate','status','name');
try {
  $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
  $booktable=$sqlConfig->getTablename();
  echo "<table><tr>";
  for($i=0;$i<count($columns);$i++){
    echo "<td class='label'>".$columns[$i]."</td>";
  }
  $query="select * from {$booktable} join users on {$booktable}.borrowerid=users.userid";
  echo "</tr>";
  #foreach ($sql->query("select * from {$sqlConfig->getTablename()}") as $row) {
  foreach ($sql->query($query) as $row) {
    echo "<tr>";
    for($i=0;$i<count($columns);$i++){
      if($i==0){
        #echo "<td>".makeForm($row[$columns[0]],$row[$columns[0]])."</td>";
        echo "<td>".makeForm($row)."</td>";
      } elseif($columns[$i]=='status'){
        if($row['status']==1){
          echo "<td>貸出中</td>";
        } else{
          echo "<td>書架</td>";
        }
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
