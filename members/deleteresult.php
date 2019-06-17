<?php
include('../database/config.php');
include('../database/opendb.php');
mysqli_autocommit($dbaselink,FALSE);
  $id=$_GET['para'];
  
  $query="DELETE FROM members ";
  $query.="WHERE ID = ?  ";
  $query.="LIMIT 1";

  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("i",$id);
  $result=$preparedquery->execute(); 
    if(($preparedquery->errno)or($result===false)){ 
    echo "member doesn't exist";
    }else{
    header("location: overzicht.php?para=2");
    }
  
  
  $preparedquery->close();
  mysqli_commit($dbaselink);
include('../database/closedb.php');
?>