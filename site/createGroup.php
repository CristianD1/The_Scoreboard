
<?php 
    include 'template/header.php';

    include 'php/getPlayers.php'
?>  

<!-- Group [create] functionality -->

<div id="pageContent">

  <div id="createGroup" class="menuItemContent">
    <div class="row">

    <!-- option to select a teammate or create a joinable team -->

      <form id="createGroupForm" class="col s12" action="createGroup">
        <center><h3>Create Group</h3></center>
        
        <div class="row"> <!-- enter team name -->
          <div class="input-field col s12">
            <i class="material-icons prefix">library_books</i>
            <input id="create_teamName" type="text" class="validate">
            <label for="create_teamName">Team Name</label>
          </div>
        </div>

        <div class="row"> <!-- choose teammate -->
          <div class="input-field col s12" id="teamMemberList">
            <select>
              <option value="0" disabled selected>Choose the du</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
            <label>Team Members</label>
          </div>
        </div>

        <center><a onclick="validateForm('createGroup')" class="waves-effect waves-light btn">Submit</a></center>
      </form>

    </div>
    <h5 id="addTeamSuccess" style="color:green;"></h5>
  </div>

</div>

<script>
  // ez pz form validation. 
  // Feel free to delete this, the php file will still reject you.
  function validateForm(formName) { 
    if ( formName === 'createGroup' ) {
      if ( $('#create_teamName').val() == "" ) {
        Materialize.toast("Team name pls.", 2000, 'rounded #ff5722 deep-orange');
      } else {
        $('#createGroupForm').submit();
      }
    }
  }
</script>

<?php 
    include 'template/footer.php';
?>