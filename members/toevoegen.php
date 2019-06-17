<?php
include('../database/config.php');
include('../database/opendb.php');


$query="SELECT max(id) AS id FROM members";
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
if( (isset($_POST["name"]))  and  (isset($_POST["surname"]))  ){

  $name=$_POST["name"];
  $lastname=$_POST["surname"];
}else{
  echo "test";
  mysqli_rollback($dbaselink);
}
  $pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ]/";
  $name= preg_replace($pattren,"",substr(trim($name),0,20));
  if($name==""){
    echo "error 205";
    exit;
  }
  if($name!==$_POST["name"]){
    echo "error 205";
    exit;
  }
  $pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ -]/";
  $lastname= preg_replace($pattren,"",substr(trim($lastname),0,20));
  if($lastname==""){
    echo "error 205";
    exit;
  }
  if($lastname!==$_POST["surname"]){
    echo "error 205";
    exit;
  }
  





  $query="INSERT INTO members ";
  $query.="VALUES (?, ?, ?) ";

  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("iss",$id,$name,$lastname);
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

