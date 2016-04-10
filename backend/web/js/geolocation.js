var latRes  = $("input[name='Locations[lat]']").val(),
    lngRes  = $("input[name='Locations[lng]']").val(),
    locCtry = $("input[name='Locations[country]']").val(),
    locDis  = $("input[name='Locations[district]']").val(),
    locCity = $("input[name='Locations[city]']").val(),
    locExct = $("input[name='Locations[location_name]']").val();

var latResPres  = $("input[name='LocationPresentation[lat]']").val(),
    lngResPres  = $("input[name='LocationPresentation[lng]']").val();

var lat = $('#control_input_lat').val(),
  lng   = $('#control_input_lng').val(),
  ctr   = $('#control_input_country').val(),
  dis   = $('#control_input_region').val(),
  cty   = $('#control_input_city').val(),
  ext   = $('#control_input_locationName').val();

latRes = latRes!='' ? latRes : lat;
lngRes = lngRes!='' ? lngRes : lng;
locCtry = locCtry!='' ? locCtry : ctr;
locDis = locDis!='' ? locDis : dis;
locCity = locCity!='' ? locCity : cty;
locExct = locExct!='' ? locExct : ext;

var myCity = new google.maps.Circle({
    center:new google.maps.LatLng(latRes,lngRes),
    radius:2000,
    fillColor:"#000000",
    fillOpacity:0.1,
    strokeColor:"#2196F3",
    strokeOpacity:0.8,
    strokeWeight:1,
    editable: true,
  });


var cov = $("input[name='PresentationsSearch[coverage]']").val(),
    cov_with = $("input[name='PresentationsSearch[coverage_within]']").val();

var myCitySearch = new google.maps.Circle({
    center:new google.maps.LatLng(latRes,lngRes),
    radius:(cov_with!='') ? cov_with*1000 : 2000,
    fillColor:"#000000",
    fillOpacity:0.1,
    strokeColor:"#2196F3",
    strokeOpacity:0.8,
    strokeWeight:1,
    editable: true,
  });

// new-presentation
  var checkLocationTypePres = $('#checkLocationTypePres').val(),
      checkUserTypePres = $('#checkUserTypePres').val(),
      checkLocHq = $('#loc_hq_check').val();

// reset
$.fn.clearForm = function() {
  return this.each(function() {
    var id = this.id, tag = this.tagName.toLowerCase();
    if (tag == 'form')
      return $(':input',this).clearForm();
    if (id == 'hidden-geo-input')
      this.value = '';
  });
};

// order location start
function initialize_add_loc(){
  var lat = $('#control_input_lat').val();
  var lng = $('#control_input_lng').val();
  $("#locations-name").geocomplete({
    map: "#my_map",
    mapOptions: {
      //zoom: 10,
      scrollwheel: true,
    },
    markerOptions: {
      draggable: true
    },
    details: "#form-horizontal",
    detailsAttribute: "data-geo",
    location: [lat,lng],  // initialize map with user home location
  });

  $("#locations-name").bind("geocode:dragged", function(event, latLng){
    $("input[name='Locations[lat]']").val(latLng.lat());
    $("input[name='Locations[lng]']").val(latLng.lng());

    var map = $("#locations-name").geocomplete("map");
    map.panTo(latLng);
    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({'latLng': latLng }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {

          var res = results[0].address_components;

          for (var i = 0; i < results.length; i++) {
            /// država
            if (results[i].types[0] === "country") {
              var country = results[i].address_components[0].long_name;                    
              $("input[name='Locations[country]']").val(country);
            }
            /// region
            if (results[i].types[0] === "administrative_area_level_2") {
              var state = results[i].address_components[0].long_name;                    
              $("input[name='Locations[state]']").val(state);
            }
            /// region
            if (results[i].types[0] === "sublocality") {
              var sublocality = results[i].address_components[0].long_name;                    
              $("input[name='Locations[district]']").val(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $("input[name='Locations[city]']").val(city);
            }
            /// zip
            if (results[i].types[0] === "postal_code") {
              var postal_code = results[i].address_components[0].long_name;                    
              $("input[name='Locations[zip]']").val(postal_code);
            }
            /// mz
            if (results[i].types[0] === "neighborhood") {
              var neighborhood = results[i].address_components[0].long_name;                    
              $("input[name='Locations[mz]']").val(neighborhood);
            }
            /// ulica
            if (results[i].types[0] === "route") {
              var street = results[i].address_components[0].long_name;                    
              $("input[name='Locations[street]']").val(street);
            }
            /// no
            if (results[i].types[0] === "street_number") {
              var no = results[i].address_components[0].long_name;                    
              $("input[name='Locations[no]']").val(no);
            }                 
          }
          /// formated adresa                  
          var formatted_address = results[0].formatted_address;                    
          $("input[name='Locations[location_name]']").val(formatted_address);
          $("#locations-name").val(formatted_address);          
        }
      }
    });
  });
}

