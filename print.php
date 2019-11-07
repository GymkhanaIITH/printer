<?php
if(isset($_POST['print']))
{

session_start();
require 'common.php';
$path=$_SESSION['path'];

//$to = 'gymkhanaPrint@print.epsonconnect.com';
$to = 'ee18btech11013@iith.ac.in';
//$from = 'gymkhanaprinter@gmail.com';
$from='divyanshmaduriya02@gmail.com';
$fromName = 'gymkhana Printer';
$subject = 'attachment'; 
$file=$path;

$htmlContent = '';

$headers = "From: $fromName"." <".$from.">";

$semi_rand = md5(time()); 
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";

$headers .= "\nMIME-Version: 1.0\n" . "Content-Type: multipart/mixed;\n" . " boundary=\"{$mime_boundary}\""; 


$message = "--{$mime_boundary}\n" . "Content-Type: text/html; charset=\"UTF-8\"\n" .
"Content-Transfer-Encoding: 7bit\n\n" . $htmlContent . "\n\n"; 


if(!empty($file) > 0){
    if(is_file($file)){
        $message .= "--{$mime_boundary}\n";
        $fp =    @fopen($file,"rb");
        $data =  @fread($fp,filesize($file));

        @fclose($fp);
        $data = chunk_split(base64_encode($data));
        $message .= "Content-Type: application/octet-stream; name=\"".basename($file)."\"\n" . 
        "Content-Description: ".basename($file)."\n" .
        "Content-Disposition: attachment;\n" . " filename=\"".basename($file)."\"; size=".filesize($file).";\n" . 
        "Content-Transfer-Encoding: base64\n\n" . $data . "\n\n";
    }
}

$message .= "--{$mime_boundary}--";
$returnpath = "-f" . $from;


if(mail($to, $subject, $message, $headers, $returnpath)){
echo"<h1>Task Complete</h1><br><h1>WAIT FOR 10-20 SEC<>";

}

else{
echo"failed";
}
//echo $mail?"<h1>task complete...wait for 10-20 seconds</h1>":"<h1>Mail sending failed.</h1>";
}
              
  
?>
