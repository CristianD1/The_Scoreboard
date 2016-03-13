
<?php 
    include 'template/header.php';
?>  

<!-- Group [create] functionality -->

<div id="pageContent">

  <div id="createGroup" class="menuItemContent">
    <div class="row">

      <form id="createGroupForm" class="col s12" action="createGroup">
        <center><h3>Create Group</h3></center>
        <div class="row">
          <div class="input-field col s12">
            <i class="material-icons prefix">library_books</i>
            <input id="create_teamName" type="text" class="validate">
            <label for="create_teamName">Team Name</label>
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