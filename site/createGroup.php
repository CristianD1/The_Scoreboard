
<?php 
    include 'template/header.php';

    include 'php/getPlayers.php'
?>  

<!-- Group [create] functionality -->

<div id="pageContent">

  <div id="createGroup" class="menuItemContent">
    <div class="row">

    <!-- option to select a teammate or create a joinable team -->

      <form id="createGroupForm" class="col s12">
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
              <option value="0" disabled selected="selected">Choose the dood</option>
              <option value="1">Option 1</option>
              <option value="2">Option 2</option>
              <option value="3">Option 3</option>
            </select>
          </div>
        </div>

        <center><a onclick="validateForm('createGroup')" class="waves-effect waves-light btn">Submit</a></center>
      </form>

    </div>
    <h5 id="addTeamSuccess" style="color:green;"></h5>
  </div>

</div>

<script>

  var playerListHTML = '';

  var playerList = JSON.parse(<?php echo $retVal ?>);
  console.log(playerList);

  playerListHTML += '<select>';
  playerListHTML += '<option value="0" disabled selected>Choose the guy that will probably carry the team. (teammate)</option>';
  for(var i in playerList){
    var person = playerList[i];
    playerListHTML += '<option value='+person['playerID']+'>'+person['playerName']+'</option>';
  }
  playerListHTML += '</select>';

  $('#teamMemberList').html(playerListHTML);

  rebindSelect();


  var personID = 0;
  $('#teamMemberList').on('change', 'select', function() {
    var personName = '';
    $('#teamMemberList').each(function(){
      var list = $(this).find('li');
      list.each(function(){
        var className = $(this).attr('class');
        if(className.indexOf('active') >= 0){
          personName = $(this)[0].innerText;
        }
      })
    });
    $('#teamMemberList').each(function(){
      var list = $(this).find('select');
      list.each(function(){
        $(this).find('option').each(function(){
          var theStr = $(this).html().toString();
          if(theStr.toString().trim() == personName.toString().trim()){
            personID = $(this).val();
          }
        })
      })
    });
  });


  // ez pz form validation. 
  // Feel free to delete this, the php file will still reject you.
  function validateForm(formName) { 
    var teamName = $('#create_teamName').val();
    if ( formName === 'createGroup' ) {
      //if ( teamName == "" ) {
      //  Materialize.toast("Team name pls.", 2000, 'rounded #ff5722 deep-orange');
      //} else if ( personID <= 0 ) {
      //  Materialize.toast("Calm down Kirito, pick a teammate.", 2000, 'rounded #ff5722 deep-orange');
      //} else {
        submitGroup(teamName, personID);
      //}
    }
  }

  function submitGroup(teamName, teammateID){
    $.ajax({
      method: 'post',
      url: 'php/createGroup.php',
      data: {
        teamName: teamName,
        teammateID: teammateID
      },
      success: function(data){
        console.log(data)
        data = JSON.parse(data);
        if(data.error){
          Materialize.toast(data.error, 2000, 'rounded #ff5722 deep-orange');
        }else if(data.success){
          Materialize.toast(data.success, 2000, 'rounded #64dd17 light-green');
        }
      }
    })
  }

</script>

<?php 
    include 'template/footer.php';
?>