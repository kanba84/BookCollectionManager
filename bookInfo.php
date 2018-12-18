<?php
$columns = array('isbn','title','volume','series','author','publisher','pubdate','cover');
$isbn = array($_POST['isbn0'],$_POST['isbn1'],$_POST['isbn2'],$_POST['isbn3'],$_POST['isbn4']);

function getValue($arr,$key){
  if($key=='title'){
    return $arr['title'];
  }
  elseif($key=='pubdate'){
    return $arr['publishedDate'];
  }
  elseif($key=='author'){
    $authors='';
    foreach($arr['authors'] as $author){
      $authors = $authors.$author.' ';
    }
    return $authors;
  }
  else{
    return '';
  }
}

#echo $isbn[0].$isbn[1].$isbn[2].$isbn[3];
echo "<form action='insert.php' method='post'>";
if(isset($_POST['openbd'])){
  #echo "True<br>";
  $url='https://api.openbd.jp/v1/get?isbn='.$isbn[0].'-'.$isbn[1].'-'.$isbn[2].'-'.$isbn[3].'-'.$isbn[4].'&pretty';
  $json = file_get_contents($url);
  $json = json_decode($json,true);
  #$json = json_decode($json);
  echo "<table>";
  if(is_null($json[0])){
    foreach($columns as $key){
      echo "<tr><td>{$key}</td><td><input type='text' name='{$key}' value=''></td></tr>";
    }
  } else{
    $summary=$json[0]['summary'];
    foreach($summary as $key => $value){
      echo "<tr><td>{$key}</td><td><input type='text' name='{$key}' value='{$value}'></td></tr>";
    }
  }
  echo "</table>";
} elseif(isset($_POST['google'])) {
  $url="https://www.googleapis.com/books/v1/volumes?q=".$isbn[0].$isbn[1].$isbn[2].$isbn[3].$isbn[4]."+isbn";
  $json = file_get_contents($url);
  $json = json_decode($json,true);
  echo "<table>";
  if($json['totalItems']==0 || $json['totalItems']=='0'){
    foreach($columns as $key){
      echo "<tr><td>{$key}</td><td><input type='text' name='{$key}' value=''></td></tr>";
    }
  } else{
    $info = $json["items"][0]['volumeInfo'];
    #echo $info['title'].'<br>';
    foreach($columns as $key){
      if($key=='isbn'){
        $value=$isbn[0].$isbn[1].$isbn[2].$isbn[3].$isbn[4];
      }else{
        $value = getValue($info,$key);
      }
      echo "<tr><td>{$key}</td><td><input type='text' name='{$key}' value='{$value}'></td></tr>";
    }
  }
  echo "</table>";
} else{
  echo "False<br>";
}
echo "<br><input type='submit' value='INSERT RECORD'>";
echo "</form>";
#echo "<br><a href='getBookInfo.html'>ISBN入力</a>";
echo "<br><a href='index.php'>ISBN入力</a>";
 ?>
