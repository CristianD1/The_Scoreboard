
<?php 
    include 'template/header.php';
?>  

<!-- Show personal info (including joined groups) option to record a game -->

<div id="pageContent">


  <?php 
    if ( $accountISSET == false ){ // Show login page
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

              <form id="loginForm" class="col s12"> <!-- sign in -->
                <div class="row">
                  <div class="input-field col s12">
                    <i class="material-icons prefix">lock</i>
                    <input id="login_securityCode" type="text" class="validate">
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
    } else { // Show account page
  ?>





  <?php
    }
  ?>
    

</div>


<?php 
    include 'template/footer.php';
?>