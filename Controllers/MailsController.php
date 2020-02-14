<?php 
namespace Controllers;

use Models\Compra;
use DAO\CuentasDAO;
use Models\PHPMailer;
use Models\Exceptionn;
use Models\SMTP;
class MailsController 
{
    private $cuentasDAO;
    public function __construct() {
        $this->cuentasDAO = new CuentasDAO();
    }

    public function enviarMailCompra(Compra $compra,$qrMandar)
    {
        //$cuenta = $this->cuentasDAO->buscarCuentaPorID($_SESSION['id_cuenta']);
        $cuenta= $compra->getCuenta();
        $mail = new PHPMailer(true);
        try{
        $mail->SMTPDebug = 0;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'moviepassUTN2020@gmail.com';                     // SMTP username
        $mail->Password   = 'mardelplata22';                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mail->Port       = 587;                                    // TCP port to connect to

        //Recipients
        $mail->setFrom('moviepassUTN2020@gmail.com', 'MoviePass');
        $emailToSend = $cuenta->getEmail();
        $mail->addAddress($emailToSend, 'Cuenta');     // Add a recipient
   // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        $mail->Subject = 'Gracias por tu compra en MoviePass.';
         $i=0;  
        foreach ($qrMandar as $item) {                           //ACA ESTA EL ERROR DEL QR EN EL MAIL EL QRMANDAR ESTA VACIO PORQ NO ESTA EN LA BASE DE DATO LA TABLA Y EL DAO NO FUNCIONA
            $tag=$i++;
            $mail->AddEmbeddedImage("QR/temp/qr-".$item.".png",$tag);
           }
           $mail->Body    = '<BODY BGCOLOR="White">
<body>
<div Style="align:center;">
<p> Información de su compra  </p>
<pre>
<p>'."Fecha:". $compra->getFecha() ." </p>
<p>Subtotal:".$compra->getSubtotal()."</p>
<p>Descuento:".$compra->getDescuento()."</p>
<p>Total abonado: " .$compra->getTotal()."</p>".'
</pre>
<p>
</p>
</div>
</br>
<div style=" height="40" align="left">
<font size="3" color="#000000" style="text-decoration:none;font-family:Lato light">
<div class="info" Style="align:left;">           
<br>
<p>MoviePass   </p> 
<br>
</div>
</br>
<p>-----------------------------------------------------------------------------------------------------------------</p>
</br>
</font>
</div>
</body>';


        $mail->send();
        }
        catch (Exceptionn $e) {
            array_push($advices, DB_ERROR . $mail->ErrorInfo);
        }
    }
}