// presentations location start
function initialize_pres_loc_hq(){
  $("#presentation-location-hq").geocomplete({
    map: "#my_map-hq",
    mapOptions: {
      zoom: 12,
      scrollwheel: true,
      fullscreenControl: true,
      streetViewControl: false,
      scaleControl: true,
    },
    markerOptions: {
      draggable: true,
    },    
    details: "#form-horizontal-presentation",
    detailsAttribute: "data-geohq",
    location: [lat,lng],  // initialize map with user home location
    types: ['geocode'],
  })
  .bind("geocode:result", function(event, result){   
    var isCity = false;
    for (var i = 0; i < result.address_components.length; i++) {
      if(result.address_components[i].types[0] === "country"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_country').html(result.address_components[i].long_name);
        }else{
          $('.loc_op_country').html('');
        };
      }
      if(result.address_components[i].types[0] === "administrative_area_level_2"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_region').html(result.address_components[i].long_name);
        }else{
          $('.loc_op_region').html('');
        };
      }
      if(result.address_components[i].types[0] === "locality"){
        if(result.address_components[i].long_name){
          $('.loc_op_city').html(result.address_components[i].long_name);                
        }else{
          $('.loc_op_city').html('');
        } 
        isCity = true;      
      }
    }
    if(isCity){
      $(".location_operational_plaza").show();
    } else {
      $(".location_operational_plaza").hide();
    }
    $('.loc_op_exact').html(result.formatted_address);
    locExct = result.formatted_address;
  })
  .bind("geocode:dragged", function(event, latLng){
    $(".loc_hq_lat").val(latLng.lat());
    $(".loc_hq_lng").val(latLng.lng());
    
    var map = $("#presentation-location-hq").geocomplete("map");
    map.panTo(latLng);   

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'latLng': latLng,        
      }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {

          var res = results[0].address_components;

          for (var i = 0; i < results.length; i++) {
            /// država
            if (results[i].types[0] === "country") {
              var country = results[i].address_components[0].long_name;                    
              $(".loc_hq_country").val(country);
              $('.loc_op_country').html(country);
            }
            /// region
            if (results[i].types[0] === "administrative_area_level_2") {
              var state = results[i].address_components[0].long_name;                    
              $(".loc_hq_state").val(state);
            }
            /// region
            if (results[i].types[0] === "sublocality") {
              var sublocality = results[i].address_components[0].long_name;                    
              $(".loc_hq_district").val(sublocality);
              $('.loc_op_region').html(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $(".loc_hq_city").val(city);
              $('.loc_op_city').html(city);
              $(".location_operational_plaza").show();
              if(city==''){
                $(".location_operational_plaza").hide();
              }
            }
            /// zip
            if (results[i].types[0] === "postal_code") {
              var postal_code = results[i].address_components[0].long_name;                    
              $(".loc_hq_zip").val(postal_code);
            }
            /// mz
            if (results[i].types[0] === "neighborhood") {
              var neighborhood = results[i].address_components[0].long_name;                    
              $(".loc_hq_mz").val(neighborhood);
            }
            /// ulica
            if (results[i].types[0] === "route") {
              var street = results[i].address_components[0].long_name;                    
              $(".loc_hq_street").val(street);
            }
            /// no
            if (results[i].types[0] === "street_number") {
              var no = results[i].address_components[0].long_name;                    
              $(".loc_hq_no").val(no);
            }               
          }
          /// formated adresa                  
          var formatted_address = results[0].formatted_address;                    
          $(".loc_hq_location_name").val(formatted_address);
          $("#presentation-location-hq").val(formatted_address);   
          $('.loc_op_exact').html(formatted_address);
          locExct = formatted_address;
        }
      }
    });
  });

  var map = $("#presentation-location-hq").geocomplete("map"),
    marker = $("#presentation-location-hq").geocomplete("marker");

  $("input[name='PresentationData[coverage]']").on('change', function(){    
    if($(this).val()==0){  
        myCity.bindTo('center', marker, 'position');    
        myCity.setMap(map); 
        google.maps.event.addListener(myCity, 'radius_changed', function () {
            $("input[class='location_within_input']").val((myCity.getRadius()/1000).toFixed(2));
            $(".loc_op_circle").html('U radijusu od ' + (myCity.getRadius()/1000).toFixed(2) + ' km u odnosu na ' + locExct);
        });
        google.maps.event.addListener(myCity, 'center_changed', function () {
            map.panTo(myCity.getCenter());

            var geocoder2 = new google.maps.Geocoder();
            geocoder2.geocode({
                'latLng': myCity.getCenter(),        
              }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                  var res = results[0].address_components;

                  for (var i = 0; i < results.length; i++) {
                    /// država
                    if (results[i].types[0] === "country") {
                      var country = results[i].address_components[0].long_name;                    
                      $(".loc_hq_country").val(country);
                      $('.loc_op_country').html(country);
                    }
                    /// region
                    if (results[i].types[0] === "administrative_area_level_2") {
                      var state = results[i].address_components[0].long_name;                    
                      $(".loc_hq_state").val(state);
                    }
                    /// region
                    if (results[i].types[0] === "sublocality") {
                      var sublocality = results[i].address_components[0].long_name;                    
                      $(".loc_hq_district").val(sublocality);
                      $('.loc_op_region').html(sublocality);
                    }
                    /// grad
                    if (results[i].types[0] === "locality") {
                      var city = results[i].address_components[0].long_name;                    
                      $(".loc_hq_city").val(city);
                      $('.loc_op_city').html(city);
                      $(".location_operational_plaza").show();
                      if(city==''){
                        $(".location_operational_plaza").hide();
                      }
                    }
                    /// zip
                    if (results[i].types[0] === "postal_code") {
                      var postal_code = results[i].address_components[0].long_name;                    
                      $(".loc_hq_zip").val(postal_code);
                    }
                    /// mz
                    if (results[i].types[0] === "neighborhood") {
                      var neighborhood = results[i].address_components[0].long_name;                    
                      $(".loc_hq_mz").val(neighborhood);
                    }
                    /// ulica
                    if (results[i].types[0] === "route") {
                      var street = results[i].address_components[0].long_name;                    
                      $(".loc_hq_street").val(street);
                    }
                    /// no
                    if (results[i].types[0] === "street_number") {
                      var no = results[i].address_components[0].long_name;                    
                      $(".loc_hq_no").val(no);
                    }               
                  }
                  /// formated adresa                  
                  var formatted_address = results[0].formatted_address;                    
                  $(".loc_hq_location_name").val(formatted_address);
                  $("#presentation-location-hq").val(formatted_address);   
                  $('.loc_op_exact').html(formatted_address);
                  locExct = formatted_address;
                }
              }
            });



        });     
    } else {
        myCity.setMap(null);
    }
  });
}

