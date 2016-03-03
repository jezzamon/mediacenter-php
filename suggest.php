<?php 
if  ($_SERVER["REQUEST_METHOD"] == "POST") {
 //trim whitespace before and after before saving post as variable
//use filter_input (type, name, type of filter)
	
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
	echo "<pre>";
	$email_body = "";
	$email_body .= "Name " . $name . "\n";
	$email_body .= "Email " . $email . "\n";
	$email_body .= "Details " . $details . "\n";
	echo $email_body;
	echo "</pre>";

	//To do : send email
	header("location:thanks.php");
}
   
$pageTitle = "Suggest a media item";
$section = "suggest";

include("inc/header.php");
?>
	
<div class="section page">
	<div class="wrapper">
		<h1>Suggest a media item</h1>
		<p>If you think there is something missing, let me know! Complete form to send email.</p>
		<form method="post" action="suggest.php"> <!-- post the form back to own page -->
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