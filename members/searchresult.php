<?php
include('../database/config.php');
include('../database/opendb.php');
  if(isset($_GET["name"])){
    $firstname=$_GET["name"];
  }else{
    echo "error";
    exit;
  }
  
  $pattren = "/[^A-Za-zàÀáÁâÂãÃäÄåāÅæèÈéÉêÊëËìÌíÍîÎïÏòÒóÓöÖôÔõÕøØùÙúÚûÛüÜýÝÿçÇñÑ]/";
  $firstname= preg_replace($pattren,"",substr(trim($firstname),0,20));
  if($firstname==""){
    echo "error 205";
    exit;
  }
  if($firstname!==$_GET["name"]){
    echo "error 205";
    exit;
  }
  


  $query="SELECT surname,id ";
  $query.="FROM members ";
  $query.="Where firstname = ? ";

  $preparedquery=$dbaselink->prepare($query);
  $preparedquery->bind_param("s",$firstname);
  $preparedquery->execute();

  if($preparedquery->errno){
    echo "query error";
  }else{
    $result=$preparedquery->get_result();
    if($result->num_rows===0){
      echo " no result found";
    }else{
      while($row=$result->fetch_assoc()){
        echo "voorname = ". $firstname.'<a href="details.php?para=' . $row["id"] . '">'." &nbsp;info"."</a> <br>";
        echo "Achtername = ". $row["surname"]."<br><br>";
        
      };
    }
  }
  $preparedquery->close();
include('../database/closedb.php');
?>