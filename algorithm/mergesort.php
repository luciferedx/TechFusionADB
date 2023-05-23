<?php
function mergeSort($array) {
   $count = count($array);
   if ($count <= 1) {
       return $array;
   }
   $mid = (int) $count / 2;
   $left = array_slice($array, 0, $mid);
   $right = array_slice($array, $mid);
   $left = mergeSort($left);
   $right = mergeSort($right);
   return merge($left, $right);
}

function merge($left, $right) {
   $result = [];
   while (count($left) > 0 && count($right) > 0) {
       if ($left[0]['placed_on'] < $right[0]['placed_on']) {
           $result[] = array_shift($left);
       } else {
           $result[] = array_shift($right);
       }
   }
   return array_merge($result, $left, $right);
}
?>