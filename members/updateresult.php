<?php
include('../database/config.php');
include('../database/opendb.php');
if( (isset($_POST["name"]))  and  (isset($_POST["surname"])) and (isset($_POST['id'])) ){
  $id=$_POST['id'];
  $name=$_POST["name"];
  $lastname=$_POST["surname"];
}else{
  echo "test";
  exit;
}
$pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ]/";
$name= preg_replace($pattren,"",substr(trim($name),0,20));
if($name==""){
  echo "error firstname";
  exit;
}
if($name!==$_POST["name"]){
  echo "error firstname";
  exit;
}
$pattren = '/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ -]/';
$lastname= preg_replace($pattren,"",substr(trim($lastname),0,20));
if($lastname==""){
  echo "error lastname";
  exit;
}
if($lastname!==$_POST["surname"]){
  echo "error lastname";
  exit;
}
$pattren = "/[^0-9]/";
  $id= preg_replace($pattren,"",substr(trim($id),0,40));
  if($id==""){
    echo "error id";
    exit;
  }
  if($id!==$_POST["id"]){
    echo "error id";
    exit;
  }
  
  $query="UPDATE members ";
  $query.="Set  firstname = ?, surname = ? ";
  $query.="WHERE id = ?";

  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("ssi",$name,$lastname,$id);
  $result=$preparedquery->execute(); 

  if(($preparedquery->errno)or($result===false)){ 
    echo "query error";
    mysqli_rollback();
  }else{
    echo "member updated";
    header("location: overzicht.php?para=1");
  }
  $preparedquery->close();
include('../database/closedb.php');

?>