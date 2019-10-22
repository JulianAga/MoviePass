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
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!--<span class="glyphicon glyphicon-user barra"></span> -->
                        <strong><?php echo $cuenta_logueada->getEmail(); ?></strong>
                        <span class="glyphicon glyphicon-chevron-down"></span>
                    </a>
                    <ul class="dropdown-menu form-wrapper">
                        <li>
                            <div class="navbar-login">
                                <div>
                                    <div>
                                        <p class="text-center">
                                            <span class="glyphicon glyphicon-user barra"></span>
                                        </p>
                                    </div>
                                    <div>
                                        <p class="text-center">
                                          <strong>
                                            <h4><?php echo $cliente->getNombre(); ?> <?php echo $cliente->getApellido();?></h4>
                                          </strong>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <div class="navbar-login navbar-login-session">
                                <div>
                                  <form action="<?= ROOT_VIEW ?>/Login/cerrarSesion" method="post">
                                    <div>
                                        
                                            <input type="submit" class="boton_eliminar" value="Cerrar Sesion">
                                        
                                    </div>
                                  </form>
                                  <form action="<?= ROOT_VIEW ?>/asd/asd" method="post">
                                        
                                            <input type="submit" class="boton_modificar" value="Mi Cuenta">
                                        
                                  </form>
                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
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
  
</style>
<!-- JS-->
<script type="text/javascript">
  // Prevent dropdown menu from closing when click inside the form
  $(document).on("click", ".navbar-right .dropdown-menu", function(e){
    e.stopPropagation();
  });
</script>
</html>  