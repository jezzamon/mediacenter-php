<!--Include header partial-->
<?php 
include("inc/data.php"); //load in $catalog array
include("inc/functions.php"); //load in functions array_category(), get_item_html()

$pageTitle = "Jerry's Media Library";
$section = null;

include("inc/header.php"); ?>
	
		<div class="section catalog random">

			<div class="wrapper">

				<h2>May we suggest something?</h2>

				<ul class="items">
					<?php 
						$random = array_rand($catalog,4);  //return a set of randomized array of 4
						
//						foreach($random as $id) {
//						echo get_item_html($id, $catalog[$id]);

//						foreach($catalog as $id=>$item) {  //this will loop through whole array
//						echo get_item_html($id,$item);		
//						}

//						run array_category function, store in $categories
						$categories = array_category($catalog,$section);  //store selected category
						foreach($categories as $id) {
						echo get_item_html($id, $catalog[$id]);
						} 
						 
					?>						
				</ul>

			</div>

		</div>
<!--Include footer partial-->
<?php include("inc/footer.php"); ?>