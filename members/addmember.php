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
    <!-- <label for="id">id</label><br>
    <input type="text" name="id"><br> -->
    <tr>
      <td><label for="firstname">firstname</label></td>
      <td><input type="text" name="name" id=""></td>
    </tr>
    <tr>
      <td><label for="lastname">lastname</label></td>
      <td><input type="text" name="surname"></td>
      </tr>
      <tr>
        <td><label>Event</label>
        <td>
          <select name="event">
          <?php
          $parameter1=0;
          include("./sqlselectevent.php"); ?>
          </select>
        </td>
      </tr>
      <tr>
        <td><input type="submit"></td>
      </tr>
    
    </table>
  </form>
</body>
</html>