// presentations location start
function initialize_pres_loc(){
  $("#presentation-location").geocomplete({
    map: "#my_map",
    mapOptions: {
      zoom: 12,
      scrollwheel: true,
      fullscreenControl: true,
      streetViewControl: false,
      scaleControl: true,
    },
    markerOptions: {
      draggable: checkLocationTypePres!=2 ? true : false,
    },    
    details: "#form-horizontal-presentation",
    detailsAttribute: "data-geo",
    location: latResPres!='' ? [latResPres,lngResPres] : [lat,lng],  // initialize map with user home location
    types: ['geocode'],
  })
  .bind("geocode:dragged", function(event, latLng){
    $(".loc_lat").val(latLng.lat());
    $(".loc_lng").val(latLng.lng());
    
    var map = $("#presentation-location").geocomplete("map");
    map.panTo(latLng);   

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'latLng': latLng,        
      }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {

          var res = results[0].address_components;

          for (var i = 0; i < results.length; i++) {
            /// država
            if (results[i].types[0] === "country") {
              var country = results[i].address_components[0].long_name;                    
              $(".loc_country").val(country);
            }
            /// region
            if (results[i].types[0] === "administrative_area_level_2") {
              var state = results[i].address_components[0].long_name;                    
              $(".loc_state").val(state);
            }
            /// region
            if (results[i].types[0] === "sublocality") {
              var sublocality = results[i].address_components[0].long_name;                    
              $(".loc_district").val(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $(".loc_city").val(city);
            }
            /// zip
            if (results[i].types[0] === "postal_code") {
              var postal_code = results[i].address_components[0].long_name;                    
              $(".loc_zip").val(postal_code);
            }
            /// mz
            if (results[i].types[0] === "neighborhood") {
              var neighborhood = results[i].address_components[0].long_name;                    
              $(".loc_mz").val(neighborhood);
            }
            /// ulica
            if (results[i].types[0] === "route") {
              var street = results[i].address_components[0].long_name;                    
              $(".loc_street").val(street);
            }
            /// no
            if (results[i].types[0] === "street_number") {
              var no = results[i].address_components[0].long_name;                    
              $(".loc_no").val(no);
            }               
          }
          /// formated adresa                  
          var formatted_address = results[0].formatted_address;                    
          $(".loc_location_name").val(formatted_address);
          $("#presentation-location").val(formatted_address);
        }
      }
    });
  });  
}

