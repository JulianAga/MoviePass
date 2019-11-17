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
	

	
		<!-- filtro -->
	<div class="filter">
		<div class="container">
		  <form method="post" action="" name="genreSearch">
			<div class="row">
				<div class="col-12">
					<div class="filter__content">
						<div class="filter__items">
							<!-- filtro generos  -->
							<div class="filter__item" id="filter__genre">
								<div class="content-select">
									<select name="genre" id="genre" class="select">
						              <option value="" selected hidden>Todos</option>
						                  <?php
						                  foreach($genresArray as $g){?>
						                  <option value="<?php echo $g->getId();?>"><?php echo $g->getName();?></option> 
						                  <?php } ?>

						              </select>
						              <i></i> 
					            </div>
							</div>
							<!-- end filtro generos -->


							<!-- filtro fecha  -->
							<div class="filter__item" id="filter__genre">
								<div class="content-select">
									<label class="label-font"> Fecha</label>
              						<input type="date" id="date" min="<?php echo date("Y-m-d");?>"  name="date" date-border> 
					            </div>
							</div>
							<!-- end filtro fecha -->
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
	<style type="text/css">
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
		  	padding: 7px 10px;
		  	height: 42px;
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
			right: 20px;
			top: calc(50% - 13px);
			width: 16px;
			height: 16px;
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