<?php

namespace app\src;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail{
    public function send(){
        $dados['msg'] = "Olá, esta mensagem tem como objetivo testar o PHPMailer!";
        $arquivo_email = file_get_contents('../templates/template.php');
        //substitui no arquivo a variavel %MENSAGEM% com os dados trazidos no array na posição texto
        $arquivo_email = str_replace('%MENSAGEM%', $dados['msg'], $arquivo_email);

        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->CharSet = 'UTF-8';
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            $mail->Username   = 'renangomespoggian@gmail.com';                     // SMTP username
            $mail->Password   = 'renanebruna';                               // SMTP password
            $mail->SMTPSecure = 'tls';      // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                 )
                );
        
            //Recipients
            $mail->setFrom('nicepoggian@gmail.com', 'Valdenice');
            $mail->addReplyTo('renanpoggiangomes@hotmail.com');
			$mail->addAddress('renanpoggiangomes@gmail.com', 'Renan');  
            
            //$mail->AddEmbeddedImage('../assets/img/download.jpg', 'img-cabecalho', 'flamingo.jpg');

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Teste PHPMailer';
            $mail->Body    = $arquivo_email;
            $mail->AltBody = $arquivo_email;
        
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}