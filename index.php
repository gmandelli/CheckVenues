<?php require "config.php"; ?><!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>

    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=<?php echo GMAPS_API_KEY?>&sensor=true"></script>
        
    <script type="text/javascript" src="assets/js/data.js"></script>


<link rel='stylesheet' id='bootstrap-css'  href='assetscss/bootstrap.css?ver=1.0' type='text/css' media='all' />
<link rel='stylesheet' id='bootstrap-responsive-css'  href='assets/css/responsive.css?ver=1.0' type='text/css' media='all' />

  </head>
  <body>
    <div id="map_canvas" style="width:50%; height:100%; float: left;"></div>
    <div id="formDiv"  style="position: absolute; top: 0px; left: 52%; float: right;">
      <h2>RightClick on the map for setting place searching</h2>

      <form id="checkVenues" name="checkVenues" action="retrieve.php" method="POST">
<table class="table">
<tr>

<td>

<p>
      <label for="radius">Check area in meters:</label>
      <input type="text" id="radius" name="radius" value="1000"/>
</p>

<p>
      <label for="limit">Limit:</label>
      <select id="limit" name="limit">
      <option value="1">1</option>
      <option value="5">5</option>
      <option value="10">10</option>
      <option value="20">20</option>
      <option value="50" selected>50 (max...)</option>
      </select>
</p>

<p>
      <label for="query">Query search:</label>
      <input type="text" id="query" name="query"/>
</p>

<p>      <label for="latField">Latitude:</label>
      <input type="text" id="latField" name="latField"/>
</p>

<p>
      <label for="lngField">Longitude:</label>
      <input type="text" id="lngField" name="lngField"/>
</p>

<p>
      <label for="platform">Platform:</label>
      <select id="platform" name="platform">
       <option value="venues">venues</option>
      </select>
</p>

<p>
      <label for="endpoint">Endpoint:</label>
      <select id="endpoint" name="endpoint">
       <option value="search">search</option>
      </select>
</p>

</td>
<td>
<p>
      <label for="categories">Categories (exp):</label>
      <select id="categories[]" name="categories[]" multiple="multiple" size="20">
      <option value="">All</option>
      <?php include "includes/categories.php"; ?>
      </select>
</p>

</td>
</tr>
<tr>
<td colspan="2">
<p>
      <a href="#" id="sendData" class="btn btn-primary btn-large"/><i class="icon-white icon-play"></i> Check for venues!</a>
      <a href="export/venues.csv" id="checkFile" class="btn btn-warning btn-large" target="_blank"/><i class="icon-white icon-search"></i> Check venues file</a>
      <a href="#" id="resetFile" class="btn btn-danger btn-large"/><i class="icon-white icon-remove-sign"></i> Reset venues file</a>

</p>
</td>
</tr>
</table>
      </form>

    </div>  
  </body>
</html>
