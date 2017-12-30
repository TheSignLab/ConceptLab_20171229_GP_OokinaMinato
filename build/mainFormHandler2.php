<?php
        header('Access-Control-Allow-Origin: *'); 

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP; 
        use PHPMailer\PHPMailer\POP3;
        use PHPMailer\PHPMailer\OAuth;      

        require 'PHPMailer/PHPMailer.php';
        require 'PHPMailer/Exception.php';
        require 'PHPMailer/SMTP.php';
        require 'PHPMailer/POP3.php';
        require 'PHPMailer/OAuth.php';
        

        //require 'class.phpmailer.php';
        

    $Nombre = $_POST['Nombre']; 
    $Empresa = $_POST['Empresa']; 
    $Email = $_POST['Email'];  
    $Telefono = $_POST['Telefono'];
    $Ciudad = $_POST['Ciudad'];
    $Solicitud = $_POST['Solicitud'];
    $Mensaje = $_POST['Mensaje'];
	
	date_default_timezone_set('Etc/UTC');


$mail = new PHPMailer(true); 
$mail -> CharSet = "UTF-8";
try {
    //Server settings
    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'a2plcpnl0847.prod.iad2.secureserver.net';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'info@granportuaria.com';                 // SMTP username
    $mail->Password = 'granportuaria';                           // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 465;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@granportuaria.com', 'Cotizacion por Web');
    //'juanv.gallegos@gmail.com'
    $mail->addAddress('info@granportuaria.com');     // Add a recipient
    //$mail->addAddress('wallamejorge@hotmail.com');  
    $mail->addReplyTo('info@granportuaria.com');
    $mail->addCC('info@granportuaria.com');

    $message = file_get_contents('email_template2.html'); 
    $message = str_replace('%varName%', $Nombre, $message);
    $message = str_replace('%varCompany%', $Empresa, $message);
    $message = str_replace('%varPhone%', $Telefono, $message);  
    $message = str_replace('%varEmail%', $Email, $message); 
    $message = str_replace('%varCity%', $Ciudad, $message); 
    $message = str_replace('%varRequest%', $Solicitud, $message); 
    $message = str_replace('%varMessage%', $Mensaje, $message); 



    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Correo de Contacto por Web  - Gran Portuaria';
    $mail->Body    = 'Contacto';
    $mail->msgHTML($message, dirname(__FILE__));
    $mail->AltBody = 'Contacto';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}    


?>