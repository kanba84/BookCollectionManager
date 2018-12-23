<link rel="stylesheet" href="css/info.css">
<?php
require_once('connectSQL.php');
require_once('separateISBN.php');
$rows=array('isbn'=>'ISBN','author'=>'著者','series'=>'シリーズ','volume'=>'巻号','pubdate'=>'出版年','location'=>'保管場所','name'=>'借りている人');
$STATUS='';
if(!empty($_POST)){
  if($_POST['status']==1){
    $STATUS='[貸出中]';
  }
  echo "<h3>{$_POST['title']}<span>{$STATUS}</span></h3>";
  if(isset($_POST['cover'])){
    echo "<img src='{$_POST['cover']}'>";
  }
  $isbn=separateISBN($_POST['isbn']);
  $isbn=$isbn[0].'-'.$isbn[1].'-'.$isbn[2].'-'.$isbn[3].'-'.$isbn[4];
  echo "<table>";
  foreach($rows as $key=>$value){
    if($key=='isbn'){
      echo "<tr><td>{$value}</td><td>{$isbn}</td></tr>";
    } else{
      echo "<tr><td>{$value}</td><td>{$_POST[$key]}</td></tr>";
    }
  }
  echo "</table>";
  echo "<form action='update.php' method='post'><input name='isbn' type='hidden' value={$_POST['isbn']}>";
  if($_POST['status']==0){
    try {
      $sql = new PDO ( "mysql:dbname={$sqlConfig->getDbname()}; host={$sqlConfig->getHost()};port=3306; charset=utf8", $sqlConfig->getUser(), $sqlConfig->getPassword() );
      $users = $sql->query("select userid,name from users");
      echo "<select name='userid'>";
      foreach($users as $user){
        echo "<option value='{$user[0]}'>{$user[1]}</option>";
      }
      echo "</select>";
      echo "<input name='lend' type='submit' value='貸出'></form>";
    }catch ( PDOException $e ) {
        print "ERROR:{$e->getMessage()}";
    }
  } else{
    echo "<input name='return' type='submit' value='返却'></form>";
  }
} else{
  echo "<h3>Empty!</h3>";
}
 ?>
 <footer>
   <ul>
     <li><a href='index.html'>書籍管理ホーム</a></li>
     <li><a href='show.php'>蔵書一覧</a></li>
     <li><a href='search.html'>蔵書検索</a></li>
   </ul>
 </footer>
