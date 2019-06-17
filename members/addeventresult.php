<?php
include("../database/config.php");
include("../database/opendb.php");
if( (isset($_POST["id"]))  and  (isset($_POST["event"]))  ){
  $id=$_POST["id"];
  $event=$_POST["event"];
}else{
  echo "error";
  exit;
}

$pattren = "/[^0-9]/";
$id= preg_replace($pattren,"",substr(trim($id),0,11));
$event= preg_replace($pattren,"",substr(trim($event),0,11));
if(($event=="") and ($id=="") ){
  echo "error pattren";
  exit;
}
if(($id!==$_POST["id"]) and ($event!==$_POST["event"])  ){
  echo "error pattren";
  exit;
}

$query="INSERT INTO participants ";
$query.="VALUES(?,?)";

$preparedquery=$dbaselink->prepare($query);
$preparedquery->bind_param("ii",$event,$id);
$result=$preparedquery->execute(); 

if(($preparedquery->errno)or($result===false)){ 
  echo "query error";
}else{
  header("location: overzicht.php?para=3");
}
$preparedquery->close();
include('../database/closedb.php');

?>