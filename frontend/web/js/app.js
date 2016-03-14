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

  $(".industries-six-boxes-link").click(function(){
      /*$('.subindustry0').html('');
      $('.subindustry1').hide();
      $('.subindustry2').hide();
      $('.subindustry3').hide();
      $('.subindustry4').hide();
      $('.subindustry5').hide();
      $('.subindustry6').hide();*/
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 365}, 400);
  });

  $(".industries-six-boxes-link-mini").click(function(){
      /*$('.subindustry0').html('');
      $('.subindustry1').hide();
      $('.subindustry2').hide();
      $('.subindustry3').hide();
      $('.subindustry4').hide();
      $('.subindustry5').hide();
      $('.subindustry6').hide();*/
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 78}, 400);
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
  $('#provider-industries').on("show.bs.modal", function(e) {
    $(this).find(".modal-body").load('/provider-industries', function() {
      $('#providerindustries-selection').select2();
    });
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
