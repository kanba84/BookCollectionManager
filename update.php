<?php
require_once('connectSQL.php');
if(!empty($_POST)){
  try {
    $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
    if(isset($_POST['return'])){
      $query="update {$sqlConfig->getTablename()} set status=0,borrowerid=-1 where isbn={$_POST['isbn']}";
      $sql->query($query);
      echo "<div class=message>返却しました。</div>";
    } elseif(isset($_POST['lend'])){
      $query="update {$sqlConfig->getTablename()} set status=1,borrowerid={$_POST['userid']} where isbn={$_POST['isbn']}";
      $sql->query($query);
      echo "<div class=message>貸し出し登録が完了しました。</div>";
    } else{
      echo "Oops! There is something wrong :<";
    }

  }catch ( PDOException $e ) {
      print "ERROR:{$e->getMessage()}";
  }
}
 ?>
 <a href='show.php'>蔵書一覧</a><br><a href='search.html'>蔵書検索</a>
