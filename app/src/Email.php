<?php

namespace App\src;

use App\templates\Template;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

class Email
{

    private $data;
    private $template;
    

    private function config()
    {
        return (object) Load::file('/config.php');
    }

    public function data(array $data): self
    {
        $this->data = (object) $data;
        
        return $this;
    }

    public function template(Template $template)
    {
        if (!isset($this->data)) {
            throw new \Exception('Antes de chamar o template, passe os dados através do método data');
        }

        $this->template = $template->run($this->data);

        return $this;
    }

    public function send()
    {

        if (!isset($this->template)) {
            throw new \Exception("Por favor, antes de enviar o email, escolha um template o método template");
        }

        $mailer = new PHPMailer();

        $config = (object) $this->config()->email;

        //Server settings
        $mailer->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mailer->isSMTP();                                            // Send using SMTP
        $mailer->Host       = $config->host;                    // Set the SMTP server to send through
        $mailer->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mailer->Username   = $config->username;                     // SMTP username
        $mailer->Password   = $config->password;                               // SMTP password
        $mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
        $mailer->Port       = $config->port;                                    // TCP port to connect to
        $mailer->CharSet    = "UTF-8";           

        //Recipients
        $mailer->setFrom($this->data->fromEmail, $this->data->fromName); 
        $mailer->addAddress($this->data->toEmail, $this->data->toName);     // Para quem eu estou enviando
      
        // Content
        $mailer->isHTML(true);                                  // Set email format to HTML
        $mailer->Subject =  $this->data->assunto;
        $mailer->Body    = $this->template;
        $mailer->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mailer->send();
    }
}