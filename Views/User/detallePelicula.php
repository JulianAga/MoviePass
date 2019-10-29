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

<body class="body_parallax "> <!-- fondo_body/body_parallax es una clase css donbde esta el archivo de la imagen de fondo y otras configuraciones del fondo, esta al final de home.php en la secion de <style>-->

  <br> <!-- espacios en blanco -->

  <!-- INICIO DETALLE PELICULA   -->
<div class="grid"> <!-- contenedor principal -->
  <div class="a h3-align-center li_borde_trasparente">
    <?php echo '
      <h4 class="label-blanco" font-weight: bold>' . $mov->getNombre() .'</h4>
    ';
    ?>
    
  </div> <!-- cada uno de los ítems del grid -->
  <div class="b li_borde_trasparente ">
    <?php echo '
    <img src="http://image.tmdb.org/t/p/w500'. $mov->getImagen() . '" class="img-responsive"  style="width:400" height="400"  alt="Image "> ';
    ?>
  </div>

  <div class="c li_borde_trasparente ">
    
    <?php
      echo '
        <h2>Sinopsis</h2>
        
          <p>'.$mov->getDescripcion().'</p>
        
        <br>
        <h2>Ficha Tecnica</h2>
        <li>
          <p>Genero/s:';?> <?php foreach ($generos as $key) {  echo $key->getName().'-'; } ?> </p> <!-- muestra los id de los generos-->
         
        </li>
        <br>
        <?php
        echo '
        <li>
          <p>Lenguaje Original: '.$mov->getId_api().'</p>
          
        </li>
        ';?>
        <br>
        <li>
          <select>
        <?php foreach ($lista_funciones as $g) { var_dump($lista_funciones);?>
            
            <option value="<?php echo '$g->getId()';?>">
              <?php echo $g->getIdCine()->getNombre();?>
            </option>
           <?php } ?>
          </select>
          
        </li>
        
        <div class="or-seperator"></div>
        <br>
        <div>
          <form>
            <input type="submit" class="btn btn-primary btn-block btn-abajo" value="Comprar Entradas">
          </form>
        </div>
      
    
 
    
  </div>
  
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
        box-shadow:0 5px 5px 3px rgba(0, 0, 0, 0.5);
        background: #8b8b8b; 

        background: -moz-linear-gradient(top,  #8b8b8b 0%, #6a6a6a 50%, #5e5e5e 51%, #717171 100%); 
        background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#8b8b8b), color-stop(50%,#6a6a6a), color-stop(51%,#5e5e5e), color-stop(100%,#717171)); 
        background: -webkit-linear-gradient(top,  #8b8b8b 0%,#6a6a6a 50%,#5e5e5e 51%,#717171 100%); 
        background: -o-linear-gradient(top,  #8b8b8b 0%,#6a6a6a 50%,#5e5e5e 51%,#717171 100%); 
        background: -ms-linear-gradient(top,  #8b8b8b 0%,#6a6a6a 50%,#5e5e5e 51%,#717171 100%); 
        background: linear-gradient(to bottom,  #8b8b8b 0%,#6a6a6a 50%,#5e5e5e 51%,#717171 100%); 
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#8b8b8b', endColorstr='#717171',GradientType=0 );
      }
      .div_trasparente
      {
        background:rgba(255,255,255,.9);
        
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

        background:url(/MoviePass/images/texturas/karachi.gif); /* Nuestra textura */
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
      .div-gradient{
        background: rgba(0,0,0,1);
        background: -moz-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,1) 50%, rgba(8,8,8,1) 100%);
        background: -webkit-gradient(left top, left bottom, color-stop(0%, rgba(0,0,0,1)), color-stop(50%, rgba(255,255,255,1)), color-stop(50%, rgba(255,255,255,1)), color-stop(100%, rgba(8,8,8,1)));
        background: -webkit-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,1) 50%, rgba(8,8,8,1) 100%);
        background: -o-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,1) 50%, rgba(8,8,8,1) 100%);
        background: -ms-linear-gradient(top, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,1) 50%, rgba(8,8,8,1) 100%);
        background: linear-gradient(to bottom, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 50%, rgba(255,255,255,1) 50%, rgba(8,8,8,1) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#000000', endColorstr='#080808', GradientType=0 );
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
      .c { grid-area: main;  height:750px; width:850px;margin-right: 70px; padding: 30px;}
      .d { grid-area: foot; background: orange; }

      .btn-abajo{
        position: relative;
        bottom: -90px;
        right: 0px;
      }
      .label-blanco{
        color: #ffff;
      }

    </style>
    
    <!--  -->
 

      <!-- JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
  
   



  </body>
</html>