<?php 

// All info submitted from this page will be POSTED back to this page to process then sent to location:thanks.php

//is request method "POST" ?
if  ($_SERVER["REQUEST_METHOD"] == "POST") {
    //trim whitespace before and after before saving post as variable
    //use filter_input (type, name, type of filter)
	
    //replace this with filter_input   $name = $_POST["name"];  //<input type="input" name="name">
    $name = trim(filter_input(INPUT_POST,"name", FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST,"email", FILTER_SANITIZE_EMAIL));
    $category = trim(filter_input(INPUT_POST, "category", FILTER_SANITZE_STRING));
    $title = trim(filter_input(INPUT_POST, "title", FILTER_SANITZE_STRING));
    $format = trim(filter_input(INPUT_POST, "format", FILTER_SANITZE_STRING));
    $genre = trim(filter_input(INPUT_POST, "genre", FILTER_SANITZE_STRING));
    $year = trim(filter_input(INPUT_POST, "year", FILTER_SANITZE_STRING));
    $details = trim(filter_input(INPUT_POST,"details", FILTER_SANITIZE_SPECIAL_CHARS));

    //validation of forms
    if ($name == "" || $email == "" || $category = "" || $title = "") {
	    $error_message =  'Please fill in the required names: Name, email, category and title';
	    
    }
	
    //honeypot for bots spam
    if ($_POST["address"] !== "") {
        echo "bad form input";
        exit;
	}
    
    //require 3rd party phpmailer, smtp
    
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
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
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
	$email_body .= "Suggested item\n";
    $email_body .= "Category " . $category . "\n";
    $email_body .= "Title " . $title. "\n";
    $email_body .= "Format " . $format . "\n";
    $email_body .= "Genre " . $genre . "\n";
    $email_body .= "Year " . $year . "\n";
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
    $mail->Body    = $email_body;
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
					<th><label for="name">Name (required)</label></th>
					<td><input type="text" id="name" name="name"></td>
					
				</tr>
				<tr>
					<th><label for="email">Email (required)</label></th>
					<td><input type="text" id="email" name="email"></td>
					
				</tr>
				<tr>
					<th><label for="category">Category (required)</label></th>
                    <td><select id="category" name="category">
                            <option value="">Select One</option>
                            <option value="Books">Book</option>
                            <option value="Movies">Movie</option>
                            <option value="Music">Music</option>
                        </select>
                    </td>
				</tr>
				<tr>
					<th><label for="title">Title (required)</label></th>
					<td><input type="text" id="title" name="title"></td>
					
				</tr>
				<tr>
					<th><label for="format">Format </label></th>
                    <td><select id="format" name="format">
                            <option value="">Select One</option>
                            <optgroup label="Books">Book
                                <option value="Audio">Audio</option>
                                <option value="Ebook">Ebook</option>
                                <option value="Hardback">Hardback</option>
                                <option value="Paperback">Paperback</option>
                            </optgroup>
                            <optgroup label="Movies">Movie
                                <option value="Blu-ray">Blu-ray</option>
                                <option value="DVD">DVD</option>
                                <option value="Streaming">Streaming</option>
                                <option value="VHS">VHS</option>
                            </optgroup>
                            <optgroup label="Music">Music
                                <option value="Casette">Cassette</option>
                                <option value="CD">CD</option>
                                <option value="MP3">MP3</option>
                                <option value="Vinyl">Vinyl</option>
                            </optgroup>
                        </select>
                    </td>
				</tr>
				<tr>
                <th>
                    <label for="genre">Genre</label>
                </th>
                <td>
                    <select name="genre" id="genre">
                        <option value="">Select One</option>
                        <optgroup label="Books">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Historical">Historical</option>
                            <option value="Historical Fiction">Historical Fiction</option>
                            <option value="Horror">Horror</option>
                            <option value="Magical Realism">Magical Realism</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Paranoid">Paranoid</option>
                            <option value="Philosophical">Philosophical</option>
                            <option value="Political">Political</option>
                            <option value="Romance">Romance</option>
                            <option value="Saga">Saga</option>
                            <option value="Satire">Satire</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Tech">Tech</option>
                            <option value="Thriller">Thriller</option>
                            <option value="Urban">Urban</option>
                        </optgroup>
                        <optgroup label="Movies">
                            <option value="Action">Action</option>
                            <option value="Adventure">Adventure</option>
                            <option value="Animation">Animation</option>
                            <option value="Biography">Biography</option>
                            <option value="Comedy">Comedy</option>
                            <option value="Crime">Crime</option>
                            <option value="Documentary">Documentary</option>
                            <option value="Drama">Drama</option>
                            <option value="Family">Family</option>
                            <option value="Fantasy">Fantasy</option>
                            <option value="Film-Noir">Film-Noir</option>
                            <option value="History">History</option>
                            <option value="Horror">Horror</option>
                            <option value="Musical">Musical</option>
                            <option value="Mystery">Mystery</option>
                            <option value="Romance">Romance</option>
                            <option value="Sci-Fi">Sci-Fi</option>
                            <option value="Sport">Sport</option>
                            <option value="Thriller">Thriller</option>
                            <option value="War">War</option>
                            <option value="Western">Western</option>
                        </optgroup>
                        <optgroup label="Music">
                            <option value="Alternative">Alternative</option>
                            <option value="Blues">Blues</option>
                            <option value="Classical">Classical</option>
                            <option value="Country">Country</option>
                            <option value="Dance">Dance</option>
                            <option value="Easy Listening">Easy Listening</option>
                            <option value="Electronic">Electronic</option>
                            <option value="Folk">Folk</option>
                            <option value="Hip Hop/Rap">Hip Hop/Rap</option>
                            <option value="Inspirational/Gospel">Insirational/Gospel</option>
                            <option value="Jazz">Jazz</option>
                            <option value="Latin">Latin</option>
                            <option value="New Age">New Age</option>
                            <option value="Opera">Opera</option>
                            <option value="Pop">Pop</option>
                            <option value="R&B/Soul">R&amp;B/Soul</option>
                            <option value="Reggae">Reggae</option>
                            <option value="Rock">Rock</option>
                        </optgroup>
                    </select>
                </td>
                </tr>
                <tr>
					<th><label for="year">Year</label></th>
					<td><input type="text" id="year" name="year"></td>
					
				</tr>
				<tr>
					<th><label for="details">Additional Details </label></th>
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