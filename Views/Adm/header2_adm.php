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


	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->

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
							<a href="index.html" class="header__logo">
								<img src="img/logo.svg" alt="">
							</a>
							<!-- end header logo -->

							
							<?php   if( isset($_SESSION['Login']) ) {  ?> 
							<!------------ header auth ------->
							<div class="header__auth">
								<button class="header__search-btn" type="button">
									<i class="icon ion-ios-search"></i>
								</button>

								
						    </div>	
						</div>
						<!-- end header auth -->
					<?php } ?>
							<!-- header menu btn -->
							<button class="header__btn" type="button">
								<span></span>
								<span></span>
								<span></span>
							</button>
							<!-- end header menu btn -->
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
	
</body>
</html>