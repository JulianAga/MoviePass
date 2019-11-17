<?php namespace User;


require ( CONFIG_API_PATH."API_tmdb.php");//llamado a la configuracion API the movie DB
require (API_PATH."api_now.php");// incluyo la API de peliculas actuales en cartelera

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
  <link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->



<title>MoviePass</title>

  
  
</head>

<body class="body_parallax"> <!-- fondo_body/body_parallax es una clase css donbde esta el archivo de la imagen de fondo y otras configuraciones del fondo, esta al final de home.php en la secion de <style>-->
 

 <!------------ MUESTRA DE ERRORES PROVENIENTES DE LA CONTROLADORA------->
    <?php if (isset($_SESSION['Error']) ) {
   $msj=$_SESSION['Error']; ?>
   
    <script> sweetAlert("Error!", "<?php echo $msj; ?>", "error")</script>
    <?php unset($_SESSION["Error"]);?>
    <?php } ?>
    <!-- -->
    <?php if (isset($_SESSION['Success']) ) {
       $msj2=$_SESSION['Success']; ?>
      
        <script> sweetAlert("Exito!", "<?php echo $msj2; ?>", "success")</script>
        <?php unset($_SESSION["Success"]);?>
    <?php } ?>
    <!-- -->
    <?php if (isset($_SESSION['BD']) ) {
       $msj3=$_SESSION['BD']; ?>
      
        <script> sweetAlert("Error en BD", "<?php echo $msj3; ?>", "error")</script>
        <?php unset($_SESSION["BD"]);?>
    <?php } ?>
    <!-------------------------------------- - ------------------------------> 
    
<header>
  <?php include_once(VIEWS_PATH."header2.php"); ?> <!-- llamado a la barra nav de home-->
</header>


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
      <!--
            Recorre la lista de generos y los pone como opcion dentro del select
            y los manda como post a esta misma pagina (tampoco se si esta bien)
        -->
        <div>
          <form method="post" action="" name="genreSearch">
              <select name="genre" id="genre">
              <option value="" selected disabled hidden>Genero</option>
                  <?php
                  foreach($genresArray as $g){?>
                  <option value="<?php echo $g->getId();?>"><?php echo $g->getName();?></option> 
                  <?php } ?>              
              </select>
              <input type='submit' name="enviar" id="enviar">
          </form>
        </div>
      <br>
      <div class="wrapperr">
      
      <?php
        if ($nowplaying !=null)//si no esta null la cartelera que llega desde movie DB, la recorro
        {
        foreach ($nowplaying->results as $p) {?> <!-- recorro la lista de peliculas actuales y las muestro-->
          <div class="align-self-center">
            <div class="card background">
              <form action="<?= ROOT_VIEW ?>/DetallePelicula/verPelicula" method="post" enctype="multipart/form-data"><!-- ENVIO FORMULARIO CON EL ID DE LA PELICULA PARA VERLA EN DETALLE-->

                <?php
                   if($_POST && isset($_POST["genre"])) // si se mando como post un genero del select
                   {
                     
                     if(in_array($_POST["genre"],$p->genre_ids)) //verifica que la pelicula sea de el genero elegido
                     {
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
                     }
                   }
                   else //si no hay post muestra todas las peliculas (no se tendria q repetir el codigo pero no se como hacerlo)
                   {
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
                   }
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
      .wrapperr { /* le da forma a la cuadricula de peliculas*/
        display: grid;
        /*grid-template-columns: 360px 360px 360px;/*360 x3=1080px . para agregar mas dividirlo por la cant deseada*/
        grid-template-columns: 270px 270px 270px 270px;/*270 x4=1080px . para agregar mas dividirlo por la cant deseada*/
  
        grid-gap: 30px 20px;
  
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
      <script type="text/javascript">
        function activarBoton(){

            var lista = document.getElementById("genre");
            var boton = document.getElementById("enviar");
            if(lista.selectedIndex !=0 )
              boton.disabled = false;
            else{
              boton.disabled = true;
            }

        }//FIN ACTIVAR BOTON
      </script>
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!--
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    -->
   



  </body>
</html>