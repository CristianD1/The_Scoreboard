
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

    <script>

      var basicUserInfo = JSON.parse(<?php echo $accountInfo ?>);

      $(function(){
        // set up basic information
        $('#profile_accountName').html(basicUserInfo.firstName + ', ' + basicUserInfo.lastName);
        $('#profile_aboutMe').html(basicUserInfo.aboutMe);

        var h = $(window).height();
        var scale = 0.75;
        $(".matchupBoard").css('height', h * scale);

      });

    </script>


    <!-- The matchup table -->

    <div class="row">
      <div class="col s12">

        <center><div class="matchupBoard"> <!-- the board -->
        &nbsp;
        </div></center>

      </div>
    </div>


    <div id="accountProfile" class="menuItemContent">
      <div class="row">
        <center><h3 id="profile_accountName">My Account</h3></center>
        <h4 id="profile_aboutMe">About Me</h4>
        <ul class="collapsible" data-collapsible="accordion">
          <li>
            <div class="collapsible-header"><i class="material-icons">perm_identity</i>My Info</div>
            <div class="collapsible-body">
              <div id="account_groups">

                <table>
                  <thead>
                    <tr>
                        <th data-field="id">Name</th>
                        <th data-field="name">Item Name</th>
                        <th data-field="price">Item Price</th>
                    </tr>
                  </thead>

                  <tbody>
                    <tr>
                      <td>Alvin</td>
                      <td>Eclair</td>
                      <td>$0.87</td>
                    </tr>
                    <tr>
                      <td>Alan</td>
                      <td>Jellybean</td>
                      <td>$3.76</td>
                    </tr>
                    <tr>
                      <td>Jonathan</td>
                      <td>Lollipop</td>
                      <td>$7.00</td>
                    </tr>
                  </tbody>
                </table>
            
              </div>
            </div>
          </li>


          <!--li>
            <div class="collapsible-header"><i class="material-icons">games</i>Record Game</div>
            <div class="collapsible-body">
              <div class="row">
                <div id="matchupYourTeam" class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choose Your Team</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                  </select>
                  <label>The matchup</label>
                </div>
                <div id="matchupOpponent" class="input-field col s6">
                  <select>
                    <option value="" disabled selected>Choose Opponent</option>
                    <option value="1">Option 1</option>
                    <option value="2">Option 2</option>
                    <option value="3">Option 3</option>
                  </select>
                  <label>The matchup</label>
                </div>
              </div>
              <div class="row">
                <div id="matchupYourScore" class="input-field col s6">
                  <select>
                    <script>
                      var opts = "<select><option value='' disabled selected>Your Score</option>";
                      for(var i = 0; i <= 10; i++){
                        opts += "<option value='"+i+"'>"+i+"</option>";
                      }
                      $('#matchupYourScore').html(opts+"</select>");
                      rebindSelect();
                    </script>
                  </select>
                </div>
                <div id="matchupOpponentScore" class="input-field col s6">
                  <select>
                    <script>
                      var opts = "<select><option value='' disabled selected>Opponents Score</option>";
                      for(var i = 0; i <= 10; i++){
                        opts += "<option value='"+i+"'>"+i+"</option>";
                      }
                      $('#matchupOpponentScore').html(opts+"</select>");
                      rebindSelect();
                    </script>
                  </select>
                </div>
              </div>
              <marquee><h4 id='recordMatchError' style='color: red;'></h4></marquee>
              <center><a onclick="recordMatch()" class="waves-effect waves-light btn">Submit</a></center>
            </div>
          </li-->
        </ul>
      </div>
    </div>


  <?php
    }
  ?>
    

</div>


<?php 
    include 'template/footer.php';
?>
