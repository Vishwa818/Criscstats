<?php
session_start();
include("dbcon.php");
    $query = "select * from player";
    $player_result = mysqli_query($con, $query);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
      </script>
    </head>
  <body>
  
  <nav class="navbar static-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">CricStats</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="nav navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="show_match.php">Matches</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="show_player.php" href="#">Players</a>
      </li>
    </ul>
    <ul class="nav navbar-nav">
      <li><a class='btn btn-secondary' href='player_page.php'> Add New Player</a>
    </ul>
  </div>
</nav>
    
  <table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player Id</th>
      <th scope="col">Name</th>
      <th scope="col">Handle</th>
    </tr>
  </thead>
  <tbody>
   <?php
   while($row=mysqli_fetch_assoc($player_result)){
    echo"<tr>
    <th scope='row'>".$row['Player_Id']."</th>
    <td>".$row['Name']."</td>
    <td>
    <a class='btn btn-secondary' href='view_player.php?id=" .$row['Player_Id']."'> View</a>
    <a class='btn btn-secondary' href='modify_player.php?id=" .$row['Player_Id']."'> Edit</a>
    </td>
    
  </tr>";
   } 
   ?>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>