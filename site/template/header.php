
<?php

$accountISSET = $_SESSION['authenticated']; 

?>


<!DOCTYPE html>

<html>

    <head>
      <title>Scoreboard</title>

        <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="lib/materialize/css/materialize.min.css">
        <link rel="stylesheet" type="text/css" href="style/general.css">

        <script type="text/javascript" src="lib/jquery-2.2.1.min.js"></script>
        <script type="text/javascript" src="lib/materialize/js/materialize.min.js"></script>

        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>


    <script> // HELPER JS FUNCTIONS 
    function getCookie(name) {
      var value = "; " + document.cookie;
      var parts = value.split("; " + name + "=");
      if (parts.length == 2) return parts.pop().split(";").shift();
    }

    // rebinding
    function rebindSelect(){
      $('select').material_select('destroy');
      $('select').material_select();
    }

    function clearListCookies(){   
        var cookies = document.cookie.split(";");
        for (var i = 0; i < cookies.length; i++){   
            var spcook =  cookies[i].split("=");
            deleteCookie(spcook[0]);
        }
        function deleteCookie(cookiename){
            var d = new Date();
            d.setDate(d.getDate() - 1);
            var expires = ";expires="+d;
            var name=cookiename;
            //alert(name);
            var value="";
            document.cookie = name + "=" + value + expires + "; path=/acc/html";                    
        }
    }

    $(function(){
        rebindSelect();
    })
    </script>


    <body>

        <!-- NAV HEADER -->

        <nav>
          <div class="nav-wrapper">
            <a href="#!" class="brand-logo center">The Scoreboard</a>
            <!--ul class="right">
              <li><a><i class="material-icons">view_module</i></a></li>
            </ul-->
          </div>
        </nav>
