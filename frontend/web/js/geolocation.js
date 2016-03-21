var latRes  = $("input[name='Locations[lat]']").val(),
    lngRes  = $("input[name='Locations[lng]']").val(),
    locCtry = $("input[name='Locations[country]']").val(),
    locDis  = $("input[name='Locations[district]']").val(),
    locCity = $("input[name='Locations[city]']").val(),
    locExct = $("input[name='Locations[location_name]']").val();

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
function initialize_pres_loc(){
  $("#presentation-location").geocomplete({
    map: "#my_map",
    mapOptions: {
      zoom: 12,
      scrollwheel: true,
      fullscreenControl: true,
      streetViewControl: false,
    },
    markerOptions: {
      draggable: true,
    },    
    details: "#form-horizontal-presentation",
    detailsAttribute: "data-geo",
    location: [lat,lng],  // initialize map with user home location
    types: ['geocode'],
  })
  .bind("geocode:result", function(event, result){
    var isCity = false;
    for (var i = 0; i < result.address_components.length; i++) {
      if(result.address_components[i].types[0] === "country"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_country').html(result.address_components[i].long_name)
        }else{
          $('.loc_op_country').html('')
        };
      }
      if(result.address_components[i].types[0] === "administrative_area_level_2"){
        if(result.address_components[i].long_name!=''){
          $('.loc_op_region').html(result.address_components[i].long_name)
        }else{
          $('.loc_op_region').html('')
        };
      }
      if(result.address_components[i].types[0] === "locality"){
        if(result.address_components[i].long_name){
          $('.loc_op_city').html(result.address_components[i].long_name)          
        }else{
          $('.loc_op_city').html('')          
        };
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
    $("input[name='Locations[lat]']").val(latLng.lat());
    $("input[name='Locations[lng]']").val(latLng.lng());
    
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
              $("input[name='Locations[country]']").val(country);
              $('.loc_op_country').html(country);
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
              $('.loc_op_region').html(sublocality);
            }
            /// grad
            if (results[i].types[0] === "locality") {
              var city = results[i].address_components[0].long_name;                    
              $("input[name='Locations[city]']").val(city);
              $('.loc_op_city').html(city);
              $(".location_operational_plaza").show();
              if(city==''){
                $(".location_operational_plaza").hide();
              }
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
          $("input[name='Presentations[location_input]']").val(formatted_address);
          $("#presentation-location").val(formatted_address);   
          $('.loc_op_exact').html(formatted_address);
          locExct = formatted_address;
        }
      }
    });
  });

 var map = $("#presentation-location").geocomplete("map"),
    marker = $("#presentation-location").geocomplete("marker");
  
  $("input[name='Presentations[location_operational]']").on('change', function(){    
    if($(this).val()=='within'){  
        myCity.bindTo('center', marker, 'position');    
        myCity.setMap(map); 
        google.maps.event.addListener(myCity, 'radius_changed', function () {
            $("input[class='location_within_input']").val((myCity.getRadius()/1000).toFixed(2));
            $(".loc_op_circle").html('U radijusu od ' + (myCity.getRadius()/1000).toFixed(2) + ' km u odnosu na ' + locExct);
        });
        google.maps.event.addListener(myCity, 'center_changed', function () {
            map.panTo(myCity.getCenter());
        });     
    } else {
        myCity.setMap(null);
    }
  });
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
  var checkLocationTypePres = $('#checkLocationPres').val();
  var checkUserTypePres = $('#checkUserTypePres').val();
  if(checkUserTypePres==0){
    initialize_pres_loc();
  }
  $("#presentations-loc_id").on('change', function(){                  
    $('.enter_location').hide();
    $("form").clearForm();
    $("#presentation-location").val("");
    $(".location_operational_plaza").hide();
  });

  $(".new_loc_pres").on('click', function(){                  
    $('.enter_location').slideDown({
      complete:function (){
        initialize_pres_loc();
      }
    });
    $("#presentations-loc_id").val("");
    $('html,body').animate({
      scrollTop: $(this).offset().top-70},
      500);
  });  
});