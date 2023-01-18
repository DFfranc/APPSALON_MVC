<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){
        $this -> email = $email;
        $this -> nombre = $nombre;
        $this -> token = $token;
    }

    public function enviarConfirmacion() {
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail -> Host = 'smtp.mailtrap.io';
        $mail -> SMTPAuth = true;
        $mail -> Port = 2525;
        $mail -> Username = '759b8275c9eecd';
        $mail -> Password = '4577c523444d83';

        $mail -> setFrom('cuentas@appsalon.com');
        $mail -> addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail -> Subject = 'Confirma tu cuenta';

        // Set HTML
        $mail -> isHTML(TRUE);
        $mail -> CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this -> nombre . "</strong>. </p> ";
        $contenido .= "<p>Has creado tu cuenta en AppSalon, solo debes confirmarla presionando el siguiente enlace.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token ."'> Confirmar Cuenta </a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= '</html>';

        $mail -> Body = $contenido;

        // Enviar Email
        $mail -> send();
    }

    public function enviarInstrucciones(){
        // Crear el objeto de email
        $mail = new PHPMailer();
        $mail -> isSMTP();
        $mail -> Host = 'smtp.mailtrap.io';
        $mail -> SMTPAuth = true;
        $mail -> Port = 2525;
        $mail -> Username = '759b8275c9eecd';
        $mail -> Password = '4577c523444d83';

        $mail -> setFrom('cuentas@appsalon.com');
        $mail -> addAddress('cuentas@appsalon.com', 'AppSalon.com');
        $mail -> Subject = 'Restablece tu password';

        // Set HTML
        $mail -> isHTML(TRUE);
        $mail -> CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= "<p>Hola <strong>" . $this -> nombre . "</strong>. </p> ";
        $contenido .= "<p>Has solicitado restablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='http://localhost:3000/recuperar?token=" . $this->token ."'> Restablecer password</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje.</p>";
        $contenido .= '</html>';

        $mail -> Body = $contenido;

        // Enviar Email
        $mail -> send();
    }
}