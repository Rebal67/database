<?php
include('../database/config.php');
include('../database/opendb.php');
if( (isset($_POST["name"]))  and  (isset($_POST["description"])) and (isset($_POST['id'])) and  (isset($_POST["date"]))
 and (isset($_POST["maxpart"])) and (isset($_POST["contactid"])) ){
  $id=$_POST['id'];
  $name=$_POST["name"];
  $description=$_POST["description"];
  $date=$_POST["date"];
  $maxpart=$_POST["maxpart"];
  $contactid=$_POST["contactid"];
}else{
  echo "test"; 
  exit;
}
$pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ 0-9]/";
$name= preg_replace($pattren,"",substr(trim($name),0,20));
if($name==""){
  echo "error firstname";
  exit;
}
if($name!==$_POST["name"]){
  echo "error firstname";
  exit;
}
$pattren = '/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ0-9 -]/';
$description= preg_replace($pattren,"",substr(trim($description),0,20));
if($description==""){
  echo "error lastname";
  exit;
}
if($description!==$_POST["description"]){
  echo "error lastname";
  exit;
}
$pattren = "/[^0-9]/";
  $id= preg_replace($pattren,"",substr(trim($id),0,10));
  if($id==""){
    echo "error id";
    exit;
  }
  if($id!==$_POST["id"]){
    echo "error id";
    exit;
  }
  $pattren = "/[^0-9-]/";
  $date=preg_replace($pattren,"",substr(trim($date),0,40));
  if($date==""){
    echo "error DAte";
    exit;
  }
  if($date!==$_POST["date"]){
    echo "DATE";
    exit;
  }

  $maxpart=preg_replace($pattren,"",substr(trim($maxpart),0,40));
  if($maxpart==""){
    echo "error maxpart";
    exit;
  }
  if($maxpart!==$_POST["maxpart"]){
    echo "DATE";
    exit;
  }

  $contactid=preg_replace($pattren,"",substr(trim($contactid),0,40));
  if($contactid==""){
    echo "error DAte";
    exit;
  }
  if($contactid!==$_POST["contactid"]){
    echo "contacid error";
    exit;
  }






  $query="UPDATE events ";
  $query.="Set  name = ?, description = ?, eventdate = ?, contactid = ?, maxpart = ? ";
  $query.="WHERE id = ?";

  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("sssiii",$name,$description,$date,$contactid,$maxpart,$id);
  $result=$preparedquery->execute(); 

  if(($preparedquery->errno)or($result===false)){ 
    echo "query error";
  }else{
    echo "member updated";
    header("location: overzicht.php?para=1");
  }
  $preparedquery->close();
include('../database/closedb.php');

?>