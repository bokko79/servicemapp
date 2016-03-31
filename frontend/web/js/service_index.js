$(document).ready(function(){
  // 6-boxes
  $(".industries-six-boxes-link").on('click', function(){
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 425}, 400);
  });

  $(".industries-six-boxes-link-mini").on('click', function(){
      $('.six_boxes_container_industries').show();      
      sektor();
      $('body').animate({scrollTop: 78}, 400);
  });
// load modal contents
  $('#provider-industries').one("show.bs.modal", function(e) {
    $(this).find(".modal-body").load('/provider-industries', function() {
      $('#providerindustries-selection').select2();
    });
  });

  $("[id^='object-models-order-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('object-models-order-modal', '');
    $(this).find(".modal-body").load('/objectModelsOrder?id=' + lastChar, function() {
      checkAllOrNone();
    });    
  });

  $("[id^='object-models-present-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('object-models-present-modal', '');
    $(this).find(".modal-body").load('/objectModelsPresent?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });

  $("[id^='object-models-proservice-modal']").one("show.bs.modal", function(e) {
    var id = $(this).attr('id');
    var lastChar = id.replace('object-models-proservice-modal', '');
    $(this).find(".modal-body").load('/objectModelsPresentProSer?id=' + lastChar, function() {
      checkAllOrNone();
    });
  });  
});