<?php
include("dbcon.php");
if($_SERVER['REQUEST_METHOD']=='POST'){
 $player_name=$_POST['player_name']; 
 $birth_date=$_POST['birth_date'];
 $state=$_POST['state'];
 $country=$_POST['country'];
 $role=$_POST['role'];
 $batting=$_POST['batting_action'];
 $bowling=$_POST['bowling_action'];
 $que="INSERT INTO Player (`Name`, `Dob`, `State`, `Country`, `Role`, `Batting_style`, `Bowling_style`) VALUES ('$player_name', '$birth_date', '$state', '$country', '$role', '$batting', '$bowling');";
 $result=mysqli_query($con,$que);
if($result){
  echo "<div class='alert alert-success' role='alert'>
  player details added
</div>";
}
else{
  echo "ERROR DUE TO" .mysqli_error($conn);
}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="player_page.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"> </script>
    <script>
      $(document).ready( function () {
    $('#myTable').DataTable();
} );
      </script>
  </head>

  <head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<nav class="navbar static-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">CricStats</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="nav navbar-nav navbar-right">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item ">
        <a class="nav-link" href="show_match.php">Matches</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="show_player.php" href="#">Players</a>
      </li>
    </ul>
  </div>
</nav>
   <div class="container mt-4 details">
   <form action="player_page.php" method="post">
  <div class="mb-3 col-4">
    <label for="player_name" class="form-label">Name</label>
    <input type="text" class="form-control" id="player_name" name="player_name" required>
  </div>
  <div class="mb-3 col-4">
    <label for="birth_date" class="form-label">Date of birth</label>
    <input type="date" class="form-control" id="birth_date" name="birth_date" required>
  </div>
  <div class="mb-3 col-4">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" id="state" name="state" required>
  </div>
  <div class="mb-3 col-4">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" name="country" required>
  </div>
  <div class="mb-3 col-4">
    <label for="role" class="form-label">Role</label>
    <select class="form-select"  id="role" name="role" required>
  <option value="Batsmen">Batsman</option>
  <option value="Bowler">Bowler</option>
  <option value="Allrounder">All rounder</option>
  <option value="Wk-Batsmen">Wk-Batsmen</option>
</select>
  </div>
  <div class="mb-3 col-4">
    <label for="batting_action" class="form-label">Batting style</label>
    <select class="form-select" id="batting_action" name="batting_action" required>
  <option value="Right_handed">Right handed</option>
  <option value="Left_handed">Left handed</option>
</select>
  </div>
  <div class="mb-3 col-4">
    <label for="bowling_action" class="form-label">Bowling style</label>
    <select class="form-select"  id="bowling_action" name="bowling_action" required>
  <option value="Leftarm_fast">Leftarm fast</option>
  <option value="Rightarm_fast">Rightarm fast</option>
  <option value="Leftarm_fast_medium">Leftarm fast medium</option>
  <option value="Rightarm_fast_medium">Rightarm fast medium</option>
  <option value="Rightarm_finger_spin">Rightarm finger spin</option>
  <option value="Leftarm_finger_spin">Leftarm finger spin</option>
  <option value="Rightarm_wrist_spin">Rightarm wrist spin</option>
  <option value="Leftarm_wrist_spin">Leftarm wrist spin</option>
</select>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
   </div>
   <div class="container present">
   <table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player id</th>
      <th scope="col">Name</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php

    $query="select * from Player";
    $res=mysqli_query($con,$query);
    while($row=mysqli_fetch_assoc($res)){
      echo "<tr>
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
   </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>