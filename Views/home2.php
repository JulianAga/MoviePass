<?php namespace Views;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600%7CUbuntu:300,400,500,700" rel="stylesheet">

	<!-- CSS -->
	<link rel="stylesheet" href="/MoviePass/Views/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/bootstrap-grid.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/owl.carousel.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/jquery.mCustomScrollbar.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/nouislider.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/ionicons.min.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/plyr.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/photoswipe.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/default-skin.css">
	<link rel="stylesheet" href="/MoviePass/Views/css/main.css">

	<!-- Favicons -->
	<link rel="icon" type="image/png" href="/MoviePass/Views/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="/MoviePass/Views/icon/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/MoviePass/Views/icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/MoviePass/Views/icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/MoviePass/Views/icon/apple-touch-icon-144x144.png">

	
	<title>MoviePass</title>

</head>
<body class="body">
	
	<?php include_once(VIEWS_PATH."header2.php"); ?>

	<!-- page title -->
	<section class="section section--first section--bg" data-bg="/MoviePass/Views/img/section/section.jpg">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="section__wrap">
						<!-- section title -->
						<h2 class="section__title">Estrenos</h2>
						<!-- end section title -->
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end page title -->
	

	<!-- content -->
	<section class="content">
		<!-- filtro -->
	<div class="filter">
		<div class="container">
		  <form method="post" action="" name="genreSearch">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">
							<!-- item genero  -->
							<div class="filter__item" id="filter__genre">
								<span class="filter__item-label">Genero:</span>

								<div class="filter__item-btn dropdown-toggle" role="navigation" id="filter-genre" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<input type="button" value="Generos">
									<span></span>
								</div>
								<ul class="filter__item-menu dropdown-menu scrollbar-dropdown" aria-labelledby="filter-genre">
									
									<?php
					                  foreach($genresArray as $g){?>
					                  <input type="checkbox" id="genero">
					                  <li for="genero" value="<?php echo $g->getId();?>"><?php echo $g->getName();?></li> 
					                <?php } ?>  
								</ul>
							</div>
							<!-- end filtro genero -->

							<!-- filtro rating -->
							<!-- <div class="filter__item" id="filter__rate">
								<span class="filter__item-label">Rating:</span>

								<div class="filter__item-btn dropdown-toggle" role="button" id="filter-rate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="filter__range">
										<div id="filter__imbd-start"></div>
										<div id="filter__imbd-end"></div>
									</div>
									<span></span>
								</div>

								<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-rate">
									<div id="filter__imbd"></div>
								</div>
							</div> -->
							<!-- end filtro rating-->

							<!-- filtro año -->
							<!-- <div class="filter__item" id="filter__year">
								<span class="filter__item-label">Año:</span>

								<div class="filter__item-btn dropdown-toggle" role="button" id="filter-year" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<div class="filter__range">
										<div id="filter__years-start"></div>
										<div id="filter__years-end"></div>
									</div>
									<span></span>
								</div>

								<div class="filter__item-menu filter__item-menu--range dropdown-menu" aria-labelledby="filter-year">
									<div id="filter__years"></div>
								</div>
							</div> -->
							<!-- end filtro año -->
						</div>
						
						<!-- boton aplicar filtro -->
						<button class="filter__btn" type="submit" name="enviar" id="enviar">Aplicar Filtro</button>
						<!-- end boton aplicar filtro -->
					</div>
				</div>
			</div>
		  </form>
		</div>
	</div>
	<!-- end filtro -->
	<!-- expected premiere -->
	<div class="catalog">
		<div class="container">
			
			<div class="row">
				
				<?php  foreach($movieList as $p) {?> <!-- Inicio foreach-->
				<!-- card -->
				
					<div class="col-3 ">
						<div class="card card--big ">
							<div class="card hover">
								
								<form action="<?= ROOT_VIEW ?>/DetallePelicula/searchMovie"  method="post"><!-- ENVIO FORMULARIO CON EL ID DE LA PELICULA PARA VERLA EN DETALLE-->
									<button type="submit"><img src="http://image.tmdb.org/t/p/w500<?php echo $p->getImagen() ;?>"style="width:100%" alt="Image " ></button>

									<input type="hidden" id="movie_id" name="movie_id" value="<?php echo $p->getId_api();?>"/> <!-- le paso el id de pelicula-->
								</form>
								
								
							</div>
							<div class="card__content">
								<h3 class="card__title"><a href="#"><?php echo $p->getNombre(); ?></a></h3>
								<span class="card__category">
									<a href="#">Action</a>
									<a href="#">Triler</a>
								</span>
								<span class="card__rate"><i class="icon ion-ios-star"></i>8.4</span>
							</div>
						</div>
					</div>
				
				
					<!-- end card -->
			<?php } //end foreach?>


				<!-- section btn -->
				<div class="col-12">
					<a href="#" class="section__btn">Show more</a>
				</div>
				<!-- end section btn -->
			</div>
			
		</div>
	</div>
	
	<!-- end expected premiere -->
		

	

	

	<!-- footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<!-- footer list -->
				<div class="col-12 col-md-3">
					<h6 class="footer__title">Descarga nuestras Apps</h6>
					<ul class="footer__app">
						<li><a href="#"><img src="/MoviePass/Views/img/Download_on_the_App_Store_Badge.svg" alt=""></a></li>
						<li><a href="#"><img src="/MoviePass/Views/img/google-play-badge.png" alt=""></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">Recursos</h6>
					<ul class="footer__list">
						<li><a href="#">Sobre Nosotros</a></li>
						<li><a href="#">Ayuda</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-6 col-sm-4 col-md-3">
					<h6 class="footer__title">Legal</h6>
					<ul class="footer__list">
						<li><a href="#">Terminos de uso</a></li>
						<li><a href="#">Politica de Privacidad</a></li>
						<li><a href="#">Seguridad</a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer list -->
				<div class="col-12 col-sm-4 col-md-3">
					<h6 class="footer__title">Contracto</h6>
					<ul class="footer__list">
						<li><a href="tel:+18002345678">+54 (223) 12312234-5678</a></li>
						<li><a href="mailto:support@moviego.com">support@moviepass.com</a></li>
					</ul>
					<ul class="footer__social">
						<li class="facebook"><a href="#"><i class="icon ion-logo-facebook"></i></a></li>
						<li class="instagram"><a href="#"><i class="icon ion-logo-instagram"></i></a></li>
						<li class="twitter"><a href="#"><i class="icon ion-logo-twitter"></i></a></li>
						<li class="vk"><a href="#"><i class="icon ion-logo-vk"></i></a></li>
					</ul>
				</div>
				<!-- end footer list -->

				<!-- footer copyright -->
				<div class="col-12">
					<div class="footer__copyright">

						<ul>
							<li><a href="#">Terminos de uso</a></li>
							<li><a href="#">Politica de privacidad</a></li>
						</ul>
					</div>
				</div>
				<!-- end footer copyright -->
			</div>
		</div>
	</footer>
	<!-- end footer -->
	<script type="text/javascript">
		
	</script>

	<!-- JS -->
	<script src="/MoviePass/Views/js/jquery-3.3.1.min.js"></script>
	<script src="/MoviePass/Views/js/bootstrap.bundle.min.js"></script>
	<script src="/MoviePass/Views/js/owl.carousel.min.js"></script>
	<script src="/MoviePass/Views/js/jquery.mousewheel.min.js"></script>
	<script src="/MoviePass/Views/js/jquery.mCustomScrollbar.min.js"></script>
	<script src="/MoviePass/Views/js/wNumb.js"></script>
	<script src="/MoviePass/Views/js/nouislider.min.js"></script>
	<script src="/MoviePass/Views/js/plyr.min.js"></script>
	<script src="/MoviePass/Views/js/jquery.morelines.min.js"></script>
	<script src="/MoviePass/Views/js/photoswipe.min.js"></script>
	<script src="/MoviePass/Views/js/photoswipe-ui-default.min.js"></script>
	<script src="/MoviePass/Views/js/main.js"></script>
</body>

</html>