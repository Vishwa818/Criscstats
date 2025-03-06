<?php
include("dbcon.php");
$player_id = $_GET['id'];
$query = "select * from player where Player_Id = $player_id";
$player_result = mysqli_fetch_assoc(mysqli_query($con, $query));
if($_SERVER['REQUEST_METHOD']=='POST'){
 $player_name=$_POST['player_name']; 
 $birth_date=$_POST['birth_date'];
 $state=$_POST['state'];
 $country=$_POST['country'];
 $role=$_POST['role'];
 $batting=$_POST['batting_action'];
 $bowling=$_POST['bowling_action'];
 $que="update Player set Name = '$player_name', Dob = '$birth_date', State = '$state',Country = '$country',Role = '$role',Batting_style = '$batting',Bowling_style = '$bowling' where Player_Id = $player_id";
 $result=mysqli_query($con,$que);
if($result){
  echo "<div class='alert alert-success' role='alert'>
  player details modified
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
   <form method="post">
  <div class="mb-3 col-4">
    <label for="player_name" class="form-label">Name</label>
    <input type="text" class="form-control" id="player_name" name="player_name" value="<?php echo $player_result['Name'] ?>">
  </div>
  <div class="mb-3 col-4">
    <label for="birth_date" class="form-label">Date of birth</label>
    <input type="date" class="form-control" id="birth_date" name="birth_date" value="<?php echo $player_result['Dob'] ?>">
  </div>
  <div class="mb-3 col-4">
    <label for="state" class="form-label">State</label>
    <input type="text" class="form-control" id="state" name="state" value="<?php echo $player_result['State'] ?>">
  </div>
  <div class="mb-3 col-4">
    <label for="country" class="form-label">Country</label>
    <input type="text" class="form-control" id="country" name="country" value="<?php echo $player_result['Country'] ?>">
  </div>
  <div class="mb-3 col-4">
    <label for="role" class="form-label">Role</label>
    <select class="form-select"  id="role" name="role">
    <option value="Batsmen" <?php echo ($player_result['Role'] == 'Batsmen')?"selected":""; ?>>Batsman</option>
    <option value="Bowler" <?php echo ($player_result['Role'] == 'Bowler')?"selected":""; ?>>Bowler</option>
    <option value="Allrounder" <?php echo ($player_result['Role'] == 'Allrounder')?"selected":""; ?>>All rounder</option>
    <option value="Wk-Batsmen" <?php echo ($player_result['Role'] == 'Wk-Batsmen')?"selected":""; ?>>Wk-Batsmen</option>
</select>
  </div>
  <div class="mb-3 col-4">
    <label for="batting_action" class="form-label">Batting style</label>
    <select class="form-select" id="batting_action" name="batting_action">
    <option value="Right_handed" <?php echo ($player_result['Role'] == 'Right_handed')?"selected":""; ?>>Right handed</option>
    <option value="Left_handed" <?php echo ($player_result['Role'] == 'Left_handed')?"selected":""; ?>>Left handed</option>
</select>
  </div>
  <div class="mb-3 col-4">
    <label for="bowling_action" class="form-label">Bowling style</label>
    <select class="form-select"  id="bowling_action" name="bowling_action">
    <option value="Leftarm_fast" <?php echo ($player_result['Role'] == 'Leftarm_fast')?"selected":""; ?>>Leftarm fast</option>
    <option value="Rightarm_fast" <?php echo ($player_result['Role'] == 'Rightarm_fast')?"selected":""; ?>>Rightarm fast</option>
    <option value="Leftarm_fast_medium" <?php echo ($player_result['Role'] == 'Leftarm_fast_medium')?"selected":""; ?>>Leftarm fast medium</option>
    <option value="Rightarm_fast_medium" <?php echo ($player_result['Role'] == 'Rightarm_fast_medium')?"selected":""; ?>>Rightarm fast medium</option>
    <option value="Rightarm_finger_spin" <?php echo ($player_result['Role'] == 'Rightarm_finger_spin')?"selected":""; ?>>Rightarm finger spin</option>
    <option value="Leftarm_finger_spin" <?php echo ($player_result['Role'] == 'Leftarm_finger_spin')?"selected":""; ?>>Leftarm finger spin</option>
    <option value="Rightarm_wrist_spin" <?php echo ($player_result['Role'] == 'Rightarm_wrist_spin')?"selected":""; ?>>Rightarm wrist spin</option>
    <option value="Leftarm_wrist_spin" <?php echo ($player_result['Role'] == 'Leftarm_wrist_spin')?"selected":""; ?>>Leftarm wrist spin</option>
</select>
  </div>
  <button type="submit" class="btn btn-primary">Modify</button>
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