<?php
namespace Email;


class email
{

    public static function msg($fromName,$from,$reply, $to, $toName, $cc, $bcc, $subject,$attach, $body, $altbody){
        global  $host;
        global  $username;
        global  $password;

        $mail = new PHPMailer(true);
        $mail->SMTPDebug = 0;               // Enable verbose debug output
        $mail->isSMTP();                    // Set mailer to use SMTP
        $mail->Host = $host;                // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;             // Enable SMTP authentication
        $mail->Username = $username;        // SMTP username
        $mail->Password = $password;        // SMTP password
        $mail->SMTPSecure = 'tls';          // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 587;
        $mail->From = $from;
        $mail->FromName = $fromName;


        if(!empty($toName)){
            $mail->addAddress($to, $toName);
        }else{
            $mail->addAddress($to);
        }


        if(!empty($reply)){
            $mail->addReplyTo($reply, "Reply");
        }
        if(!empty($attach)){
            $mail->addAttachment($attach);
        }

        if(!empty($cc)){
            $mail->addCC($cc);
        }
        if(!empty($bcc)){
            $mail->addBCC($bcc);
        }


        $mail->isHTML(true);

        $mail->Subject = $subject;
        $mail->Body = $body;//body can be constructed using html
        $mail->AltBody = $altbody;

        if(!$mail->send())
        {
            return "Mailer Error: " . $mail->ErrorInfo;
        }
        else
        {
            return true;
        }
    }
}