
// close autocomplete search
function close_search() {
  $('li.search_icon').removeClass('active');
  $('li.search_icon .subnav-fixed.search').slideUp();
  $('.close_search').hide();
}

// toggle select/deselect all checkboxes
function checkAllOrNone() {
  $( "[id^='ckbCheckAll']").on('click', function () {    
    $(this).closest('.enclosedCheckboxes').find("input[type='checkbox']").prop('checked', $(this).prop('checked'));
  });
} 

function clearForm(oForm) {
    
  var elements = oForm.elements;
    
  oForm.reset();

  for(i=0; i<elements.length; i++) {
      
  field_type = elements[i].type.toLowerCase();
  
  switch(field_type) {
  
    case "text": 
    case "password": 
    case "textarea":
    //case "hidden": 
    case "number":  
      
      elements[i].value = ""; 
      break;
        
    case "radio":
    case "checkbox":
        if (elements[i].checked) {
          elements[i].checked = false; 
      }
      break;

    case "select-one":
    case "select-multi":
                elements[i].selectedIndex = -1;
      break;

    default: 
      break;
  }
    }
}

$(document).ready(function(){
  $(".search-index").click(function(){
      $(this).closest('.title_holder_home').find('.user-objects-search').toggle();
  });
  // forms and settings divisions titlebars
  $(".settings .wrapper.headline").click(function(){
      $(this).next('.wrapper').toggle();
      $(this).find('i.chevron').toggleClass('fa-chevron-right');
      $(this).find('i.chevron').toggleClass('fa-chevron-down');
      $('html,body').animate({
              scrollTop: $(this).offset().top-80},
              500);
  });
  // settings help on right-sidebar
  $(".show-more").click(function(){
      $(this).closest('.card_container').find('div.hidden-content').toggleClass('hidden');
      $(this).find('i.fa').toggleClass('fa-chevron-down');
      $(this).find('i.fa').toggleClass('fa-chevron-right');
  });

  // Compact order
  $("[id^=card_container]").hover(function(){
      $(this).find('.hidden-widget').toggleClass('hidden');
  });
  //indexed table row is link
  $(".clickable-row").click(function() {
    window.document.location = $(this).data("href");
  });
  // popovers
  //$('[data-toggle="popover"]').popover();  
  
  // autocomplete
  $('.search_icon').on("click", function(e) {
    $(this).addClass('active');
    $(this).find('.subnav-fixed.search').show();
    $('.close_search').show();
  });
  
  //checkbox select all/none
  $( "[id^='ckbCheckAll']").on('click', function () {
    $(this).closest('.enclosedCheckboxes').find("input[type='checkbox']").prop('checked', $(this).prop('checked'));
  });
  
  

  // reset animate !important
  $(window).bind('mousewheel', function() {
      $('html, body').stop();
  });


  $('[id^="sections"]').on("click", function(e) {
    var string = $(this).attr('id');
    var lastTwo = string.substr(string.length - 2);
    var $menuItem = $('.check' + lastTwo + ' i.fa');
    $(this).find('div.form-group').each(function() {
      if ($(this).hasClass('has-error')) {
          $($menuItem).addClass('fa-exclamation-circle');
          //$($menuItem).removeClass('fa-plus');        
          // do something
      }
      if ($(this).hasClass('has-success')) {
          $($menuItem).addClass('fa-check');
          //$($menuItem).removeClass('fa-plus');        
          // do something
      }
    });
  });  
  
});

$(document).ready(function(){

// load modal contents

  $("[id^='object-property-values-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('object-property-values-modal', '');
    $(this).find(".modal-body").load('/object-properties/modal?id=' + lastChar, function() {
      checkAllOrNone();
    });    
  }); 
});

$(function(){
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
      $(document).on('click', '.showModalButton', function(){
         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
    });
});
