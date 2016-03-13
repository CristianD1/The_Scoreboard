
<?php 
    include 'template/header.php';


    include 'php/getLeaderboard.php';
?> 

<script>

var retList = JSON.parse(<?php echo($retVal); ?>);

</script>



<!-- This is the main page that only shows the scoreboard and ranking -->

<div id="pageContent">

  <div class="row">
    <div class="col s12">
      
      <center><h3>Global Stats</h3></center>

      <ul class="collapsible" data-collapsible="accordion">


        <li>
          <div class="collapsible-header"><i class="material-icons">supervisor_account</i>Teams</div>
          <div class="collapsible-body">
            <table class="striped">
              <thead>
                <tr>
                  <th data-field="id">Team Name</th>
                  <th data-field="elo">ELO</th>
                  <th data-field="wins">Wins</th>
                  <th data-field="mPlayed">Games Played</th>
                  <th data-field="players">Players</th> 
                  <th data-field="aboutTeam">About Team</th>
                </tr>
              </thead>
              <tbody id="teamStatsTbody">
                <tr>
                  <td>Placeholder</td>
                </tr>
              </tbody>
            </table>
          </div>
        </li>


        <li>
          <div class="collapsible-header"><i class="material-icons">view_agenda</i>Recent Matches</div>
          <div class="collapsible-body">
            <table class="striped">
              <thead>
                <tr>
                  <th data-field="t1Name">Team 1 Name</th>
                  <th data-field="t1Score">Team 1 Score</th> 
                  <th data-field="t2Name">Team 2 Name</th>
                  <th data-field="t2Score">Team 2 Score</th>
                </tr>
              </thead>
              <tbody id="recentMatchesTbody">
                <tr>
                  <td>Placeholder</td>
                </tr>
              </tbody>
            </table>
          </div>
        </li>


      </ul>

    </div> <!-- col -->
  </div> <!-- row -->

</div> <!-- container -->


<?php 
    include 'template/footer.php';
?>