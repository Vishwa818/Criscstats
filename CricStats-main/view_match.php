<?php
session_start();
include("dbcon.php");
    $match_id = $_GET['id'];
    $query = "select * from matches where Match_Id = $match_id";
    $match_result = mysqli_fetch_assoc(mysqli_query($con, $query));
    $teamA_id = $match_result['TeamA_Id'];
    $teamB_id = $match_result['TeamB_Id'];

    $query = "select * from team where Team_Id = $teamA_id";
    $teamA_result = mysqli_fetch_assoc(mysqli_query($con, $query));
    $query = "select * from team where Team_Id = $teamB_id";
    $teamB_result = mysqli_fetch_assoc(mysqli_query($con, $query));
    if ($teamA_result['Team_Id'] = $match_result['Team_Won']){
        $team_won = $teamA_result['Team_Name'];
    }
    else{
        $team_won = $teamB_result['Team_Name'];
    }
    $infoA_array = array();
    $infoB_array = array();
    for($i=1; $i<12; $i++){
        $Info_Id = "Info_Id" . $i;
        $query = "select * from player inner join info on player.Player_Id = info.Player_Id where info.Info_Id = $teamA_result[$Info_Id]";
        $infoA_array[$i-1] = mysqli_fetch_assoc(mysqli_query($con, $query));
        $query = "select * from player inner join info on player.Player_Id = info.Player_Id where info.Info_Id = $teamB_result[$Info_Id]";
        $infoB_array[$i-1] = mysqli_fetch_assoc(mysqli_query($con ,$query));
    }
    // Team a varaibles
    $teamA_total_runs = 0;
    $teamB_total_runs = 0;
    $teamA_total_wickets = 0;
    $teamB_total_wickets = 0;

    for($i=1; $i<12; $i++){
        $Info_Id = "Info_Id" . $i;
        $query = "select * from info where Info_Id = $teamA_result[$Info_Id]";
        $teamA_details = mysqli_fetch_assoc(mysqli_query($con, $query));
        $teamA_total_runs += $teamA_details['Runs'];
        if($teamA_details['Status'] == "Out"){$teamA_total_wickets++;}
        $query = "select * from info where Info_Id = $teamB_result[$Info_Id]";
        $teamB_details = mysqli_fetch_assoc(mysqli_query($con, $query));
        $teamB_total_runs += $teamB_details['Runs'];
        if($teamB_details['Status'] == "Out"){$teamB_total_wickets++;}
    }
    $diff=abs($teamA_total_runs-$teamB_total_runs);
?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  </head>
  <body>
    <h3><?php echo $team_won." won by ".$diff." runs"; ?></h3>
    <h3><?php echo$teamA_result['Team_Name']." ".$teamA_total_runs."-".$teamA_total_wickets; ?></h3>
    <table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player_id</th>
      <th scope="col">Name</th>
      <th scope="col">Runs</th>
      <th scope="col">Balls</th>
      <th scope="col">Fours</th>
      <th scope="col">sixes</th>
      <th scope="col">Strike_Rate</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   for( $i=0;$i<11;$i++){
  if($infoA_array[$i]['Status'] !='Not_played'){echo"<tr>
    <th scope='row'>".$infoA_array[$i]['Player_Id']."</th>
    <td>".$infoA_array[$i]['Name']."</td>
    <td>".$infoA_array[$i]['Runs']."</td>
    <td>".$infoA_array[$i]['Balls_Faced']."</td>
    <td>".$infoA_array[$i]['Fours']."</td>
    <td>".$infoA_array[$i]['Sixes']."</td>
    <td>".$infoA_array[$i]['Runs']*(100)/$infoA_array[$i]['Balls_Faced']."</td>
  </tr>";}
   }
   
   ?>
  </tbody>
</table>
<table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player_id</th>
      <th scope="col">Name</th>
      <th scope="col">Overs</th>
      <th scope="col">Runs_Given</th>
      <th scope="col">Wickets_Taken</th>
      <th scope="col">Economy</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   for( $i=0;$i<11;$i++){
  if($infoA_array[$i]['Overs'] !=0){echo"<tr>
    <th scope='row'>".$infoA_array[$i]['Player_Id']."</th>
    <td>".$infoA_array[$i]['Name']."</td>
    <td>".$infoA_array[$i]['Overs']."</td>
    <td>".$infoA_array[$i]['Runs_Given']."</td>
    <td>".$infoA_array[$i]['Wickets_Taken']."</td>
    <td>".$infoA_array[$i]['Runs_Given']/$infoA_array[$i]['Overs']."</td>
  </tr>";}
   }
   ?>
  </tbody>
</table>
<h3><?php echo$teamB_result['Team_Name']." ".$teamB_total_runs."-".$teamB_total_wickets; ?></h3>
<table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player_id</th>
      <th scope="col">Name</th>
      <th scope="col">Runs</th>
      <th scope="col">Balls</th>
      <th scope="col">Fours</th>
      <th scope="col">sixes</th>
      <th scope="col">Strike_Rate</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   for( $i=0;$i<11;$i++){
  if($infoB_array[$i]['Status'] !='Not_played'){echo"<tr>
    <th scope='row'>".$infoB_array[$i]['Player_Id']."</th>
    <td>".$infoB_array[$i]['Name']."</td>
    <td>".$infoB_array[$i]['Runs']."</td>
    <td>".$infoB_array[$i]['Balls_Faced']."</td>
    <td>".$infoB_array[$i]['Fours']."</td>
    <td>".$infoB_array[$i]['Sixes']."</td>
    <td>".$infoB_array[$i]['Runs']*(100)/$infoB_array[$i]['Balls_Faced']."</td>
  </tr>";}
   }
   
   ?>
  </tbody>
</table>
<table class="table table-striped table-borderred" id="myTable">
  <thead>
    <tr>
      <th scope="col">Player_id</th>
      <th scope="col">Name</th>
      <th scope="col">Overs</th>
      <th scope="col">Runs_Given</th>
      <th scope="col">Wickets_Taken</th>
      <th scope="col">Economy</th>
    </tr>
  </thead>
  <tbody>
   <?php 
   for( $i=0;$i<11;$i++){
  if($infoB_array[$i]['Overs'] !=0){echo"<tr>
    <th scope='row'>".$infoB_array[$i]['Player_Id']."</th>
    <td>".$infoB_array[$i]['Name']."</td>
    <td>".$infoB_array[$i]['Overs']."</td>
    <td>".$infoB_array[$i]['Runs_Given']."</td>
    <td>".$infoB_array[$i]['Wickets_Taken']."</td>
    <td>".$infoB_array[$i]['Runs_Given']/$infoB_array[$i]['Overs']."</td>
  </tr>";}
   }
   ?>
  </tbody>
</table>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>