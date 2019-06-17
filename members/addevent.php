<?php
include("../database/config.php");
include("../database/opendb.php");

$id=$_GET["para"];
$qeury= "SELECT id FROM events ";
$qeury.="WHERE contactid =".$id;

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
?> 
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>add participant</title>
</head>
<body>
  <?php


echo "<form method='POST' action='addeventresult.php'>";
echo "<table>";
echo "<tr>";
echo "<th> PART NAME</th>";
echo "</tr>";
echo "<tr>";
echo "<input type='hidden' value=\"".$id."\" name=\"id\"> ";
echo "<td><select name=\"event\">";
$parameter1=0;
include("sqlselectevent.php");
echo "</select></td>";
echo "</tr>";
echo "<tr>";
echo "<td><input type='submit'></td>";
echo "</tr>";
echo "</table>";
echo "</form>";


?>
</body>
</html>


