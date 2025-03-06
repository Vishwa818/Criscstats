<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="display.css">
    <script src="display.js"></script>
    <title>cricinfo</title>
</head>
<body>
  <form action="/query_page/display.php" method="post">
    <h1 class="title" >CricStat</h1>
  
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
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: 32px;padding: 10px;" >Role : </label> 
        <select name="role" id="role" class="select" style="display: inline; height: 30px; width: 200px;">
            <option value="0" selected>Any</option>
          <option value="1">Batsmen</option>
          <option value="2">WK-Batsmen</option>
          <option value="3">Bowler</option>
          <option value="4">All-Rounder</option>
        </select>
      </div>
    
      
      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: -30px;padding: 10px;" >Batting Style : </label> 
        <select name="battingstyle" id="battingstyle" class="select" style="display: inline; height: 30px; width: 200px;">
            <option value="0" selected> Any</option>
          <option value="1">Right Handed</option>
          <option value="2">Left Handed</option>
        </select>
      </div>

      
      <div id="textSelectdiv">
        <label for="name" style="padding-right: 15px; font-weight: bolder;margin-left: -35px;padding: 10px;" >Bowling Style : </label> 
        <select name="bowlingstyle" id="bowlingstyle" class="select" style="display: inline; height: 30px; width: 200px;">
            <option value="0" selected>Any</option>
          <option value="1">Right arm Fast medium</option>
          <option value="2">Left arm Fast medium</option>
          <option value="3">Right arm Finger Spin(Off Spin)</option>
          <option value="4">Left arm Finger Spin(Off Spin)</option>
          <option value="5">Right arm wrist Spin(Leg Splin)</option>
          <option value="6">Left arm wrist Spin(Leg Splin)</option>
        </select>
      </div>
      
      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Matches Played: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="matchesplayed1" id="matchesplayed1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="matchesplayed2" id="matchesplayed2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Runs: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="runs1" id="runs1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="runs2" id="runs2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>
      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Balls Faced: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="ballsfaced1" id="ballsfaced1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="ballsfaced2" id="ballsfaced2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Not Outs: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="notouts1" id="notouts1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="notouts2" id="notouts2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">4's: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="fours1" id="fours1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="fours2" id="fours2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">6's: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="sixes1" id="sixes1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="sixes2" id="sixes2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Average: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="average1" id="average1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="average2" id="average2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Strikerate: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="strikerate1" id="strikrerate1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="strikerate2" id="strikerate2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">50's: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="fifty1" id="fifty1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="fifty2" id="fifty2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">100's: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="hundred1" id="hundred1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="hundred2" id="hundred2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

   
     
      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Overs Bowled: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="oversbowled1" id="oversbowled1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="oversbowled2" id="oversbowled2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Wickets Taken: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="wicketstaken1" id="wicketstaken1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="wicketstaken2" id="wicketstaken2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Runs Conceded: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="runsconceded1" id="runsconceded1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="runsconceded2" id="runsconceded2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Economy: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="economy1" id="economy1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="economy2" id="economy2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>

      <div class="rowTab">
        <div class="labels2">
          <label id="name-label" for="name">Bowling Strike Rate: </label>
        </div>
        <div class="rightTab2">
          <input autofocus type="text" name="bowlingstrikerate1" id="bowlingstrikerate1" class="input-field2" placeholder="Start Range" required>
        </div>
        <div class="rightTab2">
            <input autofocus type="text" name="bowlingstrikerate2" id="bowlingstrikerate2" class="input-field2" placeholder="End Range" required>
          </div>
      </div>
    
    <button id="submit" type="submit">Submit</button>
    <button id="reset" type="reset">Reset</button>
  </form>
</div>
</body>
</html>