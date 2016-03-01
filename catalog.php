<?php 
include("inc/data.php");  //load in $catalog array
include("inc/functions.php"); //load in functions array_category, get_item_html

$pageTitle = "Full catalogue";
$section = null;

if (isset($_GET["cat"])) {
	if ($_GET["cat"] == "books") {
		$pageTitle = "Books";
		$section = "books";
		} else if ($_GET["cat"] == "movies") {
		$pageTitle = "Movies";
		$section = "movies";
		} else if ($_GET["cat"] == "music") {
		$pageTitle = "Music";
		$section = "music";
		}
}
include("inc/header.php"); 
?>

<div class="section catalog page">
	<div class="wrapper">
		<h1><?php
//			if $section is not separated by category (null)
			if ($section != null) {
				echo "<a href = 'catalog.php'> Full Catalogue</a> &gt; ";
			}
			echo $pageTitle; ?></h1>
		
		<ul class="items">
			<?php
//				$section variable based on conditional statement above,  store in $categories
				$categories = array_category($catalog,$section); 
						foreach($categories as $id) {
						echo get_item_html($id, $catalog[$id]);
						} 
			?>
		</ul>	
	</div>
	
</div>

<?php include("inc/footer.php"); ?>