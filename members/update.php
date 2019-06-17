<?php
if(isset($_GET["para"])){
  $id=$_GET['para'];
}else{
  echo "error";
}
$pattren = "/[^0-9]/";
  $id= preg_replace($pattren,"",substr(trim($id),0,40));
  if($id==""){
    echo "error 205";
    exit;
  }
  if($id!==$_GET["para"]){
    echo "error 205";
    exit;
  }
 
include("../database/config.php");
include("../database/opendb.php");


$qeury= "SELECT surname,firstname FROM members ";
$qeury.="WHERE id =".$id;

$preparedquery=$dbaselink->prepare($qeury);
$preparedquery->execute();

if($preparedquery->errno){
  echo "query is not working ";
}else{
  $result=$preparedquery->get_result();
  if($result->num_rows===0){
    echo "there is not any result found";
  }
  $row=mysqli_fetch_array($result);
}
$preparedquery->close();
include("../database/closedb.php");


 echo "<form action=\"updateresult.php\" method=\"POST\"> ";
 echo "<input type=\"hidden\" name=\"id\" value=\"".$id."\">";

 echo "<label for=\"firstname\">firstname</label><br>";
 echo "<input type=\"text\" name=\"name\" value=\"".$row['firstname']."\"><br>";

 echo "<label for=\"lastname\" value=\"\">lastname</label><br>";
 echo "<input type=\"text\" name=\"surname\" value=\"".$row['surname']."\"><br>";
 echo "<input type=\"submit\">";
 echo "</form>";




?>