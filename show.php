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
require_once('makeForm.php');
$columns = array('title','author','publisher','pubdate','status','name');
try {
  $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
  #$sql->query($query);
  #echo "<table>";
  echo "<table><tr>";
  for($i=0;$i<count($columns);$i++){
    echo "<td class='label'>".$columns[$i]."</td>";
  }
  $query="select * from mybooks join users on mybooks.borrowerid=users.userid";
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