function initialize_pres_loc2(){
 var map = $("#presentation-location").geocomplete("map"),
    marker = $("#presentation-location").geocomplete("marker");
  $("#presentation-location2").geocomplete({
    map: map,
    markerOptions: {
      //draggable: checkLocationTypePres==5 ? true : false,
      label: 'B',
    },    
    details: "#form-horizontal-presentation",
    detailsAttribute: "data-geo2",
    types: ['geocode'],
  })
  .bind("geocode:dragged", function(event, latLng){
    $(".loc2_lat").val(latLng.lat());
    $(".loc2_lng").val(latLng.lng());
    
    var map2 = $("#presentation-location2").geocomplete("map");
    map2.panTo(latLng);   

    var geocoder2 = new google.maps.Geocoder();
    geocoder2.geocode({
        'latLng': latLng,        
      }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {

          var res = results[0].address_components;

          for (var i = 0; i < results.length; i++) {
            /// država
            if (results[i].types[0] === "country") {
              var country = results[i].address_components[0].long_name;                    
              $(".loc2_country").val(country);
            }
            /// region
            if (results[i].types[0] === "administrative_area_level_2") {
              var state = results[i].address_components[0].long_name;                    
              $(".loc2_state").val(state);
            }
            /// region
            if (results[i].types[0] === "sublocality") {
              var sublocality = results[i].address_components[0].long_name;                    
              $(".loc2_district").val(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $(".loc2_city").val(city);
            }
            /// zip
            if (results[i].types[0] === "postal_code") {
              var postal_code = results[i].address_components[0].long_name;                    
              $(".loc2_zip").val(postal_code);
            }
            /// mz
            if (results[i].types[0] === "neighborhood") {
              var neighborhood = results[i].address_components[0].long_name;                    
              $(".loc2_mz").val(neighborhood);
            }
            /// ulica
            if (results[i].types[0] === "route") {
              var street = results[i].address_components[0].long_name;                    
              $(".loc2_street").val(street);
            }
            /// no
            if (results[i].types[0] === "street_number") {
              var no = results[i].address_components[0].long_name;                    
              $(".loc2_no").val(no);
            }               
          }
          /// formated adresa                  
          var formatted_address = results[0].formatted_address;                    
          $(".loc2_location_name").val(formatted_address);
          $("#presentation-location2").val(formatted_address);
        }
      }
    });
  });  
     

  var marker2 = $("#presentation-location2").geocomplete("marker") ? $("#presentation-location2").geocomplete("marker") : null;
  var directionsService = new google.maps.DirectionsService;
  var directionsDisplay = new google.maps.DirectionsRenderer;
  directionsDisplay.setMap(map);

  var onChangeHandler = function() {
    calculateAndDisplayRoute(directionsService, directionsDisplay);
    calculateDistance(service);
  };  
  marker.addListener('position_changed', onChangeHandler);
  marker2.addListener('position_changed', onChangeHandler);

  function calculateAndDisplayRoute(directionsService, directionsDisplay) {
    directionsService.route({
      origin: marker.getPosition() ? marker.getPosition() : new google.maps.LatLng(latRes,lngRes),
      destination: marker2.getPosition() ? marker2.getPosition() : new google.maps.LatLng(latRes,lngRes),
      travelMode: google.maps.TravelMode.DRIVING
    }, function(response, status) {
      if (status === google.maps.DirectionsStatus.OK) {
        directionsDisplay.setDirections(response);
      } else {
        window.alert('Directions request failed due to ' + status);
      }
    });
  }

  var service = new google.maps.DistanceMatrixService;
  function calculateDistance(service) {
    service.getDistanceMatrix({
      origins: marker.getPosition() ? [marker.getPosition()] : [new google.maps.LatLng(latRes,lngRes)],
      destinations: marker2.getPosition() ? [marker2.getPosition()] : [new google.maps.LatLng(latRes,lngRes)],
      travelMode: google.maps.TravelMode.DRIVING,
      unitSystem: google.maps.UnitSystem.METRIC,
      avoidHighways: false,
      avoidTolls: false
    }, function(response, status) {
      if (status !== google.maps.DistanceMatrixStatus.OK) {
        alert('Error was: ' + status);
      } else {
        var originList = response.originAddresses;
        var destinationList = response.destinationAddresses;
        var outputDiv = document.getElementById('output');
        outputDiv.innerHTML = '';

        for (var i = 0; i < originList.length; i++) {
          var results = response.rows[i].elements;        
          for (var j = 0; j < results.length; j++) {         
            outputDiv.innerHTML += '<i class="fa fa-lightbulb-o"></i> Rastojanje od <b>' + originList[i] + '</b> do <b>' + destinationList[j] +
                '</b> je ' + results[j].distance.text + ' i može se preći autom za oko ' +
                results[j].duration.text + '<br>';
          }
        }
      }
    });
  }

}

