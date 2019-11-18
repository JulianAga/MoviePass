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
                                    </ul>
                                    <div class="card__description card__description--details">
                                        <?php //echo $mov->getDescripcion() ?> 
                                    </div>
                                </div>
                            </div>
                            <!-- end card content -->
                        </div>
                    </div>
                </div>
                <!-- end content -->
                <!-- player -->
                <div class="col-6">
                    <video controls crossorigin playsinline poster="../../../cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.jpg" id="player">
                        <!-- Video files -->
                        <!-- <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" type="video/mp4" size="576">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-720p.mp4" type="video/mp4" size="720">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1080p.mp4" type="video/mp4" size="1080">
                        <source src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-1440p.mp4" type="video/mp4" size="1440"> -->

                        <!-- Caption files -->
                        <track kind="captions" label="English" srclang="en" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.en.vtt"
                            default>
                        <track kind="captions" label="Français" srclang="fr" src="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-HD.fr.vtt">

                        <!-- Fallback for browsers that don't support the <video> element -->
                        <a href="https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4" download>Download</a>
                    </video>
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
</body>
</html>