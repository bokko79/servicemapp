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
              scrollTop: $(this).offset().top-60},
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

  $(".industries-six-boxes-link").on('click', function(){
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 365}, 400);
  });

  $(".industries-six-boxes-link-mini").on('click', function(){
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 78}, 400);
  });
  // autocomplete
  $('.search_icon').on("click", function(e) {
    $(this).addClass('active');
    $(this).find('.subnav-fixed.search').show();
    $('.close_search').show();
  });
  
  // toggle select/deselect all checkboxes
  $( "[id^='ckbCheckAll']").on('click', function () {
    $(this).closest('.enclosedCheckboxes').find("input[type='checkbox']").prop('checked', $(this).prop('checked'));
  });
  // new order time
  $("#orders-new_time").click(function(){
      var radioValue = $("input[name='Orders[new_time]']:checked").val();
      if(radioValue==0){
        $('.enter_time').slideDown();    
        $('html,body').animate({
          scrollTop: $(this).offset().top-60},
          500);
      } else {
        $('.enter_time').hide();
      }
  });

  //new presentation availability
  $("#presentations-availability").click(function(){
      var radioValue = $("input[name='Presentations[availability]']:checked").val();
      if(radioValue==0){
        $('.enter_dates').slideDown();    
        $('html,body').animate({
          scrollTop: $(this).offset().top-60},
          500);
      } else {
        $('.enter_dates').hide();
        $('input[name="available_from-presentations-available_from"]').val('');
        $('input[name="available_until-presentations-available_until"]').val('');
      }
  });

  $(".new_obj").on('click', function(){  
    $('.enter_objectSpec').slideDown(); 
    $("#cartform-user_object").val('');
    $("#checkUserObject_model").val(0);
    $("form").validateSpecs();
    $('html,body').animate({
      scrollTop: $(this).offset().top-60},
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
          scrollTop: $(this).offset().top-60},
          500);
      } else {
        $('.signUpForm').show();
        $('.loginForm').hide();
        $('html,body').animate({
          scrollTop: $(this).offset().top-60},
          500);  
      }
  });
  $(window).on("hashchange", function () {
    window.scrollTo(window.scrollX, window.scrollY - 70);
  });

  // presentations specs
  $(".new_pres_spec").on('click', function(){  
    $('.enter_presSpec').slideDown(); 
    $("#presentations-provider_presentation_specs").val('');
    $(".pres-specs-plaza").html('');
    $('html,body').animate({
      scrollTop: $(this).offset().top-70},
      500);
  });

  $("#presentations-provider_presentation_specs").on('change', function(){                  
    $('.enter_presSpec').hide();
    $(".pres-specs-plaza").show().load('/showThemSpecs?id=' + $(this).val());
  });
  // presentations pics
  $(".new_pres_pics").on('click', function(){  
    $('.enter_presPics').slideDown(); 
    $("#presentations-provider_presentation_pics").val('');
    $(".pres-pics-plaza").html('');
    $('html,body').animate({
      scrollTop: $(this).offset().top-70},
      500);
  });

  $("#presentations-provider_presentation_pics").on('change', function(){                  
    $('.enter_presPics').hide();
    $(".pres-pics-plaza").show().load('/showThemPics?id=' + $(this).val());
  });

  var max_fields      = 10; //maximum input boxes allowed
  var wrapper         = $(".input_object_syn_wrap"); //Fields wrapper
  var add_button      = $(".add_object_syn_button"); //Add button ID
  
  var x = 1; //initlal text box count
  $(add_button).click(function(e){ //on add input button click
      e.preventDefault();
      if(x < max_fields){ //max input box allowed
          x++; //text box increment
          $(this).closest(wrapper).append('<div class=" margin-bottom-15"><input type="text" name="Presentations[issues][]" class="form-control float-left" style="width:70%;" /><a href="#" class="remove_field btn btn-link"> <i class="fa fa-minus-circle"></i> Izbaci</a></div>'); //add input box
          
      }
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
      e.preventDefault(); $(this).parent('div').remove(); x--;
  })

  // load modal contents
  $('#provider-industries').on("show.bs.modal", function(e) {
    $(this).find(".modal-body").load('/provider-industries', function() {
      $('#providerindustries-selection').select2();
    });
  });

  $("[id^='object-models-present-modal']").on("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.substr(id.length - 1);
    $(this).find(".modal-body").load('/objectModelsPresent?id=' + lastChar);
  });

  $("[id^='object-models']").on("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.substr(id.length - 1);
    $(this).find(".modal-body").load('/objectModelsPresentProSer?id=' + lastChar);
  });

  $("[id^='object-models-modal']").on("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.substr(id.length - 1);
    $(this).find(".modal-body").load('/objectModelsOrder?id=' + lastChar);
  });

  $('.collapsing').on("click", function(e) {
    $(this).toggleClass('inverted normal');
    $(this).closest("#card_container").find('.secondary-context').each(function(){
      $(this).toggle();
    });
    $('html,body').animate({
              scrollTop: $(this).offset().top-70},
              500);
  });

  //highlight menu item on scroll
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
});
