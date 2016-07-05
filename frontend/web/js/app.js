

$.fn.followToProfile = function (pos) {
  var $this = this,
  $window = $(window);

  $window.scroll(function (e) {
    if ($window.scrollTop() < pos) {
      $('div.profile_head_stick').css({'display':'none'});
      $('header.main nav').css({'box-shadow':'0 1px 7px rgba(0, 0, 0, .15)'});
      $this.addClass('fadeInDown animated');
    } else {
        $('div.profile_head_stick').css({
            'display':'block',
            'position': 'fixed',
            'left':0,
            'right':0,
            'top': '60px',
            'z-index': 1000,
        });
        //$('header.main nav').css({'box-shadow':'0 1px 7px #000'});
    }
  });
};
// ordering
// reset
$.fn.validateSpecs = function() {
  return this.each(function() {
    var name = this.name, tag = this.tagName.toLowerCase();
    if (tag == 'form')
      return $(':input',this).validateSpecs();
    if (name == 'CartServiceObjectSpecification[checkUserObject]')
      this.value = 1;
  });
};
// reset
$.fn.stopValidateSpecs = function() {
  return this.each(function() {
    var name = this.name, tag = this.tagName.toLowerCase();
    if (tag == 'form')
      return $(':input',this).stopValidateSpecs();
    if (name == 'CartServiceObjectSpecification[checkUserObject]')
      this.value = 0;
  });
};
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
  // ProfileSubNav
  $(".profile_head").followToProfile(220);
  // Quick forms
  $(".control.order-service").click(function(){
      $(this).closest('#quick-form-makers').find('.order-service-process').toggle();
      $(this).toggleClass('btn-default btn-info no-bottom-border');
      $('html,body').animate({
              scrollTop: $(this).offset().top-110},
              500);
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
  $('[data-toggle="popover"]').popover();  
  
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
  
  // new order time
  $("#orders-new_time").click(function(){
      var radioValue = $("input[name='Orders[new_time]']:checked").val();
      if(radioValue==0){
        $('.enter_time').slideDown();    
        $('html,body').animate({
          scrollTop: $(this).offset().top-80},
          500);
      } else {
        $('.enter_time').hide();
      }
  });  

  $(".new_obj").on('click', function(){  
    $('.enter_objectSpec').slideDown(); 
    $("#cartform-user_object").val('');
    $("#checkUserObject_model").val(0);
    $("form").validateSpecs();
    $('html,body').animate({
      scrollTop: $(this).offset().top-80},
      500);
  });

  $("#cartform-user_object").on('change', function(){                  
    $('.enter_objectSpec').hide();
    $("#checkUserObject_model").val(1);
    $("form").stopValidateSpecs();
  });

  $("#orders-new_user").click(function(){
      var radioValue = $("input[name='Orders[new_user]']:checked").val();
      if(radioValue==0){
        $('.loginForm').show();  
        $('.signUpForm').hide();  
        $('html,body').animate({
          scrollTop: $(this).offset().top-80},
          500);
      } else {
        $('.signUpForm').show();
        $('.loginForm').hide();
        $('html,body').animate({
          scrollTop: $(this).offset().top-80},
          500);  
      }
  });
  $(window).on("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 80);
  });

  // presentations specs
  $(".new_pres_spec").on('click', function(){  
    $('.enter_presSpec').slideDown(); 
    $("#presentationdata-provider_presentation_specs").val('');
    $(".pres-specs-plaza").html('');
    $('html,body').animate({
      scrollTop: $(this).offset().top-80},
      500);
  });

  $("#presentationdata-provider_presentation_specs").on('change', function(){                  
    $('.enter_presSpec').hide();
    $(".pres-specs-plaza").show().load('/showThemSpecs?id=' + $(this).val());
  });
  // presentations pics
  $(".new_pres_pics").on('click', function(){  
    $('.enter_presPics').slideDown(); 
    $("#presentations-provider_presentation_pics").val('');
    $(".pres-pics-plaza").html('');
    $('html,body').animate({
      scrollTop: $(this).offset().top-80},
      500);
  });

  $("#presentationdata-provider_presentation_pics").on('change', function(){                  
    $('.enter_presPics').hide();
    $(".pres-pics-plaza").show().load('/showThemPics?id=' + $(this).val());
  });

  // presentation issues
  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_object_syn_wrap"); //Fields wrapper
  var add_button      = $(".add_object_syn_button"); //Add button ID
  
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(this).closest(wrapper).append('<div class=" margin-bottom-15 animated fadeInDown"><input type="text" name="Presentations[issues][]" class="form-control float-left" style="width:70%;" /><a href="#" class="remove_field btn btn-link"> <i class="fa fa-minus-circle"></i> Izbaci</a></div>'); //add input box
          
      }
  });  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
  });

  // presentations methods
  $(".new_pres_method").on('click', function(){  
    $('.enter_presMethod').slideDown(); 
    $("#presentationdata-provider_presentation_methods").val('');
    $(".pres-methods-plaza").html('');
    $('html,body').animate({
      scrollTop: $(this).offset().top-80},
      500);
  });

  $("#presentationdata-provider_presentation_methods").on('change', function(){                  
    $('.enter_presMethod').hide();
    $(".pres-methods-plaza").show().load('/showThemMethods?id=' + $(this).val());
  });

  // presentation timetable
  var wrapper_timetable         = $(".input_timetable_syn_wrap"); //Fields wrapper
  var add_button_timetable      = $(".add_timetable_syn_button"); //Add button ID

  var x = 1; //initlal text box count
  $(add_button_timetable).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(this).closest(wrapper_timetable).append('<div class=" margin-bottom-15 animated fadeIn overflow-hidden"><div class="col-sm-2" style="padding-right:0"><div class="form-group">' +
                                                          '<select id="presentationtimetables-day_of_week" class="form-control" name="PresentationTimetables[day_of_week][]">' +
                                                            '<option value="1">Pon</option><option value="2">Uto</option><option value="3">Sre</option><option value="4">Čet</option><option value="5">Pet</option><option value="6">Sub</option><option value="7">Ned</option>' +
                                                            '</select></div></div>' +
                                                          '<div class="col-sm-2"><div class="form-group">' +
                                                          '<div class="col-md-12"><div class="bootstrap-timepicker input-group"><input type="text" id="presentationtimetables-time_start-disp" class="form-control" name="time_start-presentationtimetables-time_start" value=""><span class="input-group-addon picker"><i class="glyphicon glyphicon-time"></i></span></div><input type="hidden" id="presentationtimetables-time_start" name="PresentationTimetables[time_start][]" value="04:30:00"></div>' +
                                                          '</div></div><div class="col-sm-3"><div class="form-group field-presentationtimetables-time_end">' +
                                                          '<label class="control-label col-md-3" for="presentationtimetables-time_end">Kraj</label><div class="col-md-9"><div class="bootstrap-timepicker input-group"><input type="text" id="presentationtimetables-time_end-disp" class="form-control" name="time_end-presentationtimetables-time_end" value=""><span class="input-group-addon picker"><i class="glyphicon glyphicon-time"></i></span></div><input type="hidden" id="presentationtimetables-time_end" name="PresentationTimetables[time_end][]" value="04:30:00"></div>' +
                                                          '</div></div>' +
                                                          '<div class="col-sm-1"><a href="#" class="remove_field btn btn-link col-sm-1"> <i class="fa fa-minus-circle"></i> Izbaci</a></div></div>'); //add input box
          
      }
  });  
  $(wrapper_timetable).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).closest('div.animated').remove(); x--;
  });


  // presentation price  
  $("#presentationdata-price, #presentationdata-currency_id, #presentationdata-price_per").on('change', function(){
    var price = $("#presentationdata-price").val(),
      currency = $("#presentationdata-currency_id").children("option:selected").text(),
      price_per = $("#presentationdata-price_per").children("option:selected").text(),
      provision = $("#user_provision_value").val();
    if(price && currency && price_per){
      $('.calculated_provision_price').show();
      $('.earnings').html((price*provision/100).toFixed(2) + ' ' + currency + ' ' + price_per);
    }
    if(currency && price_per){
      $('.currperunit').html(currency + (price_per=='ukupno' ? '' : price_per));
    }
    if(price_per){
      $('input[name="PresentationData[price_unit]"]').val($("#presentationdata-price_per").val());
    }    
  });

  $('input#presentationdata-qtypriceconst').on('switchChange.bootstrapSwitch', function(event, state) {
    if(state){
      $('.quantity_constraints').show();
    } else {
      $('.quantity_constraints').hide();
      $('.quantity_constraints').find('input').each(function(){
        $(this).val('');
      });
    }
  });

  $('input#presentationdata-consumerpriceconst').on('switchChange.bootstrapSwitch', function(event, state) {
    if(state){
      $('.consumer_constraints').show();
    } else {
      $('.consumer_constraints').hide();
      $('.consumer_constraints').find('input').each(function(){
        $(this).val('');
      });
    }
  });

  $('input#presentationdata-quantityconstcheck').on('switchChange.bootstrapSwitch', function(event, state) {
    if(state){
      $('.quantity-container').show();
    } else {
      $('.quantity-container').hide();
      $('.quantity-container').find('input').each(function(){
        $(this).val('');
      });
    }
  });

  $('input#presentationdata-consumerconstcheck').on('switchChange.bootstrapSwitch', function(event, state) {
    if(state){
      $('.consumer-container').show();
    } else {
      $('.consumer-container').hide();
      $('.consumer-container').find('input').each(function(){
        $(this).val('');
      });
    }
  });

  // presentation availability
  $("input[name='PresentationData[time_availability]']").on('change', function(){                  
    var val = $(this).val();
    if(val=='timetable'){
      $('.enter_timetable').show();
      $('.enter_openingHours').hide();
      $('.enter_openingHours').find('input').each(function(){
        $(this).val('');
      });
    } else if(val=='opening_hours'){
      $('.enter_openingHours').show();
      $('.enter_timetable').hide();
      $('.enter_timetable').find('input').each(function(){
        $(this).val('');
      });      
    } else {
      $('.enter_timetable').hide();
      $('.enter_openingHours').hide();
      $('.enter_timetable').find('input').each(function(){
        $(this).val('');
      });
      $('.enter_openingHours').find('input').each(function(){
        $(this).val('');
      });
    }
    $('html,body').animate({
          scrollTop: $(this).offset().top-80},
          500);
  });

  $('#provideropeninghours-global_time_start-disp').on('change', function(){                  
    var val = $(this).val();
    $('.enter_openingHours').find("[id^='aaa']").each(function(){
      if(!$(this).is(':disabled')){
        $(this).val(val);
      }        
    });
  });

  $('#provideropeninghours-global_time_end-disp').on('change', function(){                  
    var val = $(this).val();
    $('.enter_openingHours').find("[id^='bbb']").each(function(){
      if(!$(this).is(':disabled')){
        $(this).val(val);
      } 
    });
  });

  $("[id^='ccc']").on('switchChange.bootstrapSwitch', function(event, state) {    
    $(this).closest('.kv-fieldset-inline').find("input[type='text']").each(function(){
      if(state){
        $(this).prop( "disabled", false );
      } else {    
        $(this).val('');    
        $(this).prop( "disabled", true );        
      }
    });        
  });

  //new presentation validity
  $('input[name="PresentationData[validity]"]').on('change', function(){
      var radioValue = $(this).val();
      if(radioValue=='limited'){
        $('.enter_dates').slideDown();    
        $('html,body').animate({
          scrollTop: $(this).offset().top-200},
          500);
      } else {
        $('.enter_dates').hide();
        $('.enter_dates').find('input').each(function(){
          $(this).val('');
        });
      }
  });

  //new presentation notifications
  $('input[name="PresentationNotifications[notification_type]"]').on('change', function(){
      var radioValue = $(this).val();
      if(radioValue=='setup'){
        $('.enter_notifications').slideDown();    
        $('html,body').animate({
          scrollTop: $(this).offset().top-80},
          500);
      } else {
        $('.enter_notifications').hide();
        $('.enter_notifications').find('input').each(function(){
          $(this).val(0);
        });
      }
  });

  // presentation youtube  
  $(".youtubeUrlLink").on('click', function(){
    $('.youtube_link_container').show();
  });
  
  // presentations portfolio
  $('.collapsing').on("click", function(e) {
    $(this).toggleClass('inverted normal');
    $(this).closest("#card_container").find('.secondary-context').each(function(){
      $(this).toggle();
    });
    $('html,body').animate({
              scrollTop: $(this).offset().top-70},
              500);
  });

  // presentations uac
  $('.toggle-register-login').on("click", function(e) {
    $('.new_user_register').toggle();
    $('.returning_user_login').toggle();

    $(this).find('.reg').toggle();
    $(this).find('.log').toggle();
    $('html,body').animate({
              scrollTop: $(this).offset().top-80},
              500);
    var checkReg = $('input[name="registerProvider-form[checker]"]').val(),
        checkLog = $('input[name="login-form[checker]"]').val();
    if(checkReg==1){
      $('input[name="registerProvider-form[checker]"]').val(0);
    } else {
      $('input[name="registerProvider-form[checker]"]').val(1);
    }
    if(checkLog==1){
      $('input[name="login-form[checker]"]').val(0);
    } else {
      $('input[name="login-form[checker]"]').val(1);
    }
  });

  // reset animate !important
  $(window).bind('mousewheel', function() {
      $('html, body').stop();
  });

