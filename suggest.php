<?php 

// All info submitted from this page will be POSTED back to this page to process then sent to location:thanks.php

//is request method "POST" ?
if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    //trim whitespace before and after before saving post as variable
    //use filter_input (type, name, type of filter)
	
    //replace this with filter_input   $name = $_POST["name"];  //<input type="input" name="name">
    $name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL));
    $details = trim(filter_input(INPUT_POST,"details", FILTER_SANITIZE_SPECIAL_CHARS));

//validation of forms
    if ($name == "" || $email == "" || $details = "") {
	    echo 'Please fill in the required names: Name, email, and details';
	    exit;
    }
	
    //honeypot for bots spam
    if ($_POST["address"] !== "") {
        echo "bad form input";
        exit;
	}
    
    //require phpmailer
    require("inc/phpmailer/PHPMailerAutoload.php");
    require("inc/phpmailer/class.phpmailer.php");
    require("inc/phpmailer/class.smtp.php");
    
    $mail = new PHPMailer;
    //set up SMTP
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.postmarkapp.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'df6f5a3b-8dc6-4652-a465-e8bf94ae7d26';  // SMTP username (postmark api token)
    $mail->Password = 'df6f5a3b-8dc6-4652-a465-e8bf94ae7d26';  // SMTP password
//    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;  
 
    //ValidateAddress() returns true or false
        //check if ValidateAddress is NOT(!) true 
    if (!$mail->ValidateAddress($email)) {
        echo "Invalid Email Address";
        exit;
    }
    
	
	$email_body = "";
	$email_body .= "Name " . $name . "\n";
	$email_body .= "Email " . $email . "\n";
	$email_body .= "Details " . $details . "\n";
	

	//To do : send email
    $mail->setFrom('jezzamon@backinthenow.space', 'Mailer');
//    $mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
    $mail->addAddress('jezzamondev@gmail.com');               // Name is optional
//    $mail->addReplyTo('info@example.com', 'Information');
//    $mail->addCC('cc@example.com');
//    $mail->addBCC('bcc@example.com');

//    $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//    $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = 'Suggestions from ' .$name;
    $mail->Body    = $email_body; 'Here is an email test!!';
//    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        exit;
    } 
    
    //go to thank you message 
	header("location:thanks.php");
}
   
$pageTitle = "Suggest a media item";
$section = "suggest";

include("inc/header.php");
?>
	
	
<!-- ************************************************************************************** -->
<div class="section page">
	<div class="wrapper">
		<h1>Suggest a media item</h1>
		<p>If you think there is something missing, let me know! Complete form to send email.</p>
		<!-- post the form back to own page --> 
		<form method="post" action="suggest.php"> 
			<table>
				<tr>
					<th><label for="name">Name </label></th>
					<td><input type="text" id="name" name="name"></td>
					
				</tr>
				<tr>
					<th><label for="email">Email </label></th>
					<td><input type="text" id="email" name="email"></td>
					
				</tr>
				<tr>
					<th><label for="details">Suggest Item details </label></th>
					<td><textarea name="details" id="details"></textarea></td>
				</tr>
<!--				honeypot for bots spam, won't be shown in browser-->
				<tr style="display:none">
					<th><label for="address">Address </label></th>
					<td><input type="text" name="address" id="address"></input></td>
					<p>Please leave this field blank</p>
				</tr>
				
			</table>
			
			<input type="submit" value="send">
			
		</form>
	</div>
</div>

<?php 
include("inc/footer.php");	
?>