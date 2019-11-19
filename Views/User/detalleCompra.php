<?php 

?>

<!DOCTYPE html>
<html>
<head>
	<title>MoviePass</title>
</head>
<body>
	<header>
        <?php require(VIEWS_PATH."header2.php"); ?> <!-- llamado a la barra nav de home-->
        

    </header>
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
    <pre>
        <?php //var_dump($function); ?>
    </pre>
    <section class="section details">
        <div class="details__bg" data-bg="/MoviePass/Views/img/home/home__bg.jpg">
        </div>
        <!-- details content -->
        <div class="container">
            <div class="row">
                
                    <div class="col-12">
                        <h1 class="details__title">Seleccione Ubicación</h1>
                    </div>
                    <!-- content -->
                    <div class="col-12 col-xl-6">
                        <div class="card card--details">
                            <div class="row">
                                <!-- card cover -->
                                <div class="col-12 col-sm-4 col-md-4 col-lg-3 col-xl-5">
                                    <div class="card__cover">
                                        <img src="http://image.tmdb.org/t/p/w500<?php echo $function->getIdPelicula()->getImagen() ;?>" alt="">
                                    </div>
                                </div>
                                <!-- end card cover -->

                                <!-- card content -->
                                <div class="col-12 col-sm-8 col-md-8 col-lg-9 col-xl-7">
                                    <div class="card__content">
                                        <div class="card__wrap">
                                            <span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>

                                            <ul class="card__list">
                                                <li>FHD</li>
                                                <li>16+</li>
                                            </ul>
                                        </div>
                                        <form action="<?= ROOT_VIEW ?>/Compra/newCompra">
                                            <ul class="card__meta">
                                                <li>
                                                    <span>Cine:</span>
                                                    <a><?php echo $function->getSala()->getCine()->getNombre();?></a>
                                                </li>
                                                <li>
                                                    <span>Dirección:</span>
                                                    <a><?php echo $function->getSala()->getCine()->getDireccion();?></a> 
                                                </li>
                                                <li>
                                                    <span>Sala:</span> 
                                                    <a><?php echo $function->getSala()->getNombre();?></a>
                                                </li>
                                                <li>
                                                    <span>Entradas disponibles:</span> 
                                                    <a><?php //echo $function->getSala()->getNombre();?></a>
                                                </li>
                                                <li>
                                                    <span>Cantidad de entradas:</span> 
                                                    <div class="content-select">
                                                       <select class="select " required>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            
                                                        </select>    
                                                    </div>
                                                </li>
                                                <br>
                                                <br>
                                                <br>
                                                <br>
                                                <li>
                                                    <button class="filter__btn" type="submit" name="enviar" id="enviar">Comprar</button>
                                                </li>
                                            </ul>
                                            <div class="card__description card__description--details">
                                                <?php //echo $mov->getDescripcion() ?> 
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- end card content -->
                            </div>
                        </div>
                    </div>
                    <!-- end content -->
                    <!-- player -->
                    <div class="col-6">
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>
                        <span class="details__devices-title">aca iria la seleccion de butacas.proximamente.....</span>


                    </div>
                    <!-- end player -->
            </div>
            <!-- end row principal-->
        </div>
        <!-- end details content conteiner-->
    </section>
    
<!-- footer -->
	<?php require(VIEWS_PATH."footer.php"); ?> <!-- llamado a la barra nav de home-->
<!-- end footer-->


<!-- CSS -->
<style type="text/css">
        .option-selected-color{
            color: #ff55a5;
        }
        .content-input input,
        .content-select select{
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        .content-select select{
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }
        /* Eliminamos la fecha que por defecto aparece en el desplegable */
        .content-select select::-ms-expand {
            display: none;
        }
        .content-select{
            max-width: 250px;
            position: relative;
        }
 
        
        .content-select select{
            display: inline-block;
            width: 100%;
            cursor: pointer;
            padding: 1px 10px;
            height: 28px;
            outline: 0; 
            border: 0;
            border-radius: 0;
            background: #f0f0f0;
            color: #7b7b7b;
            font-size: 16px;
            color: #1e1b1c;
            /*font-size: 1em;
            color: #999;*/
            /*font-family: 
            'Quicksand', sans-serif;*/
            font-family: 'Open Sans', sans-serif;
            border:2px solid rgba(0,0,0,0.2);
            border-radius: 12px;
            position: relative;
            transition: all 0.25s ease;
        }
         
        .content-select select:hover{
            /*background: #f2afce;*/
              background-image: -moz-linear-gradient(90deg, #ff55a5 10%, #ff5860 90%);
              background-image: -webkit-linear-gradient(90deg, #ff55a5 10%, #ff5860 90%);
              background-image: -ms-linear-gradient(90deg, #ff55a5 10%, #ff5860 90%);
              background-image: linear-gradient(90deg, #ff55a5 10%, #ff5860 90%);

              font-size: 16px;
              color: #fff;
        }
         
        /* 
        Creamos la fecha que aparece a la izquierda del select.
        Realmente este elemento es un cuadrado que sólo tienen
        dos bordes con color y que giramos con transform: rotate(-45deg);
        */
        .content-select i{
            position: absolute;
            right: 2px;
            top: calc(50% - 10px);
            width: 12px;
            height: 12px;
            display: block;
            
            border-left:4px solid #ff55a5;
            border-bottom:4px solid #ff55a5;

            transform: rotate(-45deg); /* Giramos el cuadrado */
            transition: all 0.25s ease;
        }
         
        .content-select:hover i{
            margin-top: 3px;
            border-left:4px solid #f6ecf1;
            border-bottom:4px solid #f6ecf1;
        }
        .date-border{
            border-left:4px solid #f6ecf1;
            border-bottom:4px solid #f6ecf1;
            border-radius: 12px;
        }
        .label-font{
            font-size: 16px;
            color: #f6ecf1;
            font-family: 'Open Sans', sans-serif;

        }

    </style>
</body>
</html>