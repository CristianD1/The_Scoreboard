
<?php 
    include 'template/header.php';
?>  
<!-- Show personal info (including joined groups) option to record a game -->

<div id="pageContent">


  <?php 
    if ( $accountISSET == false ) { // Show login page
  ?>


    <div id="createAccount" class="menuItemContent">
      <center><h4>Account Login/Signup</h4></center>
      <ul class="collapsible" data-collapsible="accordion">
        <li>
          <div class="collapsible-header"><i class="material-icons">perm_identity</i>Create Account</div>
          <div class="collapsible-body">
            <div class="row">

              <form id="registerAccountForm" class="col s12" action="php/registerAccount.php" method="POST"> <!-- Register account -->
                <div class="row">
                  <div class="input-field col s6">
                    <i class="material-icons prefix">account_circle</i>
                    <input name="firstName" id="firstName" type="text" class="validate">
                    <label for="firstName">First Name (*)</label>
                  </div>
                  <div class="input-field col s6">
                    <input name="lastName" id="lastName" type="text" class="validate">
                    <label for="lastName">Last Name (*)</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">note_add</i>
                    <input name="aboutMe" id="aboutMe" type="text" class="validate">
                    <label for="aboutMe">About me (optional)</label>
                  </div>
                </div>
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input name="securityCode" id="securityCode" type="text" class="validate">
                    <label for="securityCode">Password (*)</label>
                  </div>
                </div>
                <center><a onclick="validateForm('register')" class="waves-effect waves-light btn">Submit</a></center>
              </form>

            </div>
          </div>
        </li>
        <li>
          <div class="collapsible-header"><i class="material-icons">perm_identity</i>Sign In</div>
          <div class="collapsible-body">
            <div class="row">

              <form id="loginForm" class="col s12" action='php/signIn.php' method="post"> <!-- sign in -->
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="login_securityCode" type="text" class="validate" name="securityCode">
                    <label for="login_securityCode">Password</label>
                  </div>
                </div>
                <center><a onclick="validateForm('signIn')" class="waves-effect waves-light btn">Submit</a></center>
              </form>

            </div>
          </div>
          </div>
      </ul>
      <h4 id="accountError" style="color: red;"></h4>
    </div>

    <script>

      $(function(){
        // bleh. warnings and stuff.
        Materialize.toast("If you got sent back here, try a different password.", 2000, 'rounded #ff5722 deep-orange');
      })

      // ez pz form validation. 
      // Feel free to delete this, the php file will still reject you.
      function validateForm(formName) { 
        if ( formName === 'register' ) {
          if ( $('#firstName').val() == "" || $('#lastName').val() == "" || $('#securityCode').val() == "" ) {
            Materialize.toast("uh... you didn't fill in the form...", 2000, 'rounded #ff5722 deep-orange');
          }else{
            $('#registerAccountForm').submit();
          }
        } else if ( formName === 'signIn' ) {
          if ( $('#login_securityCode').val() == "" ) {
            Materialize.toast('Sign in with no password... Funny.', 2000, 'rounded #ff5722 deep-orange');
          }else{
            $('#loginForm').submit();
          }
        }
      }

    </script>

  <?php
    } else if ( $accountISSET == true ) { // Show account page

      include 'php/userAccountInfo.php'; // get rankings and groups
  ?>

    <div id="accountProfile" class="menuItemContent">
      <div class="row">
        <center><h3 id="profile_accountName">My Account</h3></center>
        <h4 id="profile_aboutMe">About Me</h4>

        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header"><i class="material-icons">perm_identity</i>Foosball Scores</div>
            <div class="collapsible-body">
              <div>

                <table class="responsive-table highlight" style="float:left !important;">
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

                <table class="responsive-table highlight" style="float:left !important;">
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

                <table class="responsive-table highlight" style="float:left !important;">
                  <thead>
                    <tr>
                        <th data-field="gameType">Game Type</th>
                        <th data-field="p1N">Player 1 Name</th>
                        <th data-field="p2N">Player 2 Name</th>
                        <th data-field="team1Score">Team 1 Score</th>
                        <th data-field="p3N">Player 3 Name</th>
                        <th data-field="p4N">Player 4 Name</th>
                        <th data-field="team2Score">Team 2 Score</th>
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

      </div>
    </div>

    <!-- The matchup table -->

    <div class="row">
      <div class="col s12">

        <center>
          <h5>Record Game</h5>
          <div class="matchupBoard"> <!-- the board -->
            <div class="row">
              <div class="col s5">
                <div id="team1btn" class="teamBtn btn-flat">Team 1</div>
              </div>
              <div class="col s7">
                <div class="row">
                  <div class="col s12">
                    <div id="p1t1" class="player btn-flat">Player 1</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <div id="p2t1" class="player btn-flat">Player 2</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="separator"></div>
            <div class="row">
              <div class="col s5">
                <div id="team2btn" class="teamBtn btn-flat">Team 2</div>
              </div>
              <div class="col s7">
                <div class="row">
                  <div class="col s12">
                    <div id="p1t2" class="player btn-flat">Player 1</div>
                  </div>
                </div>
                <div class="row">
                  <div class="col s12">
                    <div id="p2t2" class="player btn-flat">Player 2</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="submitBtn waves-effect waves-light btn-large #efebe9 brown lighten-5">Submit</div>
            </div> 
          </div>
        </center>

      </div>
    </div>

    <script>

    // Returns:
    //  $playerInfoRetval
    //  $gamesPlayedRetVal
    //  $foosballRetVal
    //  $pingpongRetVal

    var basicUserInfo = JSON.parse(<?php echo $playerInfoRetval ?>);
    var pingpongInfo = JSON.parse(<?php echo $pingpongRetVal ?>);
    var foosballInfo = JSON.parse(<?php echo $foosballRetVal ?>);
    var gamesPlayedInfo = JSON.parse(<?php echo $gamesPlayedRetVal ?>);

    // Global user info
    var username = basicUserInfo.firstName + ' ' + basicUserInfo.lastName;

    // SET BASIC USER INFO
      $('#profile_accountName').html(username);
      $('#profile_aboutMe').html(basicUserInfo.aboutMe);
    // END BASIC USER INFO

    // SET FOOSBALL SCORES INFO
      var tableHtml = "";
      if(typeof foosballInfo.error !== 'undefined'){
        tableHtml += "<tr>";
          tableHtml += "<td>"+username+"</td>";
          tableHtml += "<td>"+foosballInfo.error+"</td>";
          tableHtml += "<td></td>";
          tableHtml += "<td></td>";
        tableHtml += "</tr>";
      } else {
        for(var i = 0; i < foosballInfo.length; i++){
          tableHtml += "<tr>";
            tableHtml += "<td>"+username+"</td>";
            tableHtml += "<td>"+foosballInfo.wins+"</td>";
            tableHtml += "<td>"+foosballInfo.elo+"</td>";
            tableHtml += "<td>"+foosballInfo.rank+"</td>";
          tableHtml += "</tr>";
        }
      }
      $('#foosballScoresTable').html(tableHtml);
    // END FOOSBALL SCORES INFO

    // SET PINGPONG SCORES INFO
      var tableHtml = "";
      if(typeof pingpongInfo.error !== 'undefined'){
        tableHtml += "<tr>";
          tableHtml += "<td>"+username+"</td>";
          tableHtml += "<td>"+pingpongInfo.error+"</td>";
          tableHtml += "<td></td>";
          tableHtml += "<td></td>";
        tableHtml += "</tr>";
      } else {
        for(var i = 0; i < pingpongInfo.length; i++){
          tableHtml += "<tr>";
            tableHtml += "<td>"+username+"</td>";
            tableHtml += "<td>"+pingpongInfo.wins+"</td>";
            tableHtml += "<td>"+pingpongInfo.elo+"</td>";
            tableHtml += "<td>"+pingpongInfo.rank+"</td>";
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
          tableHtml += "<tr>";
            tableHtml += "<td>"+gamesPlayedInfo.gameType+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.p1Name+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.p2Name+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.team1Score+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.p3Name+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.p4Name+"</td>";
            tableHtml += "<td>"+gamesPlayedInfo.team2Score+"</td>";
          tableHtml += "</tr>";
        }
      }
      $('#previousGamesTable').html(tableHtml);
    // END GAMES PLAYED INFO


    $('.collapsible').collapsible();

    </script>


  <?php
    }
  ?>
    

</div>


<?php 
    include 'template/footer.php';
?>
