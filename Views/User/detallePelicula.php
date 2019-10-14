<?php namespace User;


//var_dump($mov);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  

  <!-- <link rel="stylesheet" href="Vistas/css/estilos.css"> -->
  <link rel="stylesheet" href="fonts/fonts.css">
  <link rel="stylesheet" href="http://necolas.github.io/normalize.css/3.0.1/normalize.css">
  <link rel="stylesheet" href="/MoviePass/Views/css/header2.css"><!-- ARCHIVO CSS-->
  <script src="http://code.jquery.com/jquery-latest.js"></script>
  <script src="Views/js/main.js"></script>
  <script src="Views/js/busqueda.js"></script>

<title>MoviePass</title>

  
<?php require(VIEWS_PATH."header.php"); ?> <!-- llamado a la barra nav de home-->
</head>

<body class="body_parallax"> <!-- fondo_body/body_parallax es una clase css donbde esta el archivo de la imagen de fondo y otras configuraciones del fondo, esta al final de home.php en la secion de <style>-->
  



<br> <!-- espacios en blanco -->

  <!-- INICIO DETALLE PELICULA   -->
<div class="grid"> <!-- contenedor principal -->
  <div class="a h3-align-center li_borde_trasparente">
    <?php echo '
      <h3 font-weight: bold>' . $mov->original_title . ' (' . substr($mov->release_date, 0, 4) . ')</h3>
    ';
    ?>
    
  </div> <!-- cada uno de los ítems del grid -->
  <div class="b li_borde_trasparente">
    <?php echo '
    <img src="http://image.tmdb.org/t/p/w500'. $mov->poster_path . '" class="img-responsive"  style="width:400" height="400"  alt="Image "> ';
    ?>
  </div>
  <div class="c li_borde_trasparente">
    
    <?php
      echo '
        <h2>Sinopsis</h2>
        <li>
          <p>'.$mov->overview.'</p>
        </li>
        <br>
        <h2>Ficha Tecnica</h2>
        <li>
          <p>Genero/s:';?> <?php foreach ($mov->genre_ids as $key) {  echo $key.' '; } ?> </p> <!-- muestra los id de los generos-->
         
        </li>
        <br>
        <?php
        echo '
        <li>
          <p>Fecha de Estreno: '.$mov->release_date.'</p>
          
        </li>
        ';?>
        <br>
        <?php
        echo '
        <li>
          <p>Lenguaje Original: '.$mov->original_language.'</p>
          
        </li>
        ';?>
        <br>
        <?php
        echo '
        <li>
          <p>Valoración: '.$mov->vote_average.'</p>
          
        </li>
        ';?>
        <div class="or-seperator"></div>

      
    
 
    
  </div>
  <div class="d">Item 4</div>
</div>


   

  

  <!-- <?php //require(ROOT . "Vistas/footer.php"); ?> --> <!-- incluyo el archivo footer  PROVISORIO SIN FOOTER--> 

<!-- CONFIGURACIONES CSS Y JAVA SCRIPT -->


  <!-- Fondo transparente -->
  
    <style>
      .logo_principal
      {
        margin: 30px 30px;
      }
      .li_borde_trasparente{
        box-shadow:0 6px 6px 5px rgba(0, 0, 0, 0.5);
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
      .h3-align-center{
        text-align: center;
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
      /*----------------------------------------------------*/
      




.grid {
  display: grid;
  grid-template-areas: "head head"
                       "menu main"
                       "foot foot";
  
  
  grid-column-gap: 50px;
  grid-row-gap: 20px;
}
.a { grid-area: head; margin-right: 70px; margin-left:70px;}
.b { grid-area: menu;  height:600px; width:400px; margin-left:70px;}
.c { grid-area: main;  height:600px; width:850px;margin-right: 70px; padding: 30px;}
.d { grid-area: foot; background: orange; }


    </style>
    
    <!--  -->
 

      <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  
   



  </body>
</html>