<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function j($data) {
  header('Content-Type: application/json');
  echo json_encode($data);
}

function cpost($url, $data) {
  /*
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://192.168.64.23/stat/index.php/api/".$url);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $result = json_decode(curl_exec($ch), true);
  $error = curl_error($ch);
  curl_close ($ch);

  return (["result"=>$result, "error"=>$error]);*/
  return null;
}
function cget($url) {
  /*
  $ch = curl_init();  
 
  curl_setopt($ch,CURLOPT_URL,"http://192.168.64.23/stat/index.php/api/".$url);
  curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
  //  curl_setopt($ch,CURLOPT_HEADER, false); 

  $result = json_decode(curl_exec($ch), true);
  $error = curl_error($ch);

  curl_close ($ch);

  return (["result"=>$result, "error"=>$error]);*/
  return null;
}