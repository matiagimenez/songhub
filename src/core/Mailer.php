<?php

namespace Songhub\core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mailer
{
    use Loggable;
    private static $instance;
    private $mailer;
    private $user;
    private $password;

    private function __construct()
    {
        $logger = LoggerBuilder::getInstance()->getLogger();
        $this->setLogger($logger);
    }


    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
            $mailer = new PHPMailer(true);

            $config = Config::getInstance();

            $smtp_user = $config->get("SMTP_USER");

            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  // Enable verbose debug output
            $mail->isSMTP();                                        //Send using SMTP
            $mail->Host       = $config->get("SMTP_HOST");          //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                               //Enable SMTP authentication
            $mail->Username   = $config->get("SMTP_USER");                         //SMTP username
            $mail->Password   = $config->get("SMTP_PASSWORD");                     //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            $mail->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        }

        return self::$instance;
    }

    public function sendEmail($to, $subject, $body) {
        try {

            $config = Config::getInstance();
            $mail->setFrom($config->get("SMTP_USER"), 'Songhub');

            $mail->addAddress('to@example.com');

            $mail->isHTML(true);                                  
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
        
            $mail->send();

            $this->logger->info("Message sent to " . $to);
            return true;
        } catch (Exception $e) {
            $this->logger->error("Message could not be sent. Mailer Error", ["ERROR" => $mail->ErrorInfo]);
            return false;
        }
    }
}







