<?php
include("dbcon.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $info_id_arraya = array_fill(0, 11, -1);
    $info_id_arrayb = array_fill(0, 11, -1);
    $total_runsa = 0;
    $total_runsb = 0;
    for($x = 1; $x < 12 ; $x++)
    {
        $player_ida = $_POST['pa' . $x];
        $runsa = $_POST['runsa'. $x];
        $foursa = $_POST['foursa'.$x];
        $sixesa = $_POST['sixesa'.$x];
        $balls_faceda = $_POST['balls_faceda'.$x];
        $statusa = $_POST['statusa'.$x];
        $oversa = $_POST['oversa'.$x];
        $runs_givena = $_POST['runs_givena'.$x];
        $wickets_takena = $_POST['wickets_takena'.$x];
        $query = "insert into info (Player_Id, Runs, Fours, Sixes, Balls_Faced, Status, Overs, Runs_Given, Wickets_Taken) values ($player_ida, $runsa, $foursa, $sixesa, $balls_faceda, '$statusa', $oversa, $runs_givena, $wickets_takena)";
        mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);
        $info_id_arraya[$x-1] = $last_id;
        $total_runsa = $total_runsa + $_POST["runsa".$x];
    }
    for($x = 1; $x < 12 ; $x++)
    {
        $player_idb = $_POST['pb' . $x];
        $runsb = $_POST['runsb'. $x];
        $foursb = $_POST['foursb'.$x];
        $sixesb = $_POST['sixesb'.$x];
        $balls_facedb = $_POST['balls_facedb'.$x];
        $statusb = $_POST['statusb'.$x];
        $oversb = $_POST['oversb'.$x];
        $runs_givenb = $_POST['runs_givenb'.$x];
        $wickets_takenb = $_POST['wickets_takenb'.$x];
        $query = "insert into info (Player_Id, Runs, Fours, Sixes, Balls_Faced, Status, Overs, Runs_Given, Wickets_Taken) values ($player_idb, $runsb, $foursb, $sixesb, $balls_facedb, '$statusb', $oversb, $runs_givenb, $wickets_takenb)";
        mysqli_query($con, $query);
        $last_id = mysqli_insert_id($con);
        $info_id_arrayb[$x-1] = $last_id;
        $total_runsb = $total_runsb + $_POST["runsb".$x];
        
    }
    $teamA = $_POST['team_A'];
    $teamB = $_POST['team_B'];
    $held_on = $_POST['Held_On'];
    // Insert Team A
    $query = "insert into team (Team_Name, Info_Id1, Info_Id2, Info_Id3, Info_Id4, Info_Id5, Info_Id6, Info_Id7, Info_Id8, Info_Id9, Info_Id10, Info_Id11) values ('$teamA', $info_id_arraya[0], $info_id_arraya[1], $info_id_arraya[2], $info_id_arraya[3], $info_id_arraya[4], $info_id_arraya[5], $info_id_arraya[6], $info_id_arraya[7], $info_id_arraya[8], $info_id_arraya[9], $info_id_arraya[10])";
    mysqli_query($con, $query);
    $teama_id = mysqli_insert_id($con);
    // Insert Team B
    $query = "insert into team (Team_Name, Info_Id1, Info_Id2, Info_Id3, Info_Id4, Info_Id5, Info_Id6, Info_Id7, Info_Id8, Info_Id9, Info_Id10, Info_Id11) values ('$teamB', $info_id_arrayb[0], $info_id_arrayb[1], $info_id_arrayb[2], $info_id_arrayb[3], $info_id_arrayb[4], $info_id_arrayb[5], $info_id_arrayb[6], $info_id_arrayb[7], $info_id_arrayb[8], $info_id_arrayb[9], $info_id_arrayb[10])";
    mysqli_query($con, $query);
    $teamb_id = mysqli_insert_id($con);

    // Create a match entry
    $team_won = ($total_runsa > $total_runsb)? $teama_id : $teama_id;
    $query = "INSERT INTO matches (TeamA_Id, TeamB_Id, Team_Won, Held_On) VALUES ($teama_id , $teamb_id , $team_won, $held_on)";
    $result = mysqli_query($con, $query);
    if($result){
      echo "<div class='alert alert-success' role='alert'>
      Match details added
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
    <link href="Add_match.css" rel="stylesheet">
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
  </div>
</nav>
    <div class="container">
    <form method='post'>
    <div class="first">
<div class="col-3 ">
  <h1>Match held on</h1>
    <label for="HeldOn" class="form-label">Date</label>
    <input type="date" class="form-control" id="HeldOn" name="Held_On" required>
</div>
<div class="first">
  <div class="col-3 ">
  <h1>TeamA details</h1>
    <label for="teamA" class="form-label">TeamA</label>
    <input type="text" class="form-control" id="team_A" name="team_A" required>
</div>
    <h2>score_data</h2>
<div>  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">player_id</th>
      <th scope="col">runs</th>
      <th scope="col">fours</th>
      <th scope="col">sixes</th>
      <th scope="col">balls_faced</th>
      <th scope="col">status</th>
      <th scope="col">overs</th>
      <th scope="col">runs_given</th>
      <th scope="col">wickets_taken</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><input type="int" class="form-control" id="playerid" name="pa1" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa1"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa1"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa1"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda1"></td>
      <td><select class="form-select" name="statusa1">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa1"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena1"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena1"></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><input type="int" class="form-control" id="playerid" name="pa2" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa2"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa2"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa2"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda2"></td>
      <td><select class="form-select" name="statusa2">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa2"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena2"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena2"></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><input type="int" class="form-control" id="playerid" name="pa3" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa3"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa3"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa3"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda3"></td>
      <td><select class="form-select" name="statusa3">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa3"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena3"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena3"></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><input type="int" class="form-control" id="playerid" name="pa4" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa4"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa4"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa4"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda4"></td>
      <td><select class="form-select" name="statusa4">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa4"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena4"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena4"></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><input type="int" class="form-control" id="playerid" name="pa5" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa5"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa5"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa5"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda5"></td>
      <td><select class="form-select" name="statusa5">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa5"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena5"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena5"></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><input type="int" class="form-control" id="playerid" name="pa6" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa6"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa6"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa6"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda6"></td>
      <td><select class="form-select" name="statusa6">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa6"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena6"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena6"></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><input type="int" class="form-control" id="playerid" name="pa7" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa7"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa7"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa7"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda7"></td>
      <td><select class="form-select" name="statusa7">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa7"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena7"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena7"></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><input type="int" class="form-control" id="playerid" name="pa8" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa8"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa8"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa8"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda8"></td>
      <td><select class="form-select" name="statusa8">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa8"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena8"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena8"></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td><input type="int" class="form-control" id="playerid" name="pa9" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa9"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa9"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa9"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda9"></td>
      <td><select class="form-select" name="statusa9">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa9"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena9"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena9"></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><input type="int" class="form-control" id="playerid" name="pa10" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa10"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa10"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa10"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda10"></td>
      <td><select class="form-select" name="statusa10">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa10"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena10"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena10"></td>
    </tr>
    <tr>
      <th scope="row">11</th>
      <td><input type="int" class="form-control" id="playerid" name="pa11" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsa11"></td>
      <td><input type="int" class="form-control" id="fours" name="foursa11"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa11"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda11"></td>
      <td><select class="form-select" name="statusa11">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa11"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena11"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena11"></td>
    </tr>
   
  </tbody>
</table>
</div>
</div>
<div class="second">
<div class="col-3">
  <h1>TeamB details</h1>
    <label for="teamB" class="form-label">TeamB</label>
    <input type="text" class="form-control" id="team_B" name="team_B" required>
</div>
    <h2>score_data</h2>
<div>  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">player_id</th>
      <th scope="col">runs</th>
      <th scope="col">fours</th>
      <th scope="col">sixes</th>
      <th scope="col">balls_faced</th>
      <th scope="col">status</th>
      <th scope="col">overs</th>
      <th scope="col">runs_given</th>
      <th scope="col">wickets_taken</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td><input type="int" class="form-control" id="playerid" name="pb1" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb1"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb1"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb1"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb1"></td>
      <td><select class="form-select" name="statusb1">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb1"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb1"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb1"></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><input type="int" class="form-control" id="playerid" name="pb2" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb2"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb2"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb2"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb2"></td>
      <td><select class="form-select" name="statusb2">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb2"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb2"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb2"></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><input type="int" class="form-control" id="playerid" name="pb3" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb3"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb3"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb3"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb3"></td>
      <td><select class="form-select" name="statusb3">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb3"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb3"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb3"></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><input type="int" class="form-control" id="playerid" name="pb4" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb4"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb4"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb4"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb4"></td>
      <td><select class="form-select" name="statusb4">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb4"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb4"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb4"></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><input type="int" class="form-control" id="playerid" name="pb5" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb5"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb5"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb5"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb5"></td>
      <td><select class="form-select" name="statusb5">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb5"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb5"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb5"></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><input type="int" class="form-control" id="playerid" name="pb6" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb6"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb6"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb6"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb6"></td>
      <td><select class="form-select" name="statusb6">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb6"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb6"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb6"></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><input type="int" class="form-control" id="playerid" name="pb7" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb7"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb7"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb7"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb7"></td>
      <td><select class="form-select" name="statusb7">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb7"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb7"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb7"></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><input type="int" class="form-control" id="playerid" name="pb8" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb8"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb8"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb8"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb8"></td>
      <td><select class="form-select" name="statusb8">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb8"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb8"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb8"></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td><input type="int" class="form-control" id="playerid" name="pb9" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb9" ></td>
      <td><input type="int" class="form-control" id="fours" name="foursb9"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb9"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb9"></td>
      <td><select class="form-select" name="statusb9">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb9"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb9"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb9"></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><input type="int" class="form-control" id="playerid" name="pb10" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb10"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb10"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb10"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb10"></td>
      <td><select class="form-select" name="statusb10">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb10"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb10"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb10"></td>
    </tr>
    <tr>
      <th scope="row">11</th>
      <td><input type="int" class="form-control" id="playerid" name="pb11" required></td>
      <td><input type="int" class="form-control" id="runs" name="runsb11"></td>
      <td><input type="int" class="form-control" id="fours" name="foursb11"></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb11"></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb11"></td>
      <td><select class="form-select" name="statusb11">
  <option value="Out" >Out</option>
  <option value="Not_out" >Not out</option>
  <option value="Not_played" selected >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb11"></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb11"></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb11"></td>
    </tr>
   
  </tbody>
</table>
 

<button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>