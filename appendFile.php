<?php

// row comma separated, enclosed by "
// Post Title,Post Content,Post Category,post_tags,video,address,geo_latitude,geo_longitude,timing,contact,email,website,twitter,facebook,post_city_id,IMAGE,IMAGE,IMAGE,IMAGE,IMAGE,customfield1,customfield2,customfield3


if ( isset($_POST) ) {

if ( $_POST["address".$_POST["key"]] == "" ) $cs = $_POST["crossStreet".$_POST["key"]]; else $cs = " (".$_POST["crossStreet".$_POST["key"]].")";
if ($_POST["crossStreet".$_POST["key"]] != "") $_POST["address".$_POST["key"]] .= $cs ;

if ( $_POST["address".$_POST["key"]] == "" ) $c = ""; else $c = ", ";

if ( $_POST["city".$_POST["key"]] != "" ) $_POST["address".$_POST["key"]] .= $c.$_POST["city".$_POST["key"]];

if ( $_POST["address".$_POST["key"]] == "" ) $c = ""; else $c = ", ";

if ( $_POST["state".$_POST["key"]] != "" ) $_POST["address".$_POST["key"]] .= $c.$_POST["state".$_POST["key"]];

if ( $_POST["postalCode".$_POST["key"]] != "" ) $_POST["address".$_POST["key"]] .= " ".$_POST["postalCode".$_POST["key"]];
if ( $_POST["country".$_POST["key"]] != "" && $_POST["country".$_POST["key"]] != $_POST["state".$_POST["key"]] ) $_POST["address".$_POST["key"]] .= " | ".$_POST["country".$_POST["key"]];


$fields = array($_POST["name".$_POST["key"]], 
	        $_POST["description".$_POST["key"]], 
		$_POST["categories".$_POST["key"]], 
		$_POST["tags".$_POST["key"]], 
		$_POST["video".$_POST["key"]], 
		$_POST["address".$_POST["key"]], 
		$_POST["lat".$_POST["key"]], 
		$_POST["lng".$_POST["key"]], 
		$_POST["hours".$_POST["key"]], 
		$_POST["formattedPhone".$_POST["key"]], 
		$_POST["email".$_POST["key"]], //email 
		$_POST["url".$_POST["key"]], 
		$_POST["twitter".$_POST["key"]], 
		$_POST["facebook".$_POST["key"]], 
		$_POST["post_city_id".$_POST["key"]], 
		$_POST["id".$_POST["key"]]
		
		//IMAGES
		
		);

// security check
if ( count($fields) != 16 ) exit();

for($i=0;$i<count($fields);$i++) {

	$fields[$i] = str_replace("\"","'",$fields[$i]);			   

}

//var_dump($fields);

$fp = fopen('export/venues.csv', 'ab');

if ( fwrite($fp,'"' . implode('","', $fields) . '"' . "\n") ) echo "Venue saved";

else echo "Error writing file...";

fclose($fp);

clearstatcache('export/venues.csv');

}

?>