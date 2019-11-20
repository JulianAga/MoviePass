<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
 <title>nav_moviepass</title>
 <!-- CSS para la barra nav -->
 
<link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="../../Views/css/header2.css"><!-- ARCHIVO CSS-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 

 <!-- Bootstrap logout CSS -->


 <!-- Bootstrap CSS -->
  
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
      <li class="nav-item"><a href="#cartelera" class="nav-link">Cartelera</a></li>
      <li class="nav-item"><a href="#" class="nav-link">Proximos Estrenos</a></li>
      <!-- BOTON DESPLEGABLE-->     
      <li class="nav-item dropdown">
        <a data-toggle="dropdown" class="nav-link dropdown-toggle" href="#">Localidad<b class="caret"></b></a>
        <!-- ITEMS DESPLEGABLES-->
        <ul class="dropdown-menu">          
          <li><a href="#" class="dropdown-item">Mar del Plata</a></li>
          <li><a href="#" class="dropdown-item">Pinamar</a></li>
          <li><a href="#" class="dropdown-item">Devoto</a></li>
          <li><a href="#" class="dropdown-item">Balcarce</a></li>
        </ul>
      </li>
      
    </ul>
    <!-- BUSCADOR-->
    <form class="navbar-form form-inline">
      <div class="input-group search-box">                
        <input type="text" id="search" class="form-control" placeholder="Buscar..">
        <span class="input-group-addon"><i class="material-icons">&#xE8B6;</i></span>
      </div>
    </form>
    
    
    <ul class="nav navbar-nav navbar-right ml-auto"> <!--inicio boton cuenta logueada -->
    <!-- BOTON cuenta logueada  -->
      <li class="nav-item">
      </li>
       <!-- BOTON Usuario LOGUEADO -->
       <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <span class="glyphicon glyphicon-user"></span> 
            <strong>Usuario</strong>
          <span class="glyphicon glyphicon-chevron-down"></span>
        </a>
        <!-- menu desplegable -->
        <ul class="dropdown-menu form-wrapper">         
          <li>
            <p class="hint-text"><strong> usuario@gmail.com</strong></p>
            <br>
            <form action="<?= ROOT_VIEW ?>/Login/" method="post"><!-- FALTA FUNCIONALIDAD-->
              <input type="submit" class="btn btn-primary btn-block" value="Mi Cuenta">
            </form>
            <div class="or-seperator"></div>
            <br>
            <form action="<?= ROOT_VIEW ?>/Login/cerrarSesion" method="post">
              <input type="submit" class="btn btn-danger btn-block" value="Cerrar Sesion">
            </form>
          </li>
        </ul>
      </li>
    </ul> <!-- fin botones login register-->
    
  </div>
</nav>
   
      
</body>
<!-- JS-->
<script type="text/javascript">
  // Prevent dropdown menu from closing when click inside the form
  $(document).on("click", ".navbar-right .dropdown-menu", function(e){
    e.stopPropagation();
  });
</script>
</html>