/*  //highlight menu item on scroll
  // Cache selectors
  var lastId,
      topMenu = $("ul.sidebar-menu"),
      // All list items
      menuItems = topMenu.find("a"),
      // Anchors corresponding to menu items
      scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
      });

  // Bind click handler to menu items
  // so we can get a fancy scroll animation
  menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top-70;
    $('html, body').stop().animate({ 
        scrollTop: offsetTop
    }, 300);
    e.preventDefault();
  });

  // Bind to scroll
  $(window).scroll(function(){
     // Get container scroll position
     var fromTop = $(this).scrollTop()+80;
     
     // Get id of current scroll item
     var cur = scrollItems.map(function(){
       if ($(this).offset().top < fromTop)
         return this;
     });
     // Get the id of the current element
     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : "";
     
     if (lastId !== id) {
         lastId = id;
         // Set/remove active class
         menuItems
           .parent().removeClass("active")
           .end().filter("[href='#"+id+"']").parent().addClass("active");
     }                   
  });
    */
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
  $('.form-presentation').on("click", function(e) {
    $('[id^="sections"]').each(function(e) {
      var string = $(this).attr('id');
      var lastTwo = string.substr(string.length - 2);
      var $menuItem = $('.check' + lastTwo + ' i.fa');
      $(this).find('div.form-group').each(function() {
        if ($(this).hasClass('has-error')) {
            $($menuItem).addClass('fa-exclamation-circle');
            $($menuItem).removeClass('fa-plus');        
            // do something
        }
        if ($(this).hasClass('has-success')) {
            $($menuItem).addClass('fa-check');
            $($menuItem).removeClass('fa-plus');        
            // do something
        }
      });
    }); 
  });

  $('.clearButton').on("click", function(e) {
    //clearForm($(this).closest('form'));
  });  
});


