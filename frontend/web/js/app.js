$(document).ready(function(){
  $(".search-index").click(function(){
      $(this).closest('.title_holder_home').find('.user-objects-search').toggle();
  });
  $(".settings .wrapper.headline").click(function(){
      $(this).next('.wrapper').toggle();
      $('html,body').animate({
              scrollTop: $(this).offset().top-60},
              500);
  });              
});
