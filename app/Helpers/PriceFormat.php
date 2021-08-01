<?php
function priceFormat($angka){
  $hasil='Rp '.number_format($angka,0,',','.');
  return $hasil;
}
