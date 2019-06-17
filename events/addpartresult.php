<?php
include("../database/config.php");
include("../database/opendb.php");
if( (isset($_POST["id"]))  and  (isset($_POST["part"]))  ){
  $id=$_POST["id"];
  $part=$_POST["part"];
}else{
  echo "error";
  exit;
}

$pattren = "/[^0-9]/";
$id= preg_replace($pattren,"",substr(trim($id),0,11));
$part= preg_replace($pattren,"",substr(trim($part),0,11));
if(($part=="") and ($id=="") ){
  echo "error pattren";
  exit;
}
if(($id!==$_POST["id"]) and ($part!==$_POST["part"])  ){
  echo "error pattren";
  exit;
}

$query="INSERT INTO participants ";
$query.="VALUES(?,?)";

$preparedquery=$dbaselink->prepare($query);
$preparedquery->bind_param("ii",$id,$part);
$result=$preparedquery->execute(); 

if(($preparedquery->errno)or($result===false)){ 
  echo "query error";
}else{
  header("location: overzicht.php?para=3");
}
$preparedquery->close();
include('../database/closedb.php');

?>