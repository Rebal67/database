<?php
echo "<h1>Members</h1>";
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
 

$query="SELECT * FROM members WHERE id = ?";

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
      echo"id = ".$id."<br>";
      echo "voorname = ". $row["firstname"]."<br>";
      echo "Achtername = ". $row["surname"]."<br>";
      echo '<a href="deleteconfirm.php?para=' . $row["id"] . '">'."  verwijderen</a><br>";
        
    };
  }
}
$preparedquery->close();



echo "<h2> events </h2>";

$query="SELECT events.name , events.id ";
$query.="FROM events,participants "; 
$query.="WHERE participants.memberid = ? ";
$query.="AND participants.eventid= events.id";

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
      echo '<a href="../events/details.php?para='.$row['id'].'">'.$row["name"]."</a><br>";
    };
    
    
  }
}
$preparedquery->close();
include("../database/closedb.php");
echo "<br>";
 echo "<div>";
 echo '<a href="addevent.php?para=' . $id . '">'."  add event</a><br>";
 echo "</div>";
 echo "<a href='./overzicht.php'>HOME</a>";
?>
