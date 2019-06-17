<?php
echo "<h1>EVENT</h1>";
include("../database/config.php");
include("../database/opendb.php");

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
 

$query="SELECT * FROM events WHERE id = ?";

$preparedquery=$dbaselink->prepare($query);
$preparedquery->bind_param("i",$id);
$preparedquery->execute();

if($preparedquery->errno){
  echo "query error";
}else{
  $result=$preparedquery->get_result();
  if($result->num_rows===0){
    echo " no result found";
  }else{
    while($row=$result->fetch_assoc()){
      $contactid= $row["contactid"];
      echo"id = ".$id."<br>";
      echo "name = ". $row["name"]."<br>";
      echo "description = ". $row["description"]."<br>";
      echo "date = ". $row["eventdate"]."<br>";
      echo "maxpart = ". $row["maxpart"]."<br>";
      echo "contact id = ". $row["contactid"]." ";
    };
    
    
  }
}
$preparedquery->close();

echo '<a href="deleteconfirm.php?para=' . $id . '">'."  verwijderen</a>"; 

echo "<h2> Participants </h2>";

$query="SELECT members.firstname , members.id ";
$query.="FROM members,participants "; 
$query.="WHERE participants.eventid = ? ";
$query.="AND participants.memberid= members.id";

$preparedquery=$dbaselink->prepare($query);
$preparedquery->bind_param("i",$id);
$preparedquery->execute();

if($preparedquery->errno){
  echo "query error";
}else{
  $result=$preparedquery->get_result();
  if($result->num_rows===0){
    echo " no result found";
  }else{
    while($row=$result->fetch_assoc()){
      echo '<a href="../members/details.php?para='.$row['id'].'">'.$row["firstname"]."</a><br>";
    };
    
    
  }
}
$preparedquery->close();
include("../database/closedb.php");
echo "<div>";
 echo '<a href="addpart.php?para=' . $id . '">'."  add participant</a><br>";
 echo "</div>";
 echo "<a href='./overzicht.php'>HOME</a>";

?>