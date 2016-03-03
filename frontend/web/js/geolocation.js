$(document).ready(function(){ 
  //initialize_add_loc();
  var checkLocationType = $('#checkLocation').val();
  var checkUserType = $('#checkUserType').val();
  if(checkUserType==0){
    initialize_add_loc();
  }

  $(".new_loc").on('click', function(){                  
    $('.enter_location').slideDown({
      complete:function (){
        initialize_add_loc();
      }
    });
    $("#orders-loc_id").val("");
    $('html,body').animate({
      scrollTop: $(this).offset().top-60},
      500);
  });

  $("#orders-loc_id").on('change', function(){                  
    $('.enter_location').hide();
    $("form").clearForm();
    $("#locations-name").val("");
  });
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
// order location start
function initialize_reg_loc(){
  $("#signup-form-vertical #locations-name").geocomplete({
    map: "#my_map_register",
    mapOptions: {
      //zoom: 10,
      scrollwheel: true,
    },
    markerOptions: {
      draggable: true
    },
    details: "#signup-form-vertical",
    detailsAttribute: "data-geo",
  });  
}
// order location start
function initialize_reg_pro_loc(){
  $("#signupprovider-form-vertical #locations-name").geocomplete({
    map: "#my_map_register_pro",
    mapOptions: {
      //zoom: 10,
      scrollwheel: true,
    },
    markerOptions: {
      draggable: true
    },
    details: "#signupprovider-form-vertical",
    detailsAttribute: "data-geo",
  });  
}