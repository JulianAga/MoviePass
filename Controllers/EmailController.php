<?php namespace Controllers;






class EmailController
{
	
	
	public function __construct()
	{	
			
	}


	public function sendEmail ()
	{
		ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "test@hostinger-tutorials.com";
        $to = "leonel_473@hotmail.com";
        $subject = "Checking PHP mail";
        $message = "PHP mail works just fine";
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "The email message was sent.";
		
	}






}
?>