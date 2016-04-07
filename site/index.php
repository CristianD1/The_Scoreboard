
<?php 
    include 'template/header.php';


    include 'php/getLeaderboard.php';
?> 

<script>


</script>



<!-- This is the main page that only shows the scoreboard and ranking -->

<div id="pageContent">

  <div class="row">
    <div class="col s12">
      
      <center><h3>Global Stats</h3></center>

      <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header"><i class="material-icons">perm_identity</i>Foosball Scores</div>
            <div class="collapsible-body">
              <div>

                <table class="responsive-table highlight striped">
                  <thead>
                    <tr>
                        <th data-field="id">Name</th>
                        <th data-field="wins">Wins</th>
                        <th data-field="elo">Elo</th>
                        <th data-field="rank">Rank</th>
                    </tr>
                  </thead>

                  <tbody id="foosballScoresTable">
                    <tr>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>$0.87</td>
                    </tr>
                  </tbody>
                </table>
            
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">perm_identity</i>Ping Pong Scores</div>
            <div class="collapsible-body">
              <div>

                <table class="responsive-table highlight striped">
                  <thead>
                    <tr>
                        <th data-field="id">Name</th>
                        <th data-field="wins">Wins</th>
                        <th data-field="elo">Elo</th>
                        <th data-field="rank">Rank</th>
                    </tr>
                  </thead>

                  <tbody id="pingpongScoresTable">
                    <tr>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>$0.87</td>
                    </tr>
                  </tbody>
                </table>
            
              </div>
            </div>
          </li>
          <li>
            <div class="collapsible-header"><i class="material-icons">perm_identity</i>Previous Games Played</div>
            <div class="collapsible-body">
              <div>

                <table class="responsive-table highlight striped">
                  <thead>
                    <tr>
                        <th data-field="gameType">Game Type</th>
                        <th data-field="p1N">Player 1 Name</th>
                        <th data-field="p2N">Player 2 Name</th>
                        <th data-field="team1Status">Team 1 Status</th>
                        <th data-field="p3N">Player 3 Name</th>
                        <th data-field="p4N">Player 4 Name</th>
                        <th data-field="team2Status">Team 2 Status</th>
                    </tr>
                  </thead>

                  <tbody id="previousGamesTable">
                    <tr>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>$0.87</td>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>$0.87</td>
                      <td>Alvin</td>
                    </tr>
                  </tbody>
                </table>
            
              </div>
            </div>
          </li>
        </ul>

    </div> <!-- col -->
  </div> <!-- row -->

</div> <!-- container -->

<script>

  // Returns:
  //  $playerInfoRetval
  //  $gamesPlayedRetVal
  //  $foosballRetVal
  //  $pingpongRetVal

  var pingpongInfo = JSON.parse(<?php echo $pingpongRetVal ?>);
  var foosballInfo = JSON.parse(<?php echo $foosballRetVal ?>);
  var gamesPlayedInfo = JSON.parse(<?php echo $gamesPlayedRetVal ?>);


  // SET FOOSBALL SCORES INFO
    var tableHtml = "";
    if(typeof foosballInfo.error !== 'undefined'){
      tableHtml += "<tr>";
        tableHtml += "<td></td>";
        tableHtml += "<td>"+foosballInfo.error+"</td>";
        tableHtml += "<td></td>";
      tableHtml += "</tr>";
    } else {
      for(var i = 0; i < foosballInfo.length; i++){
        var currGame = foosballInfo[i];
        tableHtml += "<tr>";
          tableHtml += "<td>"+currGame.name+"</td>";
          tableHtml += "<td>"+currGame.wins+"</td>";
          tableHtml += "<td>"+currGame.elo+"</td>";
          tableHtml += "<td>"+currGame.rank+"</td>";
        tableHtml += "</tr>";
      }
    }
    $('#foosballScoresTable').html(tableHtml);
  // END FOOSBALL SCORES INFO

  // SET PINGPONG SCORES INFO
    var tableHtml = "";
    if(typeof pingpongInfo.error !== 'undefined'){
      tableHtml += "<tr>";
        tableHtml += "<td></td>";
        tableHtml += "<td>"+pingpongInfo.error+"</td>";
        tableHtml += "<td></td>";
      tableHtml += "</tr>";
    } else {
      for(var i = 0; i < pingpongInfo.length; i++){
        var currGame = pingpongInfo[i];
        tableHtml += "<tr>";
          tableHtml += "<td>"+currGame.name+"</td>";
          tableHtml += "<td>"+currGame.wins+"</td>";
          tableHtml += "<td>"+currGame.elo+"</td>";
          tableHtml += "<td>"+currGame.rank+"</td>";
        tableHtml += "</tr>";
      }
    }
    $('#pingpongScoresTable').html(tableHtml);
  // END PINGPONG SCORES INFO

  // SET GAMES PLAYED INFO
    var tableHtml = "";
    if(typeof gamesPlayedInfo.error !== 'undefined'){
      tableHtml += "<tr>";
        tableHtml += "<td></td>";
        tableHtml += "<td>"+gamesPlayedInfo.error+"</td>";
        tableHtml += "<td></td>";
        tableHtml += "<td></td>";
        tableHtml += "<td></td>";
        tableHtml += "<td></td>";
        tableHtml += "<td></td>";
      tableHtml += "</tr>";
    } else {
      for(var i = 0; i < gamesPlayedInfo.length; i++){
        var currGame = gamesPlayedInfo[i];
        tableHtml += "<tr>";
          tableHtml += "<td>"+((currGame.gameType == 1)?'Foosball':'Ping Pong')+"</td>";
          tableHtml += "<td>"+((currGame.p1Name != '')?currGame.p1Name:'__')+"</td>";
          tableHtml += "<td>"+((currGame.p2Name != '')?currGame.p2Name:'__')+"</td>";
          tableHtml += "<td>"+((currGame.team1Won == 1)?'Win':'Loss')+"</td>";
          tableHtml += "<td>"+((currGame.p3Name != '')?currGame.p3Name:'__')+"</td>";
          tableHtml += "<td>"+((currGame.p4Name != '')?currGame.p4Name:'__')+"</td>";
          tableHtml += "<td>"+((currGame.team2Won == 1)?'Win':'Loss')+"</td>";
        tableHtml += "</tr>";
      }
    }
    $('#previousGamesTable').html(tableHtml);
  // END GAMES PLAYED INFO

</script>

<?php 
    include 'template/footer.php';
?>