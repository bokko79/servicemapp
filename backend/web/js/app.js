
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


