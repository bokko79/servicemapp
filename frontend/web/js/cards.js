// MARKET
$(document).ready(function(){
  $(".comment-link").click(function(){
      $(this).closest('#card_container').find('.comments-area').toggle();
      $('html,body').animate({
              scrollTop: $(this).offset().top-60},
              500);
  });
   $(".bid-link").click(function(){
      $(this).closest('#card_container').find('.bids-area').toggle();
      $('html,body').animate({
              scrollTop: $(this).offset().top-60},
              500);
  });                  
});
