<?php namespace Views;


  

?>
<?php

if( isset($_SESSION['Login'])){
  $cuenta_logueada=$_SESSION['Login'];
  $cuenta_logueada->getEmail();
}
if( isset($_SESSION['Cliente_Logueado'])){
  $cliente=$_SESSION['Cliente_Logueado'];
  
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>

<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>





</head> 
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
  <div class="navbar-header d-flex col">
    <a class="navbar-brand" href="#">Movie<b>Pass</b></a>     
    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler ml-auto">
      <span class="navbar-toggler-icon"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
  </div>
  <!-- BARRA DE NAVEGACION -->
  <div id="navbarCollapse" class="collapse navbar-collapse justify-content-start">
    <ul class="nav navbar-nav">
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Adm_Peliculas/adm_cines" class="nav-link">ADM Cines</a></li>
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Adm_Peliculas/metodo" class="nav-link">ADM Peliculas</a></li>
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Adm_Peliculas/recibirPeliculas" class="nav-link">Actualizar Peliculas API</a></li> 
    </ul>
    
    <ul class="nav navbar-nav navbar-right ml-auto">
      

       <?php   if( isset($_SESSION['Login']) ) {  ?> 
        <ul class="nav navbar-nav navbar-right">
          <div class="user">
            <p class="user-name">Andrew Sellenrick<span class="user-menu"></span></p>
            <div class="user-nav">
              <ul>
                <form action="<?= ROOT_VIEW ?>/asd/asd" method="post">
                  <li>Mi Perfil<span class="user-nav-settings"></span></li>
                </form>
                <form action="<?= ROOT_VIEW ?>/asd/asd" method="post">
                  <li>Estadisticas<span class="user-nav-stats"></span></li>
                </form>
                <form action="<?= ROOT_VIEW ?>/Login/cerrarSesion" method="post">
                  <li>Cerrar Sesion<span class="user-nav-signout"></span></li>
                </form>
              </ul>
            </div>
          </div>
      
        
    </ul>
    <?php  } ?> 
    </ul>
        
      
      
  </div>
</nav>
</body>
<!-- CSS -->
<style>
  .glyphicon .glyphicon-user{
            font-size:35px;
  }
  .boton_cancelar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color: #BDB7B7;
            border-radius: 15px;
            border: 3px double #000102  ;
            float: left;
        }
        .boton_cancelar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }
        .boton_modificar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color:#376AE8;
            border-radius: 15px;
            border: 3px double #000102  ;
        }
        .boton_modificar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }
        .boton_eliminar{
            text-decoration: none;
            padding: 5px;
            padding-left: 10px;
            padding-right: 10px;
            font-family: helvetica;
            font-weight: 300;
            font-size: 15px;
            font-style: bold;
            color: #ECEEF4;
            background-color:#F00606;
            border-radius: 15px;
            border: 3px double #000102;
            float: right;
        }
        .boton_eliminar:hover{
            color: #1883ba;
            background-color: #ffffff;
        }



/*------------------------------------------dropdown menu---------------------------*/
        *{box-sizing:border-box;}



        .user{background:#fff; border-radius:4px; width:225px; height:50px; padding:15px;box-shadow:rgba(0,0,0,.3) 0px 2px 4px}


        .user:hover .user-nav {
          visibility:visible;
          opacity:1;
          top:2px
        }

        .user-name{ font-size:1.2rem; position:relative;}

        .user-nav{position:relative; visibility:hidden; opacity:0;-webkit-transition:all .15s; top:0;-webkit-transform: translate3d(0, 0, 0)}

        .user-nav ul{position:absolute; width:225px;background:#fff; left:-15px; color:#777; top:25px;border-radius:4px;box-shadow:rgba(0,0,0,.3) 0px 2px 4px;}

        .user-nav ul:after{
          content:"";
          display:block;
          width: 0; 
          height: 0; 
          border-left: 14px solid transparent;
          border-right: 14px solid transparent;
          border-bottom: 14px solid #fff;
          top: -13px;
          right: 20px;
          position:absolute;
        }

        .user-nav ul li {display:block; padding:1px; text-transform:uppercase; position:relative;
        }

        .user-nav ul li:first-child{border-radius:4px 4px 0 0}
        .user-nav ul li:last-child{border-radius:0 0 4px 4px}


        .user-nav ul li:hover{background:#F9ADA0; color:#fff;-webkit-transition:all .15s;}

        .user-nav ul li:hover span{background-position-x:-20px;}

        .user-nav-settings{
           background-position-y:-20px;
        }

        .user-nav-stats{
           background-position-y:-40px;
        }

        .user-nav-messages{
           background-position-y:-60px;
        }

        .user-nav-signout{
           background-position-y:-80px;
        }

        .user-nav ul li span{
           position:absolute;
          right:22px;
          top:12px;
           display:block;
           height:20px;
          width:20px;
          background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAABkCAYAAAD0ZHJ6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTMxNzU1REI0M0MzMTFFMjkyMjM4MjA4NDhFMzI0MUYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTMxNzU1REM0M0MzMTFFMjkyMjM4MjA4NDhFMzI0MUYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5MzE3NTVEOTQzQzMxMUUyOTIyMzgyMDg0OEUzMjQxRiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5MzE3NTVEQTQzQzMxMUUyOTIyMzgyMDg0OEUzMjQxRiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pi7z1YAAAAlvSURBVHja7FsLkE5l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); background-repeat:no-repeat
        }

        .user-menu{
           position:absolute;
          right:8px;
          top:0;
           display:block;
           height:20px;
          width:20px;
          background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACgAAABkCAYAAAD0ZHJ6AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OTMxNzU1REI0M0MzMTFFMjkyMjM4MjA4NDhFMzI0MUYiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OTMxNzU1REM0M0MzMTFFMjkyMjM4MjA4NDhFMzI0MUYiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5MzE3NTVEOTQzQzMxMUUyOTIyMzgyMDg0OEUzMjQxRiIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5MzE3NTVEQTQzQzMxMUUyOTIyMzgyMDg0OEUzMjQxRiIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pi7z1YAAAAlvSURBVHja7FsLkE5l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); background-repeat:no-repeat
        }
     
  
</style>
<!-- JS-->
<script type="text/javascript">
  // Prevent dropdown menu from closing when click inside the form
  $(document).on("click", ".navbar-right .dropdown-menu", function(e){
    e.stopPropagation();
  });
</script>
</html>  