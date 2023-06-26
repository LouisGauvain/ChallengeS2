<?php

namespace App\Controllers;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

$doteEnv = Dotenv::createImmutable(__DIR__ . "/../");
$doteEnv->load();

include 'PHPMailer/src/Exception.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/SMTP.php';

use App\Core\Utils;

class PhpMailor
{
    private $mail;
    private $firstname;
    private $lastname;
    private $token;

    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function setLastname($lastname)
    {
        $this->lastname  = $lastname;
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function sendMail()
    {
        $link = $_ENV['APP_URL'] . "/verify/" . $this->token;
        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'louisgauvainpro@gmail.com';
        $mail->Password   = 'jnoafumntdvjhxsd';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;
        $mail->CharSet = 'UTF-8';
        $mail->setFrom("tnl@myges.fr", "TNL");
        $mail->addAddress($this->mail, $this->firstname . " " . $this->lastname);
        $mail->isHTML(true);
        $mail->Subject = "Bienvenue sur TNL " . $this->firstname . " " . $this->lastname . " !";
        $mail->Body    = "Pour vérifier votre compte, veuillez cliquer sur le lien suivant : " . "<br>" . "<br>" . "<a href='" . $link . "'>" . $link . "</a>";
        try {
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
