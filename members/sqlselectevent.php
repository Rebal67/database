<?php
include('../database/config.php');
include('../database/opendb.php');

$qeury= "SELECT id,name FROM events ORDER BY name";

$preparedquery=$dbaselink->prepare($qeury);
$preparedquery->execute();

if($preparedquery->errno){
  echo "query is not working ";
}else{
  $result=$preparedquery->get_result();
  if($result->num_rows===0){
    echo "there is not any result found";
  }
}
$preparedquery->close();


while($row=$result->fetch_assoc()){
  echo "<option value=\"".$row['id']."\"" ;
  if($parameter1==$row["id"]){
    echo "selected";
  }
  echo ">";
  echo $row['name'];
  echo "</option>";
};

include("../database/closedb.php");
