
      var map;

      var Circle = false;

      var circleOptions;

      var markersArray = [];
      var infoWindowsArray = [];

      function resetArea() {

           if(Circle)
           Circle.setMap(null);

      }

      function resetMarkers() {

           if (markersArray) {
            for (i in markersArray) {
             markersArray[i].setMap(null);
             infoWindowsArray[i].setMap(null);
             }

             markersArray = [];
	     infoWindowsArray = [];
            
           }
      }


$(document).ready(function() {

        var mapOptions = {
          center: new google.maps.LatLng(9.520851, 100.014668),
          zoom: 12,
          draggableCursor:'crosshair',
          mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var map = new google.maps.Map(document.getElementById("map_canvas"),
            mapOptions);

        google.maps.event.addListener(map, "rightclick", function(event) {
      
           var lat = event.latLng.lat();
           var lng = event.latLng.lng();

	    resetArea();
	    resetMarkers();

          circleOptions = {
           strokeColor: "#0000FF",
           strokeOpacity: 0.8,
           strokeWeight: 2,
           fillColor: "#0000FF",
           fillOpacity: 0.35,
           map: map,
           center: event.latLng,
           radius: parseInt($('#radius').val())
           };

           Circle = new google.maps.Circle(circleOptions);

           $('#latField').val(lat);
           $('#lngField').val(lng);

        });


          // form send data and get json response
          $('#sendData').on("click", function(event){
      
	   event.preventDefault();

           $.ajax({
              type: "POST",
              url: "retrieve.php",
              data: $('#checkVenues').serialize(),
              dataType: "json"
           }).done(function( venues ) {

	    resetMarkers();


            $.each(venues, function(key, venue) {
      
               var latlng = new google.maps.LatLng(venue.location.lat,venue.location.lng);

	       //info window
	       //alert(venue.name);

	       venueO = new Object();

	       s = "";

	       venueO.id = venue.id;
	       venueO.name = venue.name;

	       venueO.email = ""; //added

	       venueO.twitter = venue.contact.twitter;
	       
	       venueO.facebook = ""; //added
	       //venueO.phone = venue.contact.phone;
	       venueO.formattedPhone = venue.contact.formattedPhone;
	       
	       venueO.address = venue.location.address;
	       venueO.crossStreet = venue.location.crossStreet;
	       venueO.city = venue.location.city;
	       venueO.state = venue.location.state;
	       venueO.postalCode = venue.location.postalCode;
	       venueO.country = venue.location.country;

	       venueO.hours = venue.hours;

	       venueO.lat = venue.location.lat;
	       venueO.lng = venue.location.lng;
	      
	       venueO.categories = [];

	       $.each(venue.categories, function(keyc, valc) { 

		       venueO.categories.push(valc.name); 
	
		   });

	       venueO.categories = venueO.categories.join(",");

	       venueO.url = venue.url;
	       venueO.video = ""; //added

	       // add multi city support
	       venueO.post_city_id = "1"; //added

	       venueO.description = ""; //added

	       venueO.tags = ""; //added
	
	       // for venue details add request 

       
	       s = "<form id=\"form"+key+"\" name=\"form"+key+"\">";

	       s = s + "<input type=\"hidden\" id=\"key\" name=\"key\" value=\""+key+"\">";

	       $.each(venueO, function(keyv, val) { 

		       if ( keyv == "id" || keyv == "categories" || keyv == "post_city_id" ) {
			   
			   s = s + "<input type=\"hidden\" id=\""+keyv+key+"\" name=\""+keyv+key+"\" value=\""+val+"\"><br>"; 

		       }

			   if ( keyv == "categories" ) {
			   
    		              s = "<p>"+s + keyv+": "+val+"<p>"; 
			   }
			   else {
			       
			       s = s + "<label for=\""+keyv+key+"\">"+keyv+"</label>";
			       
			       if ( val != undefined )   
				   s = s + "<input type=\"text\" id=\""+keyv+key+"\" name=\""+keyv+key+"\" value=\""+val+"\"><br>"; 
			        else
				   s = s + "<input type=\"text\" id=\""+keyv+key+"\" name=\""+keyv+key+"\" value=\"\"><br>"; 
			   }
		   });

	       s  = s + "<a href=\"javascript:save('form"+key+"');\" id=\"saveVenue"+key+"\" class=\"btn btn-primary btn-large\"><i class=\"icon-white icon-plus\"></i> Insert data</a></form>";

	       infoWindow = new google.maps.InfoWindow({
		       content: s
	       });

               marker = new google.maps.Marker({
               position: latlng,
               title: venue.name,
		   map: map,
		   draggable: true,	   
		   animation: google.maps.Animation.DROP
	       });

               markersArray.push(marker);

               infoWindowsArray.push(infoWindow);

		});

	    $.each(markersArray, function(key, marker) {

	            google.maps.event.addListener(markersArray[key], 'click', function() {

		       infoWindowsArray[key].open(map,markersArray[key]);

	            });

		    google.maps.event.addListener(markersArray[key], 'dragend', function() { 

			    // if infowindow not shown -> BUG
			    $('#lat'+key).val(markersArray[key].getPosition().lat());
			    $('#lng'+key).val(markersArray[key].getPosition().lng());

		    } );


		});

	       });
      
	      });


          // reset venues file
          $('#resetFile').on("click", function(event){

		  event.preventDefault();

		  $.ajax({
			  type: "GET",
			  url: "resetFile.php",
			  dataType: "text"
			      }).done(function( result ) {
		   alert(result);
	       });
	      
	      });

    });

function save(form) {

           $.ajax({
              type: "POST",
              url: "appendFile.php",
              data: $('#'+form).serialize(),
              dataType: "text"
           }).done(function( result ) {

		   alert(result);

	       });
	       

}
