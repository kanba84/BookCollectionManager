<?php
function separateISBN($isbn){
  if((int)$isbn[3]<= 1){
    #English book
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,4),substr($isbn,8,4),substr($isbn,12,1));
  } elseif((int)$isbn[4]<= 1){
    #2 digits
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,2),substr($isbn,6,6),substr($isbn,12,1));
  } elseif((int)$isbn[4]<= 6){
    #3 digits
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,3),substr($isbn,7,5),substr($isbn,12,1));
  } elseif((int)$isbn[4]<= 7){
    #4 digits
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,4),substr($isbn,8,4),substr($isbn,12,1));
  } elseif(((int)$isbn[4] == 8)&&((int)$isbn[5]<=5)){
    #4 digits
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,4),substr($isbn,8,4),substr($isbn,12,1));
  } elseif((int)$isbn[4] == 8){
    #5 digits
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,5),substr($isbn,9,3),substr($isbn,12,1));
  } else {
    $sep=array(substr($isbn,0,3),substr($isbn,3,1),substr($isbn,4,6),substr($isbn,10,2),substr($isbn,12,1));
  }
  return $sep;
}
?>
