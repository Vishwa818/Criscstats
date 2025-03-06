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
    $infoA_array = array();
    $infoB_array = array();
    for($i=1; $i<12; $i++){
        $Info_Id = "Info_Id" . $i;
        $query = "select * from info where Info_Id = $teamA_result[$Info_Id]";
        $infoA_array[$i-1] = mysqli_fetch_assoc(mysqli_query($con, $query));
        $query = "select * from info where Info_Id = $teamB_result[$Info_Id]";
        $infoB_array[$i-1] = mysqli_fetch_assoc(mysqli_query($con ,$query));
    }

    // Modify match details
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
        $Info_Id = "Info_Id" . $x;
        $query = "update info set Player_Id=$player_ida, Runs=$runsa, Fours=$foursa, Sixes=$sixesa, Balls_Faced=$balls_faceda, Status='$statusa', Overs=$oversa, Runs_Given=$runs_givena, Wickets_Taken=$wickets_takena where Info_id=$teamA_result[$Info_Id]";
        mysqli_query($con, $query);
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
        $Info_Id = "Info_Id" . $x;
        $query = "update info set Player_Id=$player_idb, Runs=$runsb, Fours=$foursb, Sixes=$sixesb, Balls_Faced=$balls_facedb, Status='$statusb', Overs=$oversb, Runs_Given=$runs_givenb, Wickets_Taken=$wickets_takenb where Info_id=$teamB_result[$Info_Id]";
        mysqli_query($con, $query);
        $total_runsb = $total_runsb + $_POST["runsb".$x];
        
    }
    $teamA = $_POST['team_A'];
    $teamB = $_POST['team_B'];
    $held_date = $_POST['Held_On'];
    // Modify Team A name
    $query = "update team set Team_Name = '$teamA' where Team_Id = $teamA_id";
    mysqli_query($con, $query);
    // Modify Team B name
    $query = "update team set Team_Name = '$teamB' where Team_Id = $teamB_id";
    mysqli_query($con, $query);

    // Modify a match entry
    $team_won = ($total_runsa > $total_runsb)? $teamA_id : $teamB_id;
    $query = "update matches set Team_Won = '$team_won', Held_On = '$held_date' where Match_Id = $match_id";
    $result = mysqli_query($con, $query);
    if($result){
        echo "<div class='alert alert-success' role='alert'>
        Match details modified
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
    <form action='' method='post'>
<div class="col-3 ">
  <h1>Match held on</h1>
    <label for="HeldOn" class="form-label">Date</label>
    <input type="date" class="form-control" id="Held_On" name="Held_On", value="<?php echo $match_result['Held_On']?>">
</div>
<div class="first">
  <div class="col-3 ">
  <h1>TeamA details</h1>
    <label for="teamA" class="form-label">TeamA</label>
    <input type="text" class="form-control" id="team_A" name="team_A" value="<?php echo $teamA_result['Team_Name'] ?>">
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
      <td><input type="int" class="form-control" id="playerid" name="pa1" value=<?php echo $infoA_array[0]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa1"  value=<?php echo $infoA_array[0]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa1" value=<?php echo $infoA_array[0]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa1" value=<?php echo $infoA_array[0]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda1" value=<?php echo $infoA_array[0]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa1" value=<?php echo $infoA_array[0]['Status'] ?> >
  <option value="Out" <?php echo ($infoA_array[0]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[0]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[0]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa1" value=<?php echo $infoA_array[0]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena1" value=<?php echo $infoA_array[0]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena1" value=<?php echo $infoA_array[0]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><input type="int" class="form-control" id="playerid" name="pa2" value=<?php echo $infoA_array[1]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa2" value=<?php echo $infoA_array[1]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa2" value=<?php echo $infoA_array[1]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa2" value=<?php echo $infoA_array[1]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda2" value=<?php echo $infoA_array[1]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa2" value=<?php echo $infoA_array[1]['Status'] ?> usa2">
  <option value="Out" <?php echo ($infoA_array[1]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[1]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[1]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa2" value=<?php echo $infoA_array[1]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena2" value=<?php echo $infoA_array[1]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena2" value=<?php echo $infoA_array[1]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><input type="int" class="form-control" id="playerid" name="pa3" value=<?php echo $infoA_array[2]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa3" value=<?php echo $infoA_array[2]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa3" value=<?php echo $infoA_array[2]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa3" value=<?php echo $infoA_array[2]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda3" value=<?php echo $infoA_array[2]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa3" value=<?php echo $infoA_array[2]['Status'] ?> >
  <option value="Out" <?php echo ($infoA_array[2]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[2]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[2]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa3" value=<?php echo $infoA_array[2]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena3" value=<?php echo $infoA_array[2]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena3" value=<?php echo $infoA_array[2]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><input type="int" class="form-control" id="playerid" name="pa4" value=<?php echo $infoA_array[3]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa4" value=<?php echo $infoA_array[3]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa4" value=<?php echo $infoA_array[3]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa4" value=<?php echo $infoA_array[3]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda4" value=<?php echo $infoA_array[3]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa4" value=<?php echo $infoA_array[3]['Status'] ?> >
  <option value="Out" <?php echo ($infoA_array[3]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[3]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[3]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa4" value=<?php echo $infoA_array[3]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena4" value=<?php echo $infoA_array[3]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena4" value=<?php echo $infoA_array[3]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><input type="int" class="form-control" id="playerid" name="pa5" value=<?php echo $infoA_array[4]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa5" value=<?php echo $infoA_array[4]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa5" value=<?php echo $infoA_array[4]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa5" value=<?php echo $infoA_array[4]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda5" value=<?php echo $infoA_array[4]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa5" value=<?php echo $infoA_array[4]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[4]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[4]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[4]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa5" value=<?php echo $infoA_array[4]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena5" value=<?php echo $infoA_array[4]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena5" value=<?php echo $infoA_array[4]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><input type="int" class="form-control" id="playerid" name="pa6" value=<?php echo $infoA_array[5]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa6" value=<?php echo $infoA_array[5]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa6" value=<?php echo $infoA_array[5]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa6" value=<?php echo $infoA_array[5]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda6" value=<?php echo $infoA_array[5]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa6" value=<?php echo $infoA_array[5]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[5]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[5]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[5]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa6" value=<?php echo $infoA_array[5]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena6" value=<?php echo $infoA_array[5]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena6" value=<?php echo $infoA_array[5]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><input type="int" class="form-control" id="playerid" name="pa7"  value=<?php echo $infoA_array[6]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa7" value=<?php echo $infoA_array[6]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa7" value=<?php echo $infoA_array[6]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa7" value=<?php echo $infoA_array[6]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda7" value=<?php echo $infoA_array[6]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa7"  value=<?php echo $infoA_array[6]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[6]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[6]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[6]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa7" value=<?php echo $infoA_array[6]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena7" value=<?php echo $infoA_array[6]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena7" value=<?php echo $infoA_array[6]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><input type="int" class="form-control" id="playerid" name="pa8" value=<?php echo $infoA_array[7]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa8" value=<?php echo $infoA_array[7]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa8" value=<?php echo $infoA_array[7]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa8" value=<?php echo $infoA_array[7]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda8" value=<?php echo $infoA_array[7]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa8" value=<?php echo $infoA_array[7]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[7]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[7]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[7]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa8" value=<?php echo $infoA_array[7]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena8" value=<?php echo $infoA_array[7]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena8" value=<?php echo $infoA_array[7]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td><input type="int" class="form-control" id="playerid" name="pa9" value=<?php echo $infoA_array[8]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa9" value=<?php echo $infoA_array[8]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa9" value=<?php echo $infoA_array[8]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa9" value=<?php echo $infoA_array[8]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda9" value=<?php echo $infoA_array[8]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa9" value=<?php echo $infoA_array[8]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[8]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[8]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[8]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa9" value=<?php echo $infoA_array[8]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena9" value=<?php echo $infoA_array[8]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena9" value=<?php echo $infoA_array[8]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><input type="int" class="form-control" id="playerid" name="pa10"  value=<?php echo $infoA_array[9]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa10" value=<?php echo $infoA_array[9]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa10" value=<?php echo $infoA_array[9]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa10" value=<?php echo $infoA_array[9]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda10" value=<?php echo $infoA_array[9]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa10" value=<?php echo $infoA_array[9]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[9]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoA_array[9]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[9]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa10" value=<?php echo $infoA_array[9]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena10" value=<?php echo $infoA_array[9]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena10" value=<?php echo $infoA_array[9]['Wickets_Taken'] ?> ></td>
    </tr>
    <tr>
      <th scope="row">11</th>
      <td><input type="int" class="form-control" id="playerid" name="pa11"  value=<?php echo $infoA_array[10]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsa11" value=<?php echo $infoA_array[10]['Runs'] ?> ></td>
      <td><input type="int" class="form-control" id="fours" name="foursa11" value=<?php echo $infoA_array[10]['Fours'] ?> ></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesa11" value=<?php echo $infoA_array[10]['Sixes'] ?> ></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_faceda11" value=<?php echo $infoA_array[10]['Balls_Faced'] ?> ></td>
      <td><select class="form-select" name="statusa11" value=<?php echo $infoA_array[10]['Status'] ?>> 
  <option value="Out" <?php echo ($infoA_array[10]['Status'] == 'Out')?"selected":""; ?>>Out</option>
  <option value="Not_out" <?php echo ($infoA_array[10]['Status'] == 'Not_out')?"selected":""; ?>>Not out</option>
  <option value="Not_played" <?php echo ($infoA_array[10]['Status'] == 'Not_played')?"selected":""; ?>>Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversa11" value=<?php echo $infoA_array[10]['Overs'] ?> ></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givena11" value=<?php echo $infoA_array[10]['Runs_Given'] ?> ></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takena11" value=<?php echo $infoA_array[10]['Wickets_Taken'] ?> ></td>
    </tr>
   
  </tbody>
</table>

</div>
</div>
<div class="second">
<div class="col-3">
  <h1>TeamB details</h1>
    <label for="teamB" class="form-label">TeamB</label>
    <input type="text" class="form-control" id="team_B" name="team_B" value="<?php echo $teamB_result['Team_Name'] ?>" >
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
      <td><input type="int" class="form-control" id="playerid" name="pb1"  value=<?php echo $infoB_array[0]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb1"  value=<?php echo $infoB_array[0]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb1"  value=<?php echo $infoB_array[0]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb1"  value=<?php echo $infoB_array[0]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb1"  value=<?php echo $infoB_array[0]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb1"  value=<?php echo $infoB_array[0]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[0]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[0]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[0]['Status'] == 'Not_played')?"selected":""; ?> >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb1"  value=<?php echo $infoB_array[0]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb1"  value=<?php echo $infoB_array[0]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb1"  value=<?php echo $infoB_array[0]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td><input type="int" class="form-control" id="playerid" name="pb2"  value=<?php echo $infoB_array[1]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb2" value=<?php echo $infoB_array[1]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb2"  value=<?php echo $infoB_array[1]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb2"  value=<?php echo $infoB_array[1]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb2"  value=<?php echo $infoB_array[1]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb2"  value=<?php echo $infoB_array[1]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[1]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[1]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[1]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb2"  value=<?php echo $infoB_array[1]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb2"  value=<?php echo $infoB_array[1]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb2"  value=<?php echo $infoB_array[1]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td><input type="int" class="form-control" id="playerid" name="pb3"  value=<?php echo $infoB_array[2]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb3" value=<?php echo $infoB_array[2]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb3"  value=<?php echo $infoB_array[2]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb3"  value=<?php echo $infoB_array[2]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb3"  value=<?php echo $infoB_array[2]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb3"  value=<?php echo $infoB_array[2]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[2]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[2]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[2]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb3"  value=<?php echo $infoB_array[2]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb3"  value=<?php echo $infoB_array[2]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb3"  value=<?php echo $infoB_array[2]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">4</th>
      <td><input type="int" class="form-control" id="playerid" name="pb4"  value=<?php echo $infoB_array[3]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb4" value=<?php echo $infoB_array[3]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb4"  value=<?php echo $infoB_array[3]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb4"  value=<?php echo $infoB_array[3]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb4"  value=<?php echo $infoB_array[3]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb4"  value=<?php echo $infoB_array[3]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[3]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[3]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[3]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb4"  value=<?php echo $infoB_array[3]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb4"  value=<?php echo $infoB_array[3]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb4"  value=<?php echo $infoB_array[3]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">5</th>
      <td><input type="int" class="form-control" id="playerid" name="pb5"  value=<?php echo $infoB_array[4]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb5" value=<?php echo $infoB_array[4]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb5"  value=<?php echo $infoB_array[4]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb5"  value=<?php echo $infoB_array[4]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb5"  value=<?php echo $infoB_array[4]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb5"  value=<?php echo $infoB_array[4]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[4]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[4]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[4]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb5"  value=<?php echo $infoB_array[4]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb5"  value=<?php echo $infoB_array[4]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb5"  value=<?php echo $infoB_array[4]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">6</th>
      <td><input type="int" class="form-control" id="playerid" name="pb6"  value=<?php echo $infoB_array[5]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb6" value=<?php echo $infoB_array[5]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb6"  value=<?php echo $infoB_array[5]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb6"  value=<?php echo $infoB_array[5]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb6"  value=<?php echo $infoB_array[5]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb6"  value=<?php echo $infoB_array[5]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[5]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[5]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[5]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb6"  value=<?php echo $infoB_array[5]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb6"  value=<?php echo $infoB_array[5]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb6"  value=<?php echo $infoB_array[5]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">7</th>
      <td><input type="int" class="form-control" id="playerid" name="pb7"  value=<?php echo $infoB_array[6]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb7" value=<?php echo $infoB_array[6]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb7"  value=<?php echo $infoB_array[6]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb7"  value=<?php echo $infoB_array[6]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb7"  value=<?php echo $infoB_array[6]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb7"  value=<?php echo $infoB_array[6]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[6]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[6]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[6]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb7"  value=<?php echo $infoB_array[6]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb7"  value=<?php echo $infoB_array[6]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb7"  value=<?php echo $infoB_array[6]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">8</th>
      <td><input type="int" class="form-control" id="playerid" name="pb8"  value=<?php echo $infoB_array[7]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb8" value=<?php echo $infoB_array[7]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb8"  value=<?php echo $infoB_array[7]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb8"  value=<?php echo $infoB_array[7]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb8"  value=<?php echo $infoB_array[7]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb8"  value=<?php echo $infoB_array[7]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[7]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[7]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[7]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb8"  value=<?php echo $infoB_array[7]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb8"  value=<?php echo $infoB_array[7]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb8"  value=<?php echo $infoB_array[7]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">9</th>
      <td><input type="int" class="form-control" id="playerid" name="pb9"  value=<?php echo $infoB_array[8]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb9"  value=<?php echo $infoB_array[8]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb9"  value=<?php echo $infoB_array[8]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb9"  value=<?php echo $infoB_array[8]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb9"  value=<?php echo $infoB_array[8]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb9"  value=<?php echo $infoB_array[8]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[8]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[8]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[8]['Status'] == 'Not_played')?"selected":""; ?> >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb9"  value=<?php echo $infoB_array[8]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb9"  value=<?php echo $infoB_array[8]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb9"  value=<?php echo $infoB_array[8]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">10</th>
      <td><input type="int" class="form-control" id="playerid" name="pb10"  value=<?php echo $infoB_array[9]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb10" value=<?php echo $infoB_array[9]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb10"  value=<?php echo $infoB_array[9]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb10"  value=<?php echo $infoB_array[9]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb10"  value=<?php echo $infoB_array[9]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb10"  value=<?php echo $infoB_array[9]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[9]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[9]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[9]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb10"  value=<?php echo $infoB_array[9]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb10"  value=<?php echo $infoB_array[9]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb10"  value=<?php echo $infoB_array[9]['Wickets_Taken'] ?>></td>
    </tr>
    <tr>
      <th scope="row">11</th>
      <td><input type="int" class="form-control" id="playerid" name="pb11"  value=<?php echo $infoB_array[10]['Player_Id'] ?> ></td>
      <td><input type="int" class="form-control" id="runs" name="runsb11" value=<?php echo $infoB_array[10]['Runs'] ?>></td>
      <td><input type="int" class="form-control" id="fours" name="foursb11"  value=<?php echo $infoB_array[10]['Fours'] ?>></td>
      <td><input type="int" class="form-control" id="sixes" name="sixesb11"  value=<?php echo $infoB_array[10]['Sixes'] ?>></td>
      <td><input type="int" class="form-control" id="balls_faced" name="balls_facedb11"  value=<?php echo $infoB_array[10]['Balls_Faced'] ?>></td>
      <td><select class="form-select" name="statusb11"  value=<?php echo $infoB_array[10]['Status'] ?>>
  <option value="Out" <?php echo ($infoB_array[10]['Status'] == 'Out')?"selected":""; ?> >Out</option>
  <option value="Not_out" <?php echo ($infoB_array[10]['Status'] == 'Not_out')?"selected":""; ?> >Not out</option>
  <option value="Not_played" <?php echo ($infoB_array[10]['Status'] == 'Not_played')?"selected":""; ?>  >Not played</option>
</select></td>
<td><input type="int" class="form-control" id="overs" name="oversb11"  value=<?php echo $infoB_array[10]['Overs'] ?>></td>
<td><input type="int" class="form-control" id="runs_given" name="runs_givenb11"  value=<?php echo $infoB_array[10]['Runs_Given'] ?>></td>
<td><input type="int" class="form-control" id="wickets_taken" name="wickets_takenb11"  value=<?php echo $infoA_array[10]['Wickets_Taken'] ?>></td>
    </tr>
   
  </tbody>
</table>
<a href="show_match.php" class="btn btn-primary">Back</a>
<button type="submit" class="btn btn-primary">Modify</button>
</div>
</div>
</form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
