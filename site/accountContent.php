
<?php 
    include 'template/header.php';
?>  

<!-- Show personal info (including joined groups) option to record a game -->

<div id="pageContent">


  <?php 
    if ( $accountISSET == false ){ // Show login page
  ?>


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