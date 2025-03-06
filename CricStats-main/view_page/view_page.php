<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="view_page.css">
    <script src="view_page.js"></script>
    <title>cricinfo</title>
</head>
<body>

<?php 
include 'C:\xampp\htdocs\cricstats\dbms\dbcon.php';
if(isset($_POST['submit'])){
    $textSel = $_POST['textSel'];
    $pid = $_POST['pid'];
    $name = $_POST['name'];
    $dob = $_POST['dob'];
    $state = $_POST['state'];
    $country= $_POST['country'];
    $role= $_POST['role'];
    $battingstyle= $_POST['battingstyle'];
    $bowlinghand= $_POST['bowlinghand'];
    $bowlingstyle= $_POST['bowlingstyle'];
    if($textSel === "1"){
        $insertquery = " insert into players(player_id, name, dob, state, country, role, batting_style, bowling_hand, bowling_style) values ('$pid','$name','$dob','$state','$country', '$role', '$battingstyle', '$bowlinghand', '$bowlingstyle')";
        $query  = mysqli_query($con,$insertquery);
        if($query){
          ?>
              <script>
                  alert("Insertion Successful");
              </script>
          <?php
        }
        else{
          ?>
              <script>
                  alert("Insertion failed");
              </script>
          <?php
        }
    }
    if($textSel === "2"){
        $modifyquery = "UPDATE `players` SET `player_id` = '$pid', `name` = '$name', `state` = '$state', `country` = '$country', `role` = '$role', `batting_style` = '$battingstyle', `bowling_hand` = '$bowlinghand', `bowling_style` = '$bowlingstyle' WHERE `players`.`player_id` = '$pid' ";
        $query  = mysqli_query($con,$modifyquery);
        if($query){
          ?>
              <script>
                  alert("Successfully Modified");
              </script>
          <?php
        }
        else{
          ?>
              <script>
                  alert("No record found");
              </script>
          <?php
        }
        
    }
    if($textSel === "3"){
        $deletequery = "DELETE FROM players WHERE `players`.`player_id` = '$pid'";
        $query  = mysqli_query($con,$deletequery);
        if($query){
          ?>
              <script>
                  alert("Successfully Deleted");
              </script>
          <?php
        }
        else{
          ?>
              <script>
                  alert("No record found");
              </script>
          <?php
        }
    }
}
?>

  <h1 class="title" >CricStat</h1>
   <div id="textSelectdiv">
    <form id="survey-form" method="POST" action="">
        <label for="name" style="padding-right: 20px; font-weight: bolder;margin-left: 8px;padding: 10px;" >Operation : </label> 
        <select name="textSel" class="select" style="display: inline; height: 30px; width: 200px;">
            <option selected> Please select</option>
          <option value="1">Add</option>
          <option value="2">Modify</option>
          <option value="3">Delete</option>
        </select>
      </div>
      <div id="inputDiv" class="form-outline disaplayInput">
        <input type="text" id="form12" class="form-control" style="display: none;" onblur="hideInput()" disabled />
        <label id="inputLabel" class="form-label disaplayInput" for="form12">Other</label>
      </div>
<div id="form-outer">
    <div class="rowTab">
      <div class="labels">
        <label id="name-label" for="name">Player Id: </label>
      </div>
      <div class="rightTab">
        <input autofocus type="text" name="pid" id="pid" class="input-field" placeholder="Enter your Player Id" required>
      </div>
    </div>

    <div class="rowTab">
        <div class="labels">
          <label id="name-label" for="name">Name: </label>
        </div>
        <div class="rightTab">
          <input autofocus type="text" name="name" id="name" class="input-field" placeholder="Enter your Name" required>
        </div>
      </div>

      <div class="rowTab">
        <div class="labels">
          <label id="dob-label" for="dob">D.O.B: </label>
        </div>
        <div class="rightTab">
          <input type="date" name="dob" id="dob" class="input-field" required>
        </div>
      </div>

      <div class="rowTab">
        <div class="labels">
          <label id="name-label" for="name">State: </label>
        </div>
        <div class="rightTab">
          <input autofocus type="text" name="state" id="state" class="input-field" placeholder="Enter your Player State" required>
        </div>
      </div>

      <div class="rowTab">
        <div class="labels">
          <label id="name-label" for="name">Country: </label>
        </div>
        <div class="rightTab">
          <input autofocus type="text" name="country" id="country" class="input-field" placeholder="Enter your Player Country" required>
        </div>
      </div>

      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: 46px;padding: 10px;" >Role : </label> 
        <select name="role" class="select" style="display: inline; height: 30px; width: 200px;">
            <option selected> Please select</option>
          <option value="1">Batsmen</option>
          <option value="2">WK-Batsmen</option>
          <option value="3">Bowler</option>
          <option value="4">All-Rounder</option>
        </select>
      </div>
    
      
      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: 46px;padding: 10px;" >Batting Style : </label> 
        <select name="battingstyle" class="select" style="display: inline; height: 30px; width: 200px;">
            <option selected> Please select</option>
          <option value="1">Right Handed</option>
          <option value="2">Left Handed</option>
        </select>
      </div>

      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: 46px;padding: 10px;" >Bowling Hand : </label> 
        <select name="bowlinghand" class="select" style="display: inline; height: 30px; width: 200px;">
            <option selected> Please select</option>
          <option value="1">Right Hand</option>
          <option value="2">Left Hand</option>
        </select>
      </div>
      
      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: 46px;padding: 10px;" >Bowling Style : </label> 
        <select name="bowlingstyle" class="select" style="display: inline; height: 30px; width: 200px;">
            <option selected> Please select</option>
          <option value="1">Fast medium</option>
          <option value="2">Medium</option>
          <option value="3">Finger Spin(Off Spin)</option>
          <option value="4">Wrist Spin(Leg Splin)</option>
        </select>
      </div>
    
    
    <button name="submit" type="submit">Submit</button>
    <button name="reset" type="reset">Reset</button>
  </form>
</div>
</body>
</html>