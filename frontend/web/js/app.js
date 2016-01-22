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
            'top': '50px',
            'z-index': 1000,
        });
        $('header.main nav').css({'box-shadow':'0 1px 7px #000'});
    }
  });
};

$(document).ready(function(){
  $(".search-index").click(function(){
      $(this).closest('.title_holder_home').find('.user-objects-search').toggle();
  });
  // forms and settings divisions titlebars
  $(".settings .wrapper.headline").click(function(){
      $(this).next('.wrapper').toggle();
      $('html,body').animate({
              scrollTop: $(this).offset().top-60},
              500);
  });
  // settings help on right-sidebar
  /*$(".show-more").click(function(){
      $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
      $(this).find('i.fa').toggleClass('fa-chevron-down');
      $(this).find('i.fa').toggleClass('fa-chevron-up');
  });*/
  // settings help on right-sidebar
  $(".hovering .header-context").click(function(){
      $(this).closest('.hidden-content-container').find('div.hidden-content').toggleClass('hidden');
      $(this).closest('.hidden-content-container').find('.show-more i.fa').toggleClass('fa-chevron-down');
      $(this).closest('.hidden-content-container').find('.show-more i.fa').toggleClass('fa-chevron-up');
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
});
