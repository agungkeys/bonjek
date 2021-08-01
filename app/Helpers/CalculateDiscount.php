<?php
function calculateDiscount($price, $discount){
  $value = ($discount/100)*$price;
  $realValue = $price-$value;
  return $realValue;
}
