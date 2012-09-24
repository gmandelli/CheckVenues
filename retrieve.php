<?php 

        require "config.php";
	require_once("./includes/FoursquareAPI.class.php");

	// Set your client key and secret
	$client_key = FS_API_CLIENT_KEY;
	$client_secret = FS_API_CLIENT_SECRET;

	// Load the Foursquare API library
	$foursquare = new FoursquareAPI($client_key,$client_secret);
	

	// Prepare parameters

	$params = array("ll"=>$_POST['latField'].",".$_POST['lngField'],
		        "intent"=>"browse",
			"radius"=>$_POST['radius']
			);

	if ( $_POST["query"] != "" ) $params["query"] = $_POST["query"];		
	
	if ( count($_POST["categories"]) > 0 ) $params["categoryId"] = implode(",",$_POST["categories"]);		
	
	if ( ctype_digit($_POST["limit"]) ) $params["limit"] = $_POST["limit"];		

	// Perform a request to a public resource
	$datas = $foursquare->GetPublic($_POST["platform"]."/".$_POST["endpoint"],$params);

	$datas = json_decode($datas);

	if ( $datas->meta->code == "200" )

	  print_r(json_encode($datas->response->venues));


/*

	if (is_array($datas->response->venues))
	foreach ($datas->response->venues as $venue) {

		print_r(json_encode($venue));

	}
*/
?>