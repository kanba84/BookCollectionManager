<?php
require_once('connectSQL.php');
if(!empty($_POST)){
  echo "<h3>{$_POST['isbn']}:{$_POST['title']}</h3>";
  echo "<form action=update.php method='post'><input name='isbn' type='hidden' value={$_POST['isbn']}>";
  try {
    $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
    $users = $sql->query("select userid,name from users");
    echo "<select name='userid'>";
    foreach($users as $user){
      echo "<option value='{$user[0]}'>{$user[1]}</option>";
    }
    echo "</select>";
    echo "<input type='submit' value='貸出'></form>";
  }catch ( PDOException $e ) {
      print "ERROR:{$e->getMessage()}";
  }
} else{
  echo "<h3>Empty!</h3>";
}
 ?>
