<?php
function get_item_html($id,$item) {
	$output =  "<li><a href='details.php?id="
		. $id . "'><img src='" 
		. $item["img"] . "' alt='" 
		. $item["title"] . "' />" 
		. "<p>view Details</p>"
		. "</a></li>";
	return $output;
}

function array_category($catalog, $category) {

	//create empty array
	$output = array();
	
	
	foreach ($catalog as $id => $item) {
		//if category is null OR matches a category 
		if ($category == null OR strtolower($category) == strtolower($item["category"])) {
			$sort = $item["title"]; //get title name and hold in variable
			$sort = ltrim($sort, "The ");
			$sort = ltrim($sort, "A ");
			$sort = ltrim($sort, "An ");
			$output[$id] = $sort;   //add title to array
		}
	}
	
	//sort array using built-in sort function
	asort($output);
	
	//return all keys
	return array_keys($output);
	
}