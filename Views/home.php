<?php namespace Views;


include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
include_once "api/api_now.php";// incluyo la API de peliculas actuales en cartelera

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  

  <!-- <link rel="stylesheet" href="Vistas/css/estilos.css"> -->
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="http://necolas.github.io/normalize.css/3.0.1/normalize.css">
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="Views/js/main.js"></script>
  <script src="Views/js/busqueda.js"></script>
  <link rel="stylesheet" href="<?= CSS_PATH ?>header2.css"><!-- ARCHIVO CSS-->

<title>MoviePass</title>

  
  <?php include_once(VIEWS_PATH."header.php"); ?>
</head>


<body class="body_parallax"> <!-- fondo_body/body_parallax es una clase css donbde esta el archivo de la imagen de fondo y otras configuraciones del fondo, esta al final de home.php en la secion de <style>-->

<br> <!-- espacios en blanco -->
<br>
  <!-- INICIO CARTELERA   -->   
  <section class="text-black" id="cartelera"> 
    <div class="container">    
      <div>
          <nav class="li_borde_trasparente">
            <h1 class="text-center" style="color:white;">Cartelera</h1>
          </nav>
      </div>
      <br>
      <div class="row">
        <?php
        if ($nowplaying !=null)//si no esta null la cartelera que llega desde movie DB, la recorro
        {
        foreach ($nowplaying->results as $p) {?> <!-- recorro la lista de peliculas actuales y las muestro-->
          <div class="p-4 align-self-center col-md-3">
            <div class="card background">
              <form action="<?= ROOT_VIEW ?>/DetallePelicula/verPelicula" method="post" enctype="multipart/form-data"><!-- ENVIO FORMULARIO CON EL ID DE LA PELICULA PARA VERLA EN DETALLE-->

                <?php
                  echo '
                  <li class="li_borde_trasparente">
                  <a style="color:white;" href="movie.php?id=' . $p->id . '"> 
                  <img src="http://image.tmdb.org/t/p/w500'. $p->poster_path . '" class="img-responsive" style="width:100%" alt="Image " >
                     <h3 font-weight: bold>' . $p->original_title . " (" . substr($p->release_date, 0, 4) . ")
                     </h3>
                  </a>
                  <h5 ><em>Calificacion : " . $p->vote_average . " |  Votos: " . $p->vote_count . "</em>
                  </h5>
                  
                  </li>"; 
                ?> 
                <div class="form-group">
                  
                  <!-- <input class="form-control" id="" name="" type="text"> --> <!-- enviar la id de la pelicula para ver su detalle --> 
                </div> 
              </form>
                    
              <div class="card-block p-2">
                <div class="panel-body ">   

                </div>
                <div class="p-1 col-md-4">                
                                        
                </div>                               
              </div> 
            </div>
          </div>
        <?php } 
        }?>    
        <br>
      </div>
    </div>
  </section>
  <!-- FIN Cartelera  --> 

  
<footer>
  
</footer>



  <!-- <?php //require(ROOT . "Vistas/footer.php"); ?> --> <!-- incluyo el archivo footer  PROVISORIO SIN FOOTER--> 

<!-- CONFIGURACIONES CSS Y JAVA SCRIPT -->


  <!-- Fondo transparente -->
  
    <style>
      .logo_principal
      {
        margin: 30px 30px;
      }
      .li_borde_trasparente{
        box-shadow:0 5px 5px 3px rgba(0, 0, 0, 0.5);
        background:rgba(0,0,0,.3);
      }
      .div_trasparente
      {
        background:rgba(0,0,0,.3);
        padding:20px;
        margin:20px 0;
        color:#fff;
        box-shadow:0 5px 5px 3px rgba(0, 0, 0, 0.25);
      }
      

    div.background 
      {
        background: url(klematis.jpg) repeat;
        border: 0px ;
      }

      div.transbox 
      {
        margin: 10px;
        background-color: #ffffff;
        border: 1px solid black;
        opacity: 0.6;
        filter: alpha(opacity=60); /* For IE8 and earlier */
      }

      .fondo_body
      {
        background-image:url(images/fondo_Body5.jpg);
        background-size: 100% 100%;
        background-attachment: fixed;


      }
      .body_parallax
      {

        background:url(../../images/texturas/spectrum.png); /* Nuestra textura */
        background-repeat:repeat; /* Indicamos que la textura se repetira */
        background-attachment: fixed; /* Establecemos una posicion fija para la textura */
        /* Eliminamos la propiedad de background-size */
      }

      
      h5 
      {
        color: rgb(255,255,255); 
      }
      .active 
      {
        background-color: #4CAF50;
        color: white;
      }
      @font-face 
      {
          font-family:"Myriad Pro";
          src:url(Vistas/fonts/myriadpro/myriadpro.eot), 
          url(Vistas/fonts/myriadpro/myriadpro.ttf), 
          url(Vistas/fonts/myriadpro/myriadpro.woff);
      }

    </style>
    
    <!--  -->
 

      <!-- JavaScript -->
    
  
   



  </body>
</html>