// register user uac modal
function initialize_reg_loc(){
  $("#signup-form-vertical #locations-name").geocomplete({
    map: "#my_map_register",
    mapOptions: {
      //zoom: 10,
      scrollwheel: false,
      zoomControl: false,
      streetViewControl: false,
      scaleControl: false,
      panControl: false,
      overviewMapControl: false,
      mapTypeControl: false,
      keyboardShortcuts: false,
      fullscreenControl: false,
      draggable: false,
    },
    markerOptions: {
      animation:google.maps.Animation.BOUNCE,
    },
    details: "#signup-form-vertical",
    detailsAttribute: "data-geo",
    types: ['(cities)'],
  });  
}
// register provider uac modal
function initialize_reg_pro_loc(){
  $("#signupprovider-form-vertical #locations-name").geocomplete({
    map: "#my_map_register_pro",
    mapOptions: {
      //zoom: 10,
      scrollwheel: false,
      zoomControl: false,
      streetViewControl: false,
      scaleControl: false,
      panControl: false,
      overviewMapControl: false,
      mapTypeControl: false,
      keyboardShortcuts: false,
      fullscreenControl: false,
      draggable: false,
    },
    markerOptions: {
      animation:google.maps.Animation.BOUNCE,
    },
    details: "#signupprovider-form-vertical",
    detailsAttribute: "data-geo",
    types: ['(cities)'],
  });  
}


