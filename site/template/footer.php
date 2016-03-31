

    <!-- FOOTER MENU BUTTON -->
    
    <div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
      <a class="btn-floating btn-large red">
        <i class="large material-icons">mode_edit</i>
      </a>
      <ul>
        <li><a href="accountContent.php" class="btn-floating red"><i class="material-icons">perm_identity</i></a></li>
        <li><a href="index.php" class="btn-floating yellow darken-1"><i class="material-icons">list</i></a></li>
        <?php 
          if ( $accountISSET == true ) {
        ?>
            <li><a href="createGroup.php" class="btn-floating blue"><i class="material-icons">library_add</i></a></li>
        <?php
          }
        ?>
      </ul>
    </div>

  </body>

</html>