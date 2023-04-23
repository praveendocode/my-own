
<?php
$statusMsg='';
if(isset($_FILES["attachment"]["name-3"])){
   $email = $_POST['email-2'];
    $name = $_POST['name-3'];
    $phone = $_POST['Phone-number'];
    $company = $_POST['Company-Name'];
$fromemail =  $email;
$subject="Uploaded file attachment";
$email_message = '<h2>Contact Request Submitted</h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Phone number:</b> '.$phone.'</p>
                    <p><b>Company name:</b><br/>'.$company.'</p>';
$email_message.="Please find the attachment";
$semi_rand = md5(uniqid(time()));
$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
 
    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";
 
if($_FILES["attachment"]["name-3"]!= ""){  
	$strFilesName = $_FILES["attachment"]["name-3"];  
	$strContent = chunk_split(base64_encode(f($_FILES["attachment"]["tmp_name"])));  
	
	
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";
 
 
    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";
}
$toemail="praveenkumar.masters@gmail.com";	
 
if(mail($toemail, $phone, $email_message, $headers)){
   $statusMsg= "Email send successfully with attachment";
}else{
   $statusMsg= "Not sent";
}
}
   ?>