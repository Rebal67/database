<?php
include("../database/config.php");
include("../database/opendb.php");


$qeury= "SELECT id,firstname FROM members";

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




?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
   integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <link rel="stylesheet" href="overview.css">
  
  

</head>
<body>
  <h2>My Database</h2>
  
  <div class="table">
    <a class="tab" href="./addmember.php"><span >&plus;</span></a>
  <table class="overview">
    <tr>
      <th colspan="3">Firstname</th>  <th></th>
      <th>Update</th>
      <th>Delete</th>
      <th>Add event</th>
    </tr>
<?php
while($row=$result->fetch_assoc()){
      echo "<tr>";
      echo '<td colspan="3"><a href="details.php?para=' . $row["id"] . '">'.$row["firstname"]."</a></td>";
      echo "<td></td>";
      echo '<td><a href="update.php?para=' . $row["id"] . '">'." <i class=\"fas fa-edit\"></i> </a></td>";
      echo '<td><a href="deleteconfirm.php?para=' . $row["id"] . '">'." <i class=\"far fa-trash-alt\"></i></a><br></td>";
      echo '<td><a href="addevent.php?para=' . $row["id"] . '">'." <i class=\"fas fa-user-plus\"></i> </a>&nbsp; &nbsp;</td>";
      echo "</tr>";
      
    };
    ?>
    </table>
  </div>
  <?php 
  if(isset($_GET["para"])){
    $error=$_GET["para"];
      if($error==1){
      echo "<div class=\"shadow\"id=\"Error\">
      <div class=\"error\">
      <span onclick=\"close()\">&times;</span><h2>Member has been Updated</h2>
      </div>
      </div>";
    }

    if($error==2){
      echo "<div class=\"shadow\"id=\"Error\">
      <div class=\"error\">
      <span onclick=\"closeShadow()\">&times;</span><h2>Member has been Deleted</h2>
      </div>
      </div>";
    }
    if($error==3){
      echo "<div class=\"shadow\"id=\"Error\">
      <div class=\"error\">
      <span onclick=\"closeShadow()\">&times;</span><h2>Member has been Added</h2>
      </div>
      </div>";
    }
  }
  
?>
<script>
  function closeShadow(){
     var modal = document.getElementById("Error"); 
    modal.style.display = "none";
  }
  var modal = document.getElementById('Error');
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>
</body>
</html>

<?php
include("../database/closedb.php");?>

