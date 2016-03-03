<?php
$pageTitle = "Suggest a media item";
$section = "suggest";

include("inc/header.php");
?>
	
<div class="section page">
	<div class="wrapper">
		<h1>Suggest a media item</h1>
		<p>If you think there is something missing, let me know! Complete form to send email.</p>
		<form method="post" action="process.php">
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
				
			</table>
			
			<input type="submit" value="send">
			
		</form>
	</div>
</div>

<?php 
include("inc/footer.php");	
?>