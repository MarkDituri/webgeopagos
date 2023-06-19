<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;
// include 'Libraries/phpmailer/Exception.php';
// include 'Libraries/phpmailer/PHPMailer.php';
// include 'Libraries/phpmailer/SMTP.php';

// function sendEmail($data, $template)
// {    
//     if (ENVIRONMENT == 1) {
//         $asunto = $data['asunto'];
//         $emailDestino = $data['email'];
//         $empresa = NOMBRE_REMITENTE;
//         $remitente = EMAIL_REMITENTE;
//         $emailCopia = !empty($data['emailCopia']) ? $data['emailCopia'] : "";
//         //ENVIO DE CORREO
//         $de = "MIME-Version: 1.0\r\n";
//         $de .= "Content-type: text/html; charset=UTF-8\r\n";
//         $de .= "From: {$empresa} <{$remitente}>\r\n";
//         $de .= "Bcc: $emailCopia\r\n";
//         ob_start();
//         require_once("Views/Template/Email/" . $template . ".php");
//         $mensaje = ob_get_clean();
//         $send = mail($emailDestino, $asunto, $mensaje, $de);
//         return $send;
//     } else {        
//         //Create an instance; passing `true` enables exceptions
//         $mail = new PHPMailer(true);
//         ob_start();
//         require_once("Views/Template/Email/" . $template . ".php");
//         $mensaje = ob_get_clean();

//         try {
//             //Server settings
//             $mail->SMTPDebug = 0;                      //Enable verbose debug output
//             $mail->isSMTP();                                            //Send using SMTP
//             $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
//             $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//             $mail->Username   = 'no_reply@qudimar.com';          //SMTP username
//             $mail->Password   = 'Qudimark2022!!';                               //SMTP password
//             $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//             $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//             //Recipients
//             $mail->setFrom('no_reply@qudimar.com', 'Qudimar');
//             $mail->addAddress($data['email']);     //Add a recipient
//             if (!empty($data['emailCopia'])) {
//                 $mail->addBCC($data['emailCopia']);
//             }
//             $mail->CharSet = 'UTF-8';
//             //Content
//             $mail->isHTML(true);                                  //Set email format to HTML
//             $mail->Subject = $data['asunto'];
//             $mail->Body    = $mensaje;

//             $mail->send();
//             return true;
//         } catch (Exception $e) {
//             return false;
//         }
//     }
// }

?>