// presentations location start
function initialize_pres_loc_search(){
  $("#presentation-search").geocomplete({
    map: "#my_map-search",
    mapOptions: {
      zoom: 12,
      scrollwheel: true,
      fullscreenControl: true,
      streetViewControl: false,
      scaleControl: true,
    },
    markerOptions: {
      draggable: true,
    },    
    details: "#form-horizontal-presentation-search",
    detailsAttribute: "data-geosrch",
    location: [lat,lng],  // initialize map with user home location
    types: ['(cities)'],
  })
  .bind("geocode:result", function(event, result){   
    var isCity = false;
    for (var i = 0; i < result.address_components.length; i++) {
      if(result.address_components[i].types[0] === "country"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_country').html(result.address_components[i].long_name);
        }else{
          $('.loc_op_country').html('');
        };
      }
      if(result.address_components[i].types[0] === "administrative_area_level_2"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_region').html(result.address_components[i].long_name);
        }else{
          $('.loc_op_region').html('');
        };
      }
      if(result.address_components[i].types[0] === "locality"){
        if(result.address_components[i].long_name){
          $('.loc_op_city').html(result.address_components[i].long_name);                
        }else{
          $('.loc_op_city').html('');
        } 
        isCity = true;      
      }
    }
    if(isCity){
      $(".location_operational_plaza").show();
    } else {
      $(".location_operational_plaza").hide();
    }
    $('.loc_op_exact').html(result.formatted_address);
    locExct = result.formatted_address;
  })
  .bind("geocode:dragged", function(event, latLng){
    $(".loc_hq_lat").val(latLng.lat());
    $(".loc_hq_lng").val(latLng.lng());
    
    var map = $("#presentation-search").geocomplete("map");
    map.panTo(latLng);   

    var geocoder = new google.maps.Geocoder();
    geocoder.geocode({
        'latLng': latLng,        
      }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[0]) {

          var res = results[0].address_components;

          for (var i = 0; i < results.length; i++) {
            /// država
            if (results[i].types[0] === "country") {
              var country = results[i].address_components[0].long_name;                    
              $(".loc_hq_country").val(country);
              $('.loc_op_country').html(country);
            }
            /// region
            if (results[i].types[0] === "administrative_area_level_2") {
              var state = results[i].address_components[0].long_name;                    
              $(".loc_hq_state").val(state);
            }
            /// region
            if (results[i].types[0] === "sublocality") {
              var sublocality = results[i].address_components[0].long_name;                    
              $(".loc_hq_district").val(sublocality);
              $('.loc_op_region').html(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $(".loc_hq_city").val(city);
              $('.loc_op_city').html(city);
              $(".location_operational_plaza").show();
              if(city==''){
                $(".location_operational_plaza").hide();
              }
            }
            /// zip
            if (results[i].types[0] === "postal_code") {
              var postal_code = results[i].address_components[0].long_name;                    
              $(".loc_hq_zip").val(postal_code);
            }
            /// mz
            if (results[i].types[0] === "neighborhood") {
              var neighborhood = results[i].address_components[0].long_name;                    
              $(".loc_hq_mz").val(neighborhood);
            }
            /// ulica
            if (results[i].types[0] === "route") {
              var street = results[i].address_components[0].long_name;                    
              $(".loc_hq_street").val(street);
            }
            /// no
            if (results[i].types[0] === "street_number") {
              var no = results[i].address_components[0].long_name;                    
              $(".loc_hq_no").val(no);
            }               
          }
          /// formated adresa                  
          var formatted_address = results[0].formatted_address;                    
          $(".loc_hq_location_name").val(formatted_address);
          $("#presentation-search").val(formatted_address);   
          $('.loc_op_exact').html(formatted_address);
          locExct = formatted_address;
        }
      }
    });
  });

  var map = $("#presentation-search").geocomplete("map"),
    marker = $("#presentation-search").geocomplete("marker");
    cov = $("input[name='PresentationsSearch[coverage]']").val(),
    cov_with = $("input[name='PresentationsSearch[coverage_within]']").val();

  $("input[name='PresentationsSearch[coverage]']").on('change', function(){    
    if($(this).val()==0){  
        myCitySearch.bindTo('center', marker, 'position');    
        myCitySearch.setMap(map); 
        google.maps.event.addListener(myCitySearch, 'radius_changed', function () {
            $("input[class='location_within_input']").val((myCitySearch.getRadius()/1000).toFixed(2));
            $(".loc_op_circle").html('U radijusu od ' + (myCitySearch.getRadius()/1000).toFixed(2) + ' km u odnosu na ' + '<span class="loc_op_exact"> ' + locExct + '</span>');
        });
        google.maps.event.addListener(myCitySearch, 'center_changed', function () {
            map.panTo(myCitySearch.getCenter());

            var geocoder2 = new google.maps.Geocoder();
            geocoder2.geocode({
                'latLng': myCitySearch.getCenter(),        
              }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                  var res = results[0].address_components;

                  for (var i = 0; i < results.length; i++) {
                    /// država
                    if (results[i].types[0] === "country") {
                      var country = results[i].address_components[0].long_name;                    
                      $(".loc_hq_country").val(country);
                      $('.loc_op_country').html(country);
                    }
                    /// region
                    if (results[i].types[0] === "administrative_area_level_2") {
                      var state = results[i].address_components[0].long_name;                    
                      $(".loc_hq_state").val(state);
                    }
                    /// region
                    if (results[i].types[0] === "sublocality") {
                      var sublocality = results[i].address_components[0].long_name;                    
                      $(".loc_hq_district").val(sublocality);
                      $('.loc_op_region').html(sublocality);
                    }
                    /// grad
                    if (results[i].types[0] === "locality") {
                      var city = results[i].address_components[0].long_name;                    
                      $(".loc_hq_city").val(city);
                      $('.loc_op_city').html(city);
                      $(".location_operational_plaza").show();
                      if(city==''){
                        $(".location_operational_plaza").hide();
                      }
                    }
                    /// zip
                    if (results[i].types[0] === "postal_code") {
                      var postal_code = results[i].address_components[0].long_name;                    
                      $(".loc_hq_zip").val(postal_code);
                    }
                    /// mz
                    if (results[i].types[0] === "neighborhood") {
                      var neighborhood = results[i].address_components[0].long_name;                    
                      $(".loc_hq_mz").val(neighborhood);
                    }
                    /// ulica
                    if (results[i].types[0] === "route") {
                      var street = results[i].address_components[0].long_name;                    
                      $(".loc_hq_street").val(street);
                    }
                    /// no
                    if (results[i].types[0] === "street_number") {
                      var no = results[i].address_components[0].long_name;                    
                      $(".loc_hq_no").val(no);
                    }               
                  }
                  /// formated adresa                  
                  var formatted_address = results[0].formatted_address;                    
                  $(".loc_hq_location_name").val(formatted_address);
                  $("#presentation-search").val(formatted_address);   
                  $('.loc_op_exact').html(formatted_address);
                  locExct = formatted_address;
                }
              }
            });
        });     
    } else {
        myCitySearch.setMap(null);
    }
  });

    if(cov==0 && cov_with!=''){  
        myCitySearch.bindTo('center', marker, 'position');    
        myCitySearch.setMap(map); 
        google.maps.event.addListener(myCitySearch, 'radius_changed', function () {
            $("input[class='location_within_input']").val((myCitySearch.getRadius()/1000).toFixed(2));
            $(".loc_op_circle").html('U radijusu od ' + (myCitySearch.getRadius()/1000).toFixed(2) + ' km u odnosu na ' + '<span class="loc_op_exact"> ' + locExct + '</span>');
        });
        google.maps.event.addListener(myCitySearch, 'center_changed', function () {
            map.panTo(myCitySearch.getCenter());

            var geocoder2 = new google.maps.Geocoder();
            geocoder2.geocode({
                'latLng': myCitySearch.getCenter(),        
              }, function(results, status) {
              if (status == google.maps.GeocoderStatus.OK) {
                if (results[0]) {

                  var res = results[0].address_components;

                  for (var i = 0; i < results.length; i++) {
                    /// država
                    if (results[i].types[0] === "country") {
                      var country = results[i].address_components[0].long_name;                    
                      $(".loc_hq_country").val(country);
                      $('.loc_op_country').html(country);
                    }
                    /// region
                    if (results[i].types[0] === "administrative_area_level_2") {
                      var state = results[i].address_components[0].long_name;                    
                      $(".loc_hq_state").val(state);
                    }
                    /// region
                    if (results[i].types[0] === "sublocality") {
                      var sublocality = results[i].address_components[0].long_name;                    
                      $(".loc_hq_district").val(sublocality);
                      $('.loc_op_region').html(sublocality);
                    }
                    /// grad
                    if (results[i].types[0] === "locality") {
                      var city = results[i].address_components[0].long_name;                    
                      $(".loc_hq_city").val(city);
                      $('.loc_op_city').html(city);
                      $(".location_operational_plaza").show();
                      if(city==''){
                        $(".location_operational_plaza").hide();
                      }
                    }
                    /// zip
                    if (results[i].types[0] === "postal_code") {
                      var postal_code = results[i].address_components[0].long_name;                    
                      $(".loc_hq_zip").val(postal_code);
                    }
                    /// mz
                    if (results[i].types[0] === "neighborhood") {
                      var neighborhood = results[i].address_components[0].long_name;                    
                      $(".loc_hq_mz").val(neighborhood);
                    }
                    /// ulica
                    if (results[i].types[0] === "route") {
                      var street = results[i].address_components[0].long_name;                    
                      $(".loc_hq_street").val(street);
                    }
                    /// no
                    if (results[i].types[0] === "street_number") {
                      var no = results[i].address_components[0].long_name;                    
                      $(".loc_hq_no").val(no);
                    }               
                  }
                  /// formated adresa                  
                  var formatted_address = results[0].formatted_address;                    
                  $(".loc_hq_location_name").val(formatted_address);
                  $("#presentation-search").val(formatted_address);   
                  $('.loc_op_exact').html(formatted_address);
                  locExct = formatted_address;
                }
              }
            });
        });     
    } else {
        myCitySearch.setMap(null);
    }
}


