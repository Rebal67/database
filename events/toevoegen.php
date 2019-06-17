<?php
include('../database/config.php');
include('../database/opendb.php');


$query="SELECT max(id) AS id FROM events";
$preparedquery=$dbaselink->prepare($query); 
$result=$preparedquery->execute(); 
  
  if(($preparedquery->errno)or($result===false)){ 
    echo "query error";
  }else{
      $result=$preparedquery->get_result();
    if($result->num_rows===0){
      echo "no";
  
    }else{
        while($row=$result->fetch_assoc()){
        $id=$row['id'];
        $id++;
      };
    }
    
  }
  $preparedquery->close();



mysqli_autocommit($dbaselink,FALSE);
if( (isset($_POST["name"]))  and  (isset($_POST["description"])) and  (isset($_POST["date"])) and  (isset($_POST["contactid"]))
and  (isset($_POST["maxpart"]))  ){

  $date=$_POST["date"];
  $maxpart=$_POST["maxpart"];
  $contactid=$_POST["contactid"];
  $name=$_POST["name"];
  $description=$_POST["description"];
}else{
  echo "test";
  mysqli_rollback($dbaselink);
}
  $pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ 0-9]/";
  $name= preg_replace($pattren,"",substr(trim($name),0,20));
  if($name==""){
    echo "error pattren";
    exit;
  }
  if($name!==$_POST["name"]){
    echo "error pattren";
    exit;
  }
  $pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ -]/";
  $description= preg_replace($pattren,"",substr(trim($description),0,20));
  if($description==""){
    echo "error pattren";
    exit;
  }
  if($description!==$_POST["description"]){
    echo "error pattren";
    exit;
  }
  
  $pattren = "/[^0-9]/";
  $contactid= preg_replace($pattren,"",substr(trim($contactid),0,20));
  if($contactid==""){
    echo "error contactid";
    exit;
  }
  if($contactid!==$_POST["contactid"]){
    echo "error contactid";
    exit;
  }

  $pattren = "/[^0-9]/";
  $maxpart= preg_replace($pattren,"",substr(trim($maxpart),0,20));
  if($maxpart==""){
    echo "error pattren";
    exit;
  }
  if($maxpart!==$_POST["maxpart"]){
    echo "error pattren";
    exit;
  }

  $pattren = "/[^0-9-]/";
  $date= preg_replace($pattren,"",substr(trim($date),0,20));
  if($date==""){
    echo "error date";
    exit;
  }
  if($date!==$_POST["date"]){
    echo "error date";
    exit;
  }





  $query="INSERT INTO events ";
  $query.="VALUES (?, ?, ?, ?, ?, ?) ";
 
  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("isssis",$id,$name,$description,$date,$contactid,$maxpart);
  $result=$preparedquery->execute(); 

  if(($preparedquery->errno)or($result===false)){ 
    echo "query error";
    mysqli_rollback($dbaselink);
  }else{
    header("location: overzicht.php?para=3");
  }
  $preparedquery->close();
  mysqli_commit($dbaselink);
include('../database/closedb.php');
?>