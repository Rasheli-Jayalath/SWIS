<?php
require_once("config/config.php");
function sendemail($subject, $message) {
echo SITE_PATH;
require(SITE_PATH.'email/class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPAuth = true;
$mail->Host = "mail.egcpakistan.com";
$mail->Port = 25;
$mail->IsHTML(true);
$mail->Username = "mussawar@egcpakistan.com";
$mail->Password = "Tenders@2010";
$mail->SetFrom("mussawar@egcpakistan.com", "T4M&E");
$mail->Subject = $subject;
$mail->Body = $message;
$mail->AddAddress("tahira_cs@hotmail.com");
//$file_name="Daily_Report.pdf";
//$path= $_SERVER['DOCUMENT_ROOT']."/SaafPani/".$file_name;
//$mail->addAttachment($path,$file_name);
 if(!$mail->Send())
    {
    echo  "Mailer Error: " . $mail->ErrorInfo;
    }
    else
    {
    echo "Message has been sent";
    }
}
$subject = "This is test email";
 $message = "kjh kj kjh kh klj hkj h;k h;l kh;lk ;lkk hl; h;h;hlkhlkh lk lk lklhlkhhlk hlkh";
sendemail($subject, $message);
?>