$(document).ready(function(){ 
  $('.loc_op_country').html(locCtry);
  $('.loc_op_region').html(locDis);
  $('.loc_op_city').html(locCity);
  $('.loc_op_exact').html(locExct);
  //initialize_add_loc();
  var checkLocationType = $('#checkLocation').val();
  var checkUserType = $('#checkUserType').val();
  if(checkUserType==0){
    initialize_add_loc();
  }
  // new-order
  $(".new_loc").on('click', function(){                  
    $('.enter_location').slideDown({
      complete:function (){
        initialize_add_loc();
      }
    });
    $("#orders-loc_id").val("");
    $('html,body').animate({
      scrollTop: $(this).offset().top-70},
      500);
  });

  $("#orders-loc_id").on('change', function(){                  
    $('.enter_location').hide();
    $("form").clearForm();
    $("#locations-name").val("");
  });
  // new-presentation
  var checkLocationTypePres = $('#checkLocationTypePres').val(),
      checkUserTypePres = $('#checkUserTypePres').val(),
      checkLocHq = $('#loc_hq_check').val();
  if(checkLocationTypePres==2 || checkLocationTypePres==5){
    initialize_pres_loc();
  }
  if(checkLocHq==0){
    initialize_pres_loc_hq();
  }
  if(checkLocationTypePres==2){
    initialize_pres_loc2();
  }

  $(".new_loc_pres").on('click', function(){                  
    $('.enter_location').slideDown({
      complete:function (){
        initialize_pres_loc_hq();
      }
    });
    //$("#presentations-loc_id").val("");
    $('html,body').animate({
      scrollTop: $(this).offset().top-70},
      500);
  }); 

  $(".wrapper").one('click', function(){                  
    $(this).next('.body').slideDown({
      complete:function (){
        initialize_pres_loc_search();
      }
    });
  }); 

  $(".more-filters").on('click', function(){                  
    $('.more-filters-plaza').toggle();
  }); 
  

/*var map = $("#presentation-location").geocomplete("map"),
    marker = $("#presentation-location").geocomplete("marker");  

  $(".save-location-marker").on('click', function(){
      var image = 'http://maps.google.com/mapfiles/arrow.png';
     var myMarker = new google.maps.Marker({
      position: marker.getPosition(),
      //label: 'Glavno',
      clickable: true,
      icon: image
    });

    myMarker.setMap(map);
    myMarker.addListener('click', function() {
      myMarker.setMap(null);
      map.setCenter(myMarker.getPosition());
    });
  });*/
});