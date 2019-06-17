
<?php
include("../database/config.php");
include("../database/opendb.php");
if(isset($_GET["para"])){
  $id=$_GET["para"];
}else{
  echo "error";
}
$pattren = "/[^0-9]/";
  $id= preg_replace($pattren,"",substr(trim($id),0,11));
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
      echo "<div class='confirm'>";
      echo "are you sure you want to delete <br>";
      echo"id = ".$id."<br>";
      echo "label = ". $row["name"]."<br>";
      echo "description = ". $row["description"]."<br>";
      echo "contactid= ". $row["contactid"]."<br>";
      echo "maxpart = ". $row["maxpart"]."<br>";
      echo "<a href='overzicht.php'>NO</a> <a href=\"deleteresult.php?para=".$id."\">YES</a>";
      echo "</div>";
    };
  }
}
$preparedquery->close();
include("../database/closedb.php");

?>
