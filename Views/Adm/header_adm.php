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

<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<link rel="stylesheet" href="/MoviePass/Views/css/header2.css">

<!-- SWEET ALERT -->
<script src="sweetalert2.all.min.js"></script>
<!-- Optional: include a polyfill for ES6 Promises for IE11 -->
<script src="https://cdn.jsdelivr.net/npm/promise-polyfill"></script>

<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<!-- SWEET ALERT -->


</head> 
<body>
<nav class="navbar navbar-default navbar-expand-lg navbar-light">
  <div class="navbar-header d-flex col">
    <a class="navbar-brand" href="<?= ROOT_VIEW ?>/Nav/index">Movie<b style="color: #ff55a5;">Pass</b></a>     
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
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Nav/adm_cine"  class="nav-link">ADM Cines</a></li>
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Adm_Peliculas/metodo" class="nav-link">ADM Peliculas</a></li>
      <li class="nav-item"><a href="<?= ROOT_VIEW ?>/Adm_Peliculas/recibirPeliculas" class="nav-link">Actualizar Peliculas API</a></li> 
    </ul>
    
    <ul class="nav navbar-nav navbar-right ml-auto">
      

       <?php   if( isset($_SESSION['Login']) ) {  ?> 
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <strong>
                <?php echo $cliente->getNombre(); ?> <?php echo $cliente->getApellido();?>
              </strong>
              <b class="caret"></b>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <div class="navbarr-content">
                        <div class="row">
                            <div class="col-md-5">
                                <img src="http://placehold.it/120x120"
                                    alt="Alternate Text" class="img-responsive" />
                                <p class="text-center small">
                                    <a href="#">Cambiar</a>
                                </p>
                            </div>
                            <div class="col-md-7">
                                <span>
                                  <strong style="margin:auto; display:table;">
                                    <?php echo $cliente->getNombre(); ?> <?php echo $cliente->getApellido();?>
                                  </strong>
                                </span>
                                <p class="">
                                  <strong style="margin:auto; display:table;">
                                    <?php echo $cuenta_logueada->getEmail(); ?> 
                                  </strong>   
                                </p>
                                <div class="divider">
                                </div>
                                <form action="<?= ROOT_VIEW ?>//" method="post">
                                    <input type="submit" class="btn btn-info btn-block btn-md " value="Mi Perfil">
                                  </form>
                            </div>
                        </div>
                    </div>
                    <div class="navbarr-footer">
                        <div class="navbarr-footer-content">
                            <div class="row">
                                <div class="col-md-6">
                                  <form action="<?= ROOT_VIEW ?>//" method="post">
                                    <input type="submit" class="btn btn-primary btn-md pull-left" value="Crear Administrador">
                                  </form>
                                </div>
                                <div class="col-md-6">
                                  <form action="<?= ROOT_VIEW ?>/Login/cerrarSesion" method="post">
                                    <input type="submit" class="btn btn-danger btn-md pull-right" value="Cerrar Sesion">
                                  </form>
                                </div>
                            </div>
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



/*------------------------------------------dropdown menu---------------------------*/
        /* Special class on .container surrounding .navbar, used for positioning it into place. */
.navbarr-wrapperr {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  z-index: 20;
  margin-top: 20px;
}

/* Flip around the padding for proper display in narrow viewports */
.navbarr-wrapperr .containerr {
  padding-left: 0;
  padding-right: 0;
}
.navbarr-wrapperr .navbarr {
  padding-left: 15px;
  padding-right: 15px;
}

.navbarr-content
{
    width:320px;
    padding: 15px;
    padding-bottom:0px;
}
.navbarr-content:before, .navbarr-content:after
{
    display: table;
    content: "";
    line-height: 0;
}
.navbarr-nav.navbarr-right:last-child {
margin-right: 15px !important;
}
.navbarr-footer 
{
    background-color:#DDD;
}
.navbarr-footer-content { padding:15px 15px 15px 15px; }
.dropdown-menu {
padding: 0px;
overflow: hidden;
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