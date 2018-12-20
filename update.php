<?php
require_once('connectSQL.php');
if(!empty($_POST)){
  try {
    $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
    $query="update {$sqlConfig->getTablename()} set status=1,borrowerid={$_POST['userid']} where isbn={$_POST['isbn']}";
    $sql->query($query);
    echo "<div class=message>貸し出し登録が完了しました。</div>";
  }catch ( PDOException $e ) {
      print "ERROR:{$e->getMessage()}";
  }
}
 ?>
