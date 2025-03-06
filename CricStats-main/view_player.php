<?php
session_start();
include("dbcon.php");
    $player_id = $_GET['id'];
    $player_details = mysqli_fetch_assoc(mysqli_query($con, "select * from player where Player_Id = $player_id"));
    $total_details_query = "select count(Info_Id) as total_matches, 
                            sum(Runs) as total_runs, 
                            sum(Balls_Faced) as total_balls_faced, 
                            max(Runs) as highest_runs, 
                            sum(Fours) as total_fours, 
                            sum(Sixes) as total_sixes, 
                            sum(Overs) as total_overs,
                            sum(Runs_Given) as total_runs_given,
                            sum(Wickets_Taken) as total_wickets_taken
                            from info where Player_Id = $player_id";
    $total_details = mysqli_fetch_assoc(mysqli_query($con, $total_details_query));
    $total_50s_query = "select count(Info_Id) as total_50s from info where Player_Id = $player_id and (Runs >= 50 and Runs < 100)";
    $total_100s_query = "select count(Info_Id) as total_100s from info where Player_Id = $player_id and (Runs >= 100)";
    $total_50s = mysqli_fetch_assoc(mysqli_query($con, $total_50s_query));
    $total_100s = mysqli_fetch_assoc(mysqli_query($con, $total_100s_query));
    $innings = mysqli_fetch_assoc(mysqli_query($con, "select count(Info_Id) as innings from info where Player_Id = $player_id and not (Status = 'Not_played')"));
    $total_3w_query = "select count(Info_Id) as total_3w from info where Player_Id = $player_id and (Wickets_Taken >= 3 and Wickets_Taken < 5)";
    $total_5w_query = "select count(Info_Id) as total_5w from info where Player_Id = $player_id and (Wickets_Taken >= 5)";
    $total_3w = mysqli_fetch_assoc(mysqli_query($con, $total_3w_query));
    $total_5w = mysqli_fetch_assoc(mysqli_query($con, $total_5w_query));
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>view player</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar static-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand">CricStats</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="nav navbar-nav navbar-right">
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
      <li><a class='btn btn-secondary' href='add_match.php'> Add New Match</a>
    </ul>
  </div>
</nav>
    <h3>Personal Info</h3>
  <table class="table table-striped table-borderred" id="myTable">
  <tbody>
    <tr>
      <th scope="row">Player Name</th>
      <td><?php echo $player_details['Name']; ?></td>
</tr>
<tr>
      <th scope="row">Date of Birth</th>
      <td><?php echo $player_details['Dob']; ?></td>
</tr>
<tr>
      <th scope="row">Role</th>
      <td><?php echo $player_details['Role']; ?></td>
</tr>
<tr>
      <th scope="row">Batting Style</th>
      <td><?php echo $player_details['Batting_Style']; ?></td>
</tr>
<tr>
      <th scope="row">Bowling style</th>
      <td><?php echo $player_details['Bowling_Style']; ?></td>
</tr>
<tr>
      <th scope="row">State</th>
      <td><?php echo $player_details['State']; ?></td>
</tr>
<tr>
      <th scope="row">Country</th>
      <td><?php echo $player_details['Country']; ?></td>
</tr>
  </tbody>
</table>
<h3>Batting Stats</h3>
<table class="table table-striped table-borderred" id="myTable">
  <tbody>
    <tr>
      <th scope="row">Matches</th>
      <td><?php echo $total_details['total_matches']; ?></td>
</tr>
<tr>
      <th scope="row">Innings</th>
      <td><?php echo $innings['innings']; ?></td>
</tr>
<tr>
      <th scope="row">Runs</th>
      <td><?php echo $total_details['total_runs']; ?></td>
</tr>
<tr>
      <th scope="row">Balls</th>
      <td><?php echo $total_details['total_balls_faced']; ?></td>
</tr>
<tr>
      <th scope="row">Highest</th>
      <td><?php echo $total_details['highest_runs']; ?></td>
</tr>
<tr>
      <th scope="row">Average</th>
      <td>
        <?php 
        if($innings['innings'] == 0){ echo '-/-' ;}
        else {echo round($total_details['total_runs']/$innings['innings'], 3);}
        ?>
      </td>
</tr>
<tr>
      <th scope="row">Strike Rate</th>
      <td>
      <?php 
        if($total_details['total_balls_faced'] == 0){ echo '-/-' ;}
        else {echo round($total_details['total_runs']/$total_details['total_balls_faced'], 3);}
        ?>
      </td>
</tr>
<tr>
      <th scope="row">Fours</th>
      <td><?php echo $total_details['total_fours']; ?></td>
</tr>
<tr>
      <th scope="row">Sixes</th>
      <td><?php echo $total_details['total_sixes']; ?></td>
</tr>
<tr>
      <th scope="row">Fifties</th>
      <td><?php echo $total_50s['total_50s']; ?></td>
</tr>
<tr>
      <th scope="row">Hundreds</th>
      <td><?php echo $total_100s['total_100s']; ?></td>
</tr>
  </tbody>
</table>
<h3>Bowling Stats</h3>
<table class="table table-striped table-borderred" id="myTable">
  <tbody>
    <tr>
      <th scope="row">Matches</th>
      <td><?php echo $total_details['total_matches']; ?></td>
</tr>
<tr>
      <th scope="row">Overs</th>
      <td><?php echo $total_details['total_overs']; ?></td>
</tr>
<tr>
      <th scope="row">Runs</th>
      <td><?php echo $total_details['total_runs_given']; ?></td>
</tr>
<tr>
      <th scope="row">Wickets</th>
      <td><?php echo $total_details['total_wickets_taken']; ?></td>
</tr>
<tr>
      <th scope="row">Average</th>
      <td>
      <?php 
        if($total_details['total_wickets_taken'] == 0){ echo '-/-' ;}
        else {echo round($total_details['total_runs_given']/(6*$total_details['total_wickets_taken']), 3);}
      ?>
      </td>
</tr>
<tr>
      <th scope="row">Economy</th>
      <td>
      <?php 
        if($total_details['total_overs'] == 0){ echo '-/-' ;}
        else {echo round($total_details['total_runs_given']/($total_details['total_overs']), 3);}
      ?> 
      </td>
</tr>
<tr>
      <th scope="row">Strike Rate</th>
      <td>
      <?php 
        if($total_details['total_wickets_taken'] == 0){ echo '-/-' ;}
        else {echo round(($total_details['total_overs']*6)/$total_details['total_wickets_taken'], 3);}
      ?>
      </td>
</tr>
<tr>
      <th scope="row">3W</th>
      <td><?php echo $total_3w['total_3w']; ?></td>
</tr>
<tr>
      <th scope="row">5W</th>
      <td><?php echo $total_5w['total_5w']; ?></td>
</tr>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>