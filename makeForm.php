<?php
function makeForm($columns){
  $arr = array('isbn','title','publisher','pubdate','cover','volume','series','author','location','status','name');
  $tag = "<form name='form{$columns[0]}' action='info.php' method='post'>";
  foreach($arr as $key){
    $tag = $tag."<input type='hidden' name='{$key}' value='{$columns[$key]}'>";
  }
  $tag = $tag."<a href='info.php' onClick='document.form{$columns[0]}.submit();return false;'>{$columns['title']}</a></form>";
  return $tag;
}
 ?>
