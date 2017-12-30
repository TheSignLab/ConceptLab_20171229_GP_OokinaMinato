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
        

	$CiudadOrigen = $_POST['CiudadOrigen']; 
	$CiudadDestino = $_POST['CiudadDestino']; 
	$TipoContainer = $_POST['TipoContainer'];
        $TipoCarga = $_POST['TipoCarga'];
	$MedidaAlto = $_POST['MedidaAlto']." m"; 
	$MedidaAncho = $_POST['MedidaAncho']." m"; 
	$MedidaFondo = $_POST['MedidaFondo']." m";  
	$MedidaPeso = $_POST['MedidaPeso']." m";
        $CED = $_POST['CED'];
        $MP = $_POST['MP'];  
	$TOTM = $_POST['TOTM']; 
	$TA= $_POST['TA']; 
	$TM = $_POST['TM']; 
	$TTU = $_POST['TTU'];
	$TTN = $_POST['TTN']; 
	$TTI = $_POST['TTI']; 
	$D = $_POST['D']; 
	$A = $_POST['A'];
	$AGE = $_POST['AGE'];
	$Nombre = $_POST['Nombre']; 
	$Empresa = $_POST['Empresa']; 
	$Email = $_POST['Email'];  
	$Telefono = $_POST['Telefono'];
$Costo = $_POST['CostoCarga'];
	
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
    $mail->addAddress('acastro@granportuaria.com.co');     // Add a recipient
    //$mail->addAddress('wallamejorge@hotmail.com');  
    $mail->addReplyTo('info@granportuaria.com');
    $mail->addCC('jmalarcon@granportuatia.com.co');

    $message = file_get_contents('email_template.html'); 
    $message = str_replace('%varName%', $Nombre, $message);
    $message = str_replace('%varCompany%', $Empresa, $message); 
    $message = str_replace('%varEmail%', $Email, $message); 
    $message = str_replace('%varPhone%', $Telefono, $message); 

$message = str_replace('%varAlto%', $MedidaAlto, $message); 
$message = str_replace('%varAncho%', $MedidaAncho, $message); 
$message = str_replace('%varFondo%', $MedidaFondo, $message);  
$message = str_replace('%varPeso%', $MedidaPeso, $message);

$message = str_replace('%varOrigen%', $CiudadOrigen, $message); 
$message = str_replace('%varDestino%', $CiudadDestino, $message); 
$message = str_replace('%varTipo%',$TipoContainer, $message);
$message = str_replace('%varCarga%',$TipoCarga, $message);  
	
	$message = str_replace('%varCosto%',$Costo, $message);  



if($CED == "true"){
    $message = str_replace('%varHTML_CED%', ' <li>Carga Extra Dimensionada &#x2713;</li><br>', $message); 
}
else{
    $message = str_replace('%varHTML_CED%', '', $message);
}
if($MP == "true"){
    $message = str_replace('%varHTML_MP%', ' <li> Material Peligroso &#x2713;</li><br>', $message); 
}
else{
    $message = str_replace('%varHTML_MP%', '', $message);
}


if($TOTM == "true"){
    $message = str_replace('%varHTML_TOTM%', ' <li>Transporte OTM &#x2713;</li><br>', $message); 
}
else{
    $message = str_replace('%varHTML_TOTM%', '', $message);
}

if($TA == "true"){
    $message = str_replace('%varHTML_TA%', ' <li>Transporte Aereo &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_TA%', '', $message);
}

if($TM == "true"){
    $message = str_replace('%varHTML_TM%', ' <li>Transporte Maritimo &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_TM%', '', $message);
}


if($TTU == "true"){
    $message = str_replace('%varHTML_TTU%', ' <li>Transporte Terrestre Urbano &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_TTU%', '', $message);
}


if($TTN == "true"){
    $message = str_replace('%varHTML_TTN%', ' <li>Transporte Terrestre Nacional &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_TTN%', '', $message);
}


if($TTI == "true"){
    $message = str_replace('%varHTML_TTI%', ' <li>Transporte Terrestre Internacional &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_TTI%', '', $message);
}


if($D == "true"){
    $message = str_replace('%varHTML_D%', ' <li>Distribución &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_D%', '', $message);
}

if($A == "true"){
    $message = str_replace('%varHTML_A%', ' <li>Almacenaje &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_A%', '', $message);
}

if($AGE == "true"){
    $message = str_replace('%varHTML_AGE%', ' <li>Alquiler de Generadores Eléctricos  &#x2713;</li>', $message); 
}
else{
    $message = str_replace('%varHTML_AGE%', '', $message);
}




    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Cotización Automatica por Web  - Gran Portuaria';
    $mail->Body    = 'Cotización de '.$Nombre.' ';
    $mail->msgHTML($message, dirname(__FILE__));
    $mail->AltBody = 'Cotización de '.$Nombre.' ';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo '<br>';
    $message = file_get_contents('email_template.html'); 
    echo 'Mensaje s: '. $message;
}    


?>