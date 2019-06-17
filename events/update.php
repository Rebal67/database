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


$qeury= "SELECT description,name,eventdate,contactid,maxpart FROM events ";
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

echo "
<form class=\"form\" action=\"updateresult.php\" method=\"POST\">
<table>
  <h1>update event</h1>
  <tr>
  <td><label for=\"firstname\">name</label></td>
  <td><input type=\"text\" name=\"name\" value=\"".$row['name']."\"></td>
  </tr>

  <tr>
   <td><label for=\"lastname\">description</label></td>
   <td><input type=\"text\" name=\"description\" value=\"".$row['description']."\"></td>
  </tr>
  
  <tr>
    <td><label for=\"lastname\">date</label></td>
    <td><input type=\"date\" name=\"date\" value=\"".$row['eventdate']."\"></td>
  </tr>

  <tr>
    <td><label for=\"lastname\" >maxpart</label></td>
    <td><input type=\"text\" name=\"maxpart\" value=\"".$row['maxpart']."\"></td>
  </tr>

  <tr>
    <td><label for=\"lastname\" value=\"".$row['contactid']."\">contactid</label></td>
    <td>
      <select  name=\"contactid\">";
      $parameter1=$row['contactid'];
   echo  include("./sqlselectfirstname.php"); 
   echo "
      </select>
    </td>
  </tr>

  
  
  <tr><td>". $row["maxpart"] . "</td></tr>
  <tr>
    <td><input type=\"submit\"></td>
    <td><input type=\"hidden\" name=\"id\" value=\"".$id."\"></td>
  </tr>
  
</table>

";


?>