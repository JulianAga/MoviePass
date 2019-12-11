
<!DOCTYPE html>
<html>
<head>

<?php
//-----ESTO DEBE IR EN LA CONTROLADORA HOME
if( isset($_SESSION['Login'])){
  $cuenta_logueada=$_SESSION['Login'];
  $cuenta_logueada->getEmail();
}
if( isset($_SESSION['Cliente_Logueado'])){
  $cliente=$_SESSION['Cliente_Logueado'];
  
}
//-----------------------------------------
?>
<!DOCTYPE html>

<html>
<head>


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



  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


	<!-- Favicons -->
	<link rel="icon" type="image/png" href="/MoviePass/Views/icon/favicon-32x32.png" sizes="32x32">
	<link rel="apple-touch-icon" href="/MoviePass/Views/icon/favicon-32x32.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/MoviePass/Views/icon/apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/MoviePass/Views/icon/apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/MoviePass/Views/icon/apple-touch-icon-144x144.png">
	<title></title>
</head>
<body>
	<!-- header -->
	<header class="header">
		<div class="header__wrap">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__content">
							<!-- header logo -->
							<a  class="header__logo">
								<img src="/MoviePass/Views/img/logo.svg" alt="">
							</a>
							<!-- end header logo -->


							<!-- header nav -->
							<ul class="header__nav">
								<!-- dropdown -->
								<li class="header__nav-item">
									<a class="dropdown-toggle header__nav-link" href="<?= ROOT_VIEW ?>/Home" role="button" id="dropdownMenuHome" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Home</a>

									
								</li>
								<!-- end dropdown -->
							</ul>
							<!-- end header nav -->


							

							<!-- header auth -->
							<div class="header__auth">
								

								<!--ENTRA SI HAY SESSION, CAMBIANDO LOS ICONOS DE LA BARRA -->
					<?php   if( !isset($_SESSION['Login']) ) {  ?>
								<a data-toggle="modal" data-target="#id01" class="header__sign-in"><span>Iniciar Sesion</span>
								</a>
								<!-- ventana modal sign in-->
								<div id="id01" class="w3-modal w3-animate-opacity"  tabindex="-1">
								    <div><!-- w3-modal-content w3-card-4--> 
								      <div class="" data-bg=""> 
										<div class="container">
											<div class="row">
												<div class="col-12">
													<div class="sign__content">
														<!-- authorization form -->
														<form action="<?= ROOT_VIEW ?>/Login/verificarSesion" method="post" class="sign__form">
															<span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright" style="color:white;">&times;</span>
															<a class="sign__logo">
																<img src="/MoviePass/Views/icon/favicon-32x32.png" alt="">
															</a>

															<div class="sign__group form-group">
																<input type="text" class="sign__input form-control" name="emailBuscado" placeholder="Email" required="required">
															</div>

															<div class="sign__group ">
																<input type="password" class="sign__input" placeholder="Password" required="required" name="passLogin">
															</div>

															
															
															<button class="sign__btn" type="submit">Iniciar Sesion</button>

															<span class="sign__text " data-toggle="modal" data-target="#id02" data-dismiss="modal">No tenes cuenta? <a>Registrate!</a>
															</span>

															<span class="sign__text"><a href="#">Olvidaste la contraseña?</a></span>
														</form>
														<!-- end authorization form -->
													</div>
												</div>
											</div>
										</div>

									</div>
								      
								    </div>
								</div>
								<!-- end ventana modal sign in-->

								<!-- sign up modal-->
								<div id="id02" class="w3-modal">
								    <div><!-- w3-modal-content w3-card-4-->
								    	<div class="" data-bg="">
											<div class="container">
												<div class="row">
													<div class="col-12">
														<div class="sign__content">
															<!-- registration form -->
															<form action="<?= ROOT_VIEW ?>/Login/nuevo_usuario" method="post" class="sign__form">

																<a href="index.html" class="sign__logo">
																	<img src="img/logo.svg" alt="">
																</a>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Nombre" required="required" name="nombre" maxlength="25">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Apellido" required="required" name="apellido" name="apellido" maxlength="25">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="D.N.I" required="required" name="dni" maxlength="10">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Telefono" required="required" name="telefono" maxlength="15">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Direccion" required="required" name="direccion" maxlength="30">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Ciudad" required="required" name="ciudad" maxlength="30">
																</div>

																<div class="sign__group">
																	<input type="text" class="sign__input" placeholder="Email" required="required" name="email" maxlength="30" >
																</div>


																<div class="sign__group">
																	<input type="password" class="sign__input" placeholder="Contraseña" required="required" name="pass1" maxlength="30">
																</div>

																<div class="sign__group">
																	<input type="password" class="sign__input" placeholder="Confirmar Contraseña" required="required" maxlength="30" name="pass2">
																</div>

																<div class="sign__group sign__group--checkbox">
																	<input id="remember" name="remember" type="checkbox" checked="checked" required="required">
																	<label for="remember">Acepto las <a href="#">Politicas de Privacidad</a></label>
																</div>
																
																<button class="sign__btn" type="submit">Registrarme</button>
															</form>
															<!-- end registration form -->
														</div>
													</div>
												</div>
											</div>
										</div>
								      
								    </div>
							    </div>
							    <?php } ?>
								<!-- end sign up modal-->
								<!--ENTRA SI HAY SESSION, CAMBIANDO LOS ICONOS DE LA BARRA -->
								<?php   if( isset($_SESSION['Login']) ) {  ?> 
											
											<form action="<?= ROOT_VIEW ?>/Login/cerrarSesion" method="post">
												<button class="sign__btn" type="submit">Cerrar Session</button>
											</form>
												
								<?php } ?>

						    </div>
						
						</div>
						<!-- end header auth -->

							

						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- header search -->
		<form action="#" class="header__search">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="header__search-content">
							<input type="text" placeholder="Search for a movie, TV Series that you are looking for">

							<button type="button">search</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<!-- end header search -->

	</header>
	<!-- <br> -->


	<!-- end header -->
	<style type="text/css">
		.modal {
  display: none;
  position: fixed; 
  padding-top: 50px;
  left: 0; 
  top: 0;
  width: 100%;
  height: 100%; 
  background-color: rgb(0, 0, 0);
  background-color: rgba(0, 0, 0, 0.5);
}
.modal-content {
  position: relative; 
  background-color: white;
  padding: 20px; 
  margin: auto; 
  width: 75%;  
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}
.close-btn {
  float: right; 
  color: lightgray; 
  font-size: 24px;  
  font-weight: bold;
}
.close-btn:hover {
  color: darkgray;
}
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}
@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}
	</style>
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

	<script type="text/javascript">
		let modalBtn = document.getElementById("modal-btn")
let modal = document.querySelector(".modal")
let closeBtn = document.querySelector(".close-btn")
modalBtn.onclick = function(){
  modal.style.display = "block"
}
closeBtn.onclick = function(){
  modal.style.display = "none"
}
window.onclick = function(e){
  if(e.target == modal){
    modal.style.display = "none"
  }
}
		
	</script>

	

</body>
</html>