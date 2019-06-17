<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Page Title</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="overview.css">
  
</head>
<body>
  <form class="form" action="toevoegen.php" method="POST">
    <table>
      <h1>add event</h1>
      <tr>
      <td><label for="firstname">name</label></td>
      <td><input type="text" name="name" id=""></td>
      </tr>
    
      <tr>
       <td><label for="lastname">description</label></td>
       <td><input type="text" name="description"></td>
      </tr>
      
      <tr>
        <td><label for="lastname">date</label></td>
        <td><input type="date" name="date"></td>
      </tr>
      
      <tr>
        <td><label for="lastname">contactid</label></td>
        <td>
          <select  name="contactid">
          <?php
          $parameter1=0;
          include("./sqlselectfirstname.php"); ?>
          </select>
        </td>
      </tr>
 
      <tr>
        <td><label for="lastname">maxpart</label></td>
        <td><input type="number" name="maxpart"></td>
      </tr>
            
      <tr>
        <td><input type="submit"></td>
      </tr>
      
    </table>
  
    
  </form>
</body>
</html>