<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	
        <?php require(VIEWS_PATH."header2.php"); ?> <!-- llamado a la barra nav de home-->
        <?php //require(VIEWS_PATH."header.php"); ?> <!-- llamado a la barra nav de home--> <!-- PROVISORIO -->

        
    
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

    
    <!-- home -->
	<br>
	<section class="section details">
		<!-- details background -->
		<div class="details__bg" data-bg="/MoviePass/Views/img/home/home__bg.jpg">
		</div>
		<!-- end details background -->

		<div class="container">
		  <div class="row">

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
									

									<ul class="card__meta">
										<li>
											<span>Cine:</span>
											<a href="#"><?php echo $function->getSala()->getCine()->getNombre();?></a>
										</li>
										<li>
											<span>Sala:</span> 
											<a href="#"><?php echo $function->getSala()->getNombre();?></a>
										</li>

										<li>
											<span>Pelicula:</span>
											<a href="#"><?php echo $function->getIdPelicula()->getNombre();?></a>
										</li>
										<li>
											<span>Fecha:</span>
											<a href="#"><?php echo $function->getDia();?></a>
										</li>
										<li>
											<span>Cantidad de Entradas:</span>
											<a href="#"><?php echo $cantidad_entradas;?></a>
										
										
										
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

				<!-- credit card -->
				<div class="col-6">
					<form class="credit-card">
					  <div class="form-header">
					    <h4 class="title">Tarjeta de Credito</h4>
					  </div>
					 
					  <div class="form-body">
					    <!-- Card Number -->
					    <input type="text" class="card-number" placeholder="Numero Tarjeta">
					 
					    <!-- Date Field -->
					    <div class="date-field">
					      <div class="month">
					        <select name="Month">
					          <option value="january">January</option>
					          <option value="february">February</option>
					          <option value="march">March</option>
					          <option value="april">April</option>
					          <option value="may">May</option>
					          <option value="june">June</option>
					          <option value="july">July</option>
					          <option value="august">August</option>
					          <option value="september">September</option>
					          <option value="october">October</option>
					          <option value="november">November</option>
					          <option value="december">December</option>
					        </select>
					      </div>
					      <div class="year">
					        <select name="Year">
					          
					          <option value="2019">2019</option>
					          <option value="2020">2020</option>
					          <option value="2021">2021</option>
					          <option value="2022">2022</option>
					          <option value="2023">2023</option>
					          <option value="2024">2024</option>
					        </select>
					      </div>
					    </div>
					 
					    <!-- Card Verification Field -->
					    <div class="card-verification">
					      <div class="cvv-input">
					        <input type="text" placeholder="CVV">
					      </div>
					      <div class="cvv-details">
					        <p>3 o 4 digitos</p>
					      </div>
					    </div>
					 
					    <!-- Buttons -->
					    <!-- <button type="submit" class="proceed-btn"><a>Comprar</a></button> -->
					    <button class="proced__btn" type="submit" name="enviar" id="enviar">Comprar Entradas</button>
					    
					  </div>
					</form>
				</div>
				<!-- end credit card-->
				<div class="col-12">
					<h1 class="details__title">Total a Pagar: <a style="color: #ff55a5;"><?php echo $function->getSala()->getValor_Entrada() * $cantidad_entradas; ?></a></h1>
				</div>
			
		  </div>	<!-- ROW-->
		</div><!-- CONTEINER-->
	</section>
		
	
	
		
        
       
        		
        	
        
    
    <!-- footer -->
	<?php //require(VIEWS_PATH."footer.php"); ?> <!-- llamado a la barra nav de home-->
<!-- end footer-->




<!-- CSS -->
<style type="text/css">
	.proced__btn {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 38px;
  /*width: 240px;*/
  width: 100%;
  -webkit-border-radius: 4px;
  border-radius: 4px;
  background-image: -moz-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
  background-image: -webkit-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
  background-image: -ms-linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
  background-image: linear-gradient(90deg, #ff55a5 0%, #ff5860 100%);
  -webkit-box-shadow: 0 0 20px 0 rgba(255,88,96,0.5);
  box-shadow: 0 0 20px 0 rgba(255,88,96,0.5);
  opacity: 0.85;
  font-size: 13px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 500;
  letter-spacing: 1px;
  margin-bottom: 10px;
}
.proced__btn:hover {
  opacity: 1;
  color: #fff;
}

	/* Global */
* {
    box-sizing: border-box;
}
 
body,
html {
    height: 100%;
    min-height: 100%;
}
 
body {
    font-family: 'Roboto',
    sans-serif;
    margin: 0;
    
}
/* Credit Card */
.credit-card {
    width: 360px;
    height: 300px;
    margin: 3px auto 0;
    border: 1px solid #ddd;
    border-radius: 6px;
    background-color: #fff;
    box-shadow: 1px 2px 3px 0 rgba(0,0,0,.10);
}
.form-header {
    height: 60px;
    padding: 20px 30px 0;
    border-bottom: 1px solid #e1e8ee;
}
 
.form-body {
    height: 340px;
    padding: 30px 30px 20px;
}
/* Title */
.title {
    font-size: 18px;
    margin: 0;
    color: #5e6977;
}
/* Common */
.card-number,
.cvv-input input,
.month select,
.year select {
    font-size: 14px;
    font-weight: 100;
    line-height: 24px;
}
 
.card-number,
.month select,
.year select {
    font-size: 14px;
    font-weight: 100;
    line-height: 24px;
}
 
.card-number,
.cvv-details,
.cvv-input input,
.month select,
.year select {
    
}
/* Card Number */
.card-number {
    width: 100%;
    margin-bottom: 20px;
    padding-left: 20px;
    border: 2px solid #e1e8ee;
    border-radius: 6px;
}
/* Date Field */
.month select,
.year select {
    width: 145px;
    margin-bottom: 20px;
    padding-left: 20px;
    border: 2px solid #e1e8ee;
    border-radius: 6px;
    background: url('caret.png') no-repeat;
    background-position: 85% 50%;
    -moz-appearance: none;
    -webkit-appearance: none;
}
 
.month select {
    float: left;
}
 
.year select {
    float: right;
}
/* Card Verification Field */
.cvv-input input {
    float: left;
    width: 145px;
    padding-left: 20px;
    border: 2px solid #e1e8ee;
    border-radius: 6px;
    background: #fff;
}
 
.cvv-details {
    font-size: 12px;
    font-weight: 300;
    line-height: 16px;
    float: right;
    margin-bottom: 20px;
}
 
.cvv-details p {
    margin-top: 6px;
}
/* Buttons Section */
.paypal-btn,
.proceed-btn {
    cursor: pointer;
    font-size: 16px;
    width: 100%;
    border-color: transparent;
    border-radius: 6px;
}
 
.proceed-btn {
    margin-bottom: 10px;
    background: #7dc855;
}
 
.paypal-btn a,
.proceed-btn a {
    text-decoration: none;
}
 
.proceed-btn a {
    color: #fff;
}
 
.paypal-btn a {
    color: rgba(242, 242, 242, .7);
}
 
.paypal-btn {
    padding-right: 95px;
    background: url('paypal-logo.svg') no-repeat 65% 56% #009cde;
}
 
</style>
<!-- JS -->
<script type="text/javascript">
	


</script>


</body>
</html>