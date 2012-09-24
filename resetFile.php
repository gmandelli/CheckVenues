<?php

unlink("export/venues.csv");

// row comma separated, enclosed by "
// Post Title,Post Content,Post Category,post_tags,video,address,geo_latitude,geo_longitude,timing,contact,email,website,twitter,facebook,post_city_id,IMAGE,IMAGE,IMAGE,IMAGE,IMAGE,customfield1,customfield2,customfield3

$fields = array("Post Title", "Post Content", "Post Category", "post_tags", "video", "address", "geo_latitude", "geo_longitude", "timing", "contact", "email", "website", "twitter", "facebook", "post_city_id", "venue_id");

$fp = fopen('export/venues.csv', 'w');

if ( fwrite($fp,'"' . implode('","', $fields) . '"' . "\n") ) echo "File resetted";
else
echo "Error writing file...";

fclose($fp);

clearstatcache('export/venues.csv');

?>