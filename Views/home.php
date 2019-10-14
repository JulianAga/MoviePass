<?php namespace Views;


include "Config/API_tmdb.php";//llamado a la configuracion API the movie DB
include "Api/api_now.php";// incluyo la API de peliculas actuales en cartelera

//////////   agregado por leo
        

        use Repository\DAOGenres as DAOGenres;
        $daoGenres=new DAOGenres();           //crea un objeto de dao genres

        $genresArray=$daoGenres->GetAll();    //carga en la variable la lista con los generos (ESTO NO CREO QUE VAYA ACA PERO NI IDEA DONDE TIENE QUE IR)
        //////////


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
      <!--
            Recorre la lista de generos y los pone como opcion dentro del select
            y los manda como post a esta misma pagina (tampoco se si esta bien)
        -->
        <div>
          <form method="post" action="" name="genreSearch">
              <label>Genero</label>
              <select name="genre">
              <option value="" selected disabled hidden>Choose here</option>
                  <?php
                  foreach($genresArray as $g){?>
                  <option value="<?php echo $g->getId();?>"><?php echo $g->getName();?></option> 
                  <?php } ?>              
              </select>
              <input type='submit' name="genreSearch">
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
              <form action="<?= ROOT_VIEW ?>/DetallePelicula/searchMovie" method="post"><!-- ENVIO FORMULARIO CON EL ID DE LA PELICULA PARA VERLA EN DETALLE-->
                <input type="hidden" id="movie_id" name="movie_id" value="<?php echo $p->id?>"/> <!-- le paso el id de pelicula-->
                <?php
                   if($_POST && isset($_POST["genre"])) // si se mando como post un genero del select
                   {
                     
                     if(in_array($_POST["genre"],$p->genre_ids)) //verifica que la pelicula sea de el genero elegido
                     {

                       echo '
                       <li class="li_borde_trasparente">
                       <a style="color:white;" href="movie.php?id=' . $p->id . '"> 
                       <button type="submit" name="boton_imagen"><img src="http://image.tmdb.org/t/p/w500'. $p->poster_path . '" class="img-responsive"  style="width:100%" alt="Image "></button>
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
                     <button type="submit" name="boton_imagen"><img src="http://image.tmdb.org/t/p/w500'. $p->poster_path . '" class="img-responsive" style="width:100%" alt="Image "></button>
                       <h3 font-weight: bold>' . $p->original_title . " (" . substr($p->release_date, 0, 4) . ")
                       </h3>
                     </a>
                     <h5 ><em>Calificacion : " . $p->vote_average . " |  Votos: " . $p->vote_count . "</em>
                     </h5>
                     
                     </li>";
                     
                   }
                   
                ?>
                
                
                
                 
              </form>
                    
              <div class="card-block p-2">
                <div class="panel-body ">   

                </div>
                <div class="p-1 col-md-4">                
                                        
                </div>                               
              </div> 
            </div>
          </div>
        <?php } //fin foreach
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
    
  
   



  </body>
</html>