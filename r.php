<?php
// Including the controller class to get access to all functionality
include 'includes/classes/ShortController.class.php';
$sc = new ShortController();

// If user is using the short url
if(!empty($_GET['x'])){
	// See if short url exists
	$clean_str = FilterData::filterUrl($_GET['x']);
	$string_exists = $sc->short->getShortUrl($clean_str);
	if($string_exists){
		// Add new click
		$sc->short->updateClick($clean_str);
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: " . $string_exists[0]['long_url']);
	}else{
		// Show error message if URL does not exist
		$error_message = "Short URL " . $clean_str . " does not exist.";
	}
}

// Setting a short url
if(!empty($_POST['long_url'])){
	$clean_url = FilterData::filterUrl($_POST['long_url']);
	$string_exists = true;
	// Checking if random url already exists, if so create another one
	while($string_exists !== false){
		$random_string = $sc->short->createRandomString();
		$string_exists = $sc->short->getShortUrl($random_string);
	}
	$sc->short->setNewShortUrl($random_string,$clean_url);
}
// Getting all short urls to be displayed in the view
$all_short_urls = $sc->short->getAllUrls();
include 'includes/views/view_url_shortner.php';
?>