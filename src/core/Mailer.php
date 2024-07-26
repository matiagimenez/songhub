<?php

namespace Songhub\core;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Songhub\core\traits\Loggable;

class Mailer
{
    use Loggable;
    private static $instance;
    private static $mail;
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
            self::$mail = new PHPMailer(true);

            $config = Config::getInstance();

            $smtp_user = $config->get("SMTP_USER");

            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                  // Enable verbose debug output
            self::$mail ->isSMTP();                                        //Send using SMTP
            self::$mail ->Host       = $config->get("SMTP_HOST");          //Set the SMTP server to send through
            self::$mail ->SMTPAuth   = true;                               //Enable SMTP authentication
            self::$mail ->Username   = $config->get("SMTP_USER");                         //SMTP username
            self::$mail ->Password   = $config->get("SMTP_PASSWORD");                     //SMTP password
            self::$mail ->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;        //Enable implicit TLS encryption
            self::$mail ->Port       = 465;                                //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        }

        return self::$instance;
    }

    public function sendEmail($to, $subject, $body) {
        try {

            $config = Config::getInstance();
            self::$mail->setFrom($config->get("SMTP_USER"), 'Songhub');

            self::$mail->addAddress($to);

            self::$mail->isHTML(true);                                  
            self::$mail->Subject = $subject;
            self::$mail->Body    = $body;
        
            self::$mail->send();

            $this->logger->info("Message sent to " . $to);
            return true;
        } catch (Exception $e) {
            $this->logger->error("Message could not be sent. Mailer Error", ["ERROR" => $mail->ErrorInfo]);
            return false;
        }
    }
}







