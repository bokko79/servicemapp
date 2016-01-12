// MARKET
$(document).ready(function(){
  $("#category_filter_display").click(function(){
    $('header.main').removeClass('full');
    $('header.main').addClass('full');

    $('html,body').animate({
              scrollTop: 0},
              500);
       
    var category = $(this).closest('body').find('.category.market');

    $('.industry_6box_slider').removeClass('white');

    category.show();

    $('.subindustry0').html(''); 
    $('.subindustry1').hide();
    $('.subindustry2').hide();
    $('.subindustry3').hide();
    $('.subindustry4').hide();
    $('.subindustry5').hide();
    $('.subindustry6').hide();

    var url_glob = '<?php echo Yii::$app->getUrlManager->createUrl("glob-ind-ser"); ?>';
      $.get( url_glob, function(data) {
          $('.industry_6box').html(data);
          sektor1();
          sektor2();
          sektor3();
          sektor4();
          sektor5();
          sektor6();
      });

    var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-market-head"); ?>';
    $.get( url_globHead, function(data) {
        $('.industry_6box_head').html(data);
    }); 

    var url = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-market-body"); ?>';
    $.get( url, function(data) {
        $('.subindustry0').html(data);
    });          
  });                  
});

// REQUEST/SERVICE
$(document).ready(function(){
    $(".first a.show_services").click(function(){
        $('header.main').removeClass('full');
        $('header.main').addClass('full');


        $(this).closest('td').removeClass('passed');
        $(this).closest('td').addClass('active');
        $(this).closest('td').find('.wrap').removeClass('passed');
        $(this).closest('td').find('.wrap').addClass('active');
        $(this).closest('td').next().removeClass('active');
        $(this).closest('td').next().addClass('next');
        $(this).closest('td').next().find('.wrap').removeClass('active');
        $('.shopping_steps .first .arrow').show();

        $('html,body').animate({
                  scrollTop: $(this).offset().top-60},
                  500);

        $('.industry_6box_slider').removeClass('white');

        $('.category').show();


        $('.subindustry0').html(''); 
        $('.subindustry1').hide();
        $('.subindustry2').hide();
        $('.subindustry3').hide();
        $('.subindustry4').hide();
        $('.subindustry5').hide();
        $('.subindustry6').hide();

        var url_glob = '<?php echo Yii::$app->getUrlManager->createUrl("glob-ind-ser"); ?>';
          $.get( url_glob, function(data) {
              $('.industry_6box').html(data);
              sektor1();
              sektor2();
              sektor3();
              sektor4();
              sektor5();
              sektor6();
          });

        var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-services-head"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          }); 

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-services-body"); ?>';
          $.get( url, function(data) {
              $('.subindustry0').html(data);
          });
          
    });                  
});


$(document).ready(function(){
    $("#glob_hover_service, #glob_hover_request, #glob_hover_provider").click(function(){
        $('header.main').removeClass('full');
        $('header.main').addClass('full');
        $('.category').hide();

        $('.industry_6box_head').html(''); 
        $('.industry_6box').html(''); 

        $('.industry_6box_slider').removeClass('white');

        $(this).closest('li').find('.category').show();

        $('.subindustry0').html(''); 
        $('.subindustry1').hide();
        $('.subindustry2').hide();
        $('.subindustry3').hide();
        $('.subindustry4').hide();
        $('.subindustry5').hide();
        $('.subindustry6').hide();

        var url_glob = '<?php echo Yii::$app->getUrlManager->createUrl("glob-ind-ser"); ?>';
          $.get( url_glob, function(data) {
              $('.industry_6box').html(data);
              sektor1();
              sektor2();
              sektor3();
              sektor4();
              sektor5();
              sektor6();
          });

    });                  
});


$(document).ready(function(){
    $("#glob_hover_service").click(function(){
        
        var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-services-head"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          });                    

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-services-body"); ?>';
          $.get( url, function(data) {
              $('.subindustry0').html(data);
          });

    });                  
});

$(document).ready(function(){
    $("#glob_hover_request").click(function(){

        var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-market-head"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          });

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-market-body"); ?>';
          $.get( url, function(data) {
              $('.subindustry0').html(data);
          });
    });                  
});

$(document).ready(function(){
    $("#glob_hover_provider").click(function(){

        var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-providers-head"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          });

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("glob-nav-providers-body"); ?>';
          $.get( url, function(data) {
              $('.subindustry0').html(data);
          });
    });                  
});

/*$(document).ready(function(){
    $("#glob_hover_event").click(function(){
        
        $('.category').hide();

        $(this).closest('li').find('.category').show();

        var url_globHead = '<?php echo Yii::$app->getUrlManager->createUrl("globEventHead"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          });

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("globEvent"); ?>';
          $.get( url, function(data) {
              $('.subindustry0').html(data);
          });
    });                  
});*/

/* CLICK X na desnoj strani gore da se zatvori sve */
function close_category(){
        $('header.main').removeClass('full');

        $('.category').slideUp(400);
      
        $('.subindustry0').html('');   
        $('.subindustry1').hide();
        $('.subindustry2').hide();
        $('.subindustry3').hide();
        $('.subindustry4').hide();
        $('.subindustry5').hide();
        $('.subindustry6').hide(); 
                       
}


function close_all(){
        $('header.main').removeClass('full');
        
        $('.category').slideUp(400);
      
        $('.shopping_steps .first').addClass('passed');
        $('.shopping_steps .first').removeClass('active');
        $('.shopping_steps .first .wrap').addClass('passed');
        $('.shopping_steps .first .wrap').removeClass('active');
        $('.shopping_steps .scond').removeClass('next');
        $('.shopping_steps .scond').addClass('active');
        $('.shopping_steps .scond .wrap').removeClass('next');
        $('.shopping_steps .scond .wrap').addClass('active');
        $('.shopping_steps .first .arrow').hide();

        $('.subindustry0').html('');   
        $('.subindustry1').hide();
        $('.subindustry2').hide();
        $('.subindustry3').hide();
        $('.subindustry4').hide();
        $('.subindustry5').hide();
        $('.subindustry6').hide(); 
                       
}

  $(document).mouseup(function (e)
  {
      var container = $(".category");
      var container_a = $("ul.global_nav li");

      if (!container.is(e.target) // if the target of the click isn't the container...
          && container.has(e.target).length === 0 &&
          !container_a.is(e.target) // if the target of the click isn't the container...
          && container_a.has(e.target).length === 0) // ... nor a descendant of the container
      {
          close_all();                      
      }
  });

  $(document).keyup(function(e) {
       if (e.keyCode == 27) { // escape key maps to keycode `27`
          // <DO YOUR WORK HERE>
          
          close_all();
      }
  });


  

  function sektor1(){
    $(".sektor1").click(function(){
        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind1"); ?>';
              $.get( url, function(data) {
                  $('.subindustry1').html(data);
              });
              $('.subindustry1').slideToggle(600, 'easeInOutExpo');

        $('.subindustry2').slideUp(600, 'easeInOutExpo');
        $('.subindustry3').slideUp(600, 'easeInOutExpo');
        $('.subindustry4').slideUp(600, 'easeInOutExpo');
        $('.subindustry5').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry6').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor2 .popup').removeClass('active');
        $('.sektor3 .popup').removeClass('active');
        $('.sektor4 .popup').removeClass('active');
        $('.sektor5 .popup').removeClass('active');
        $('.sektor6 .popup').removeClass('active');

        /*$('html,body').animate({
                scrollTop: $(this).offset().top-40},
                400);*/
          $('div.category').animate({
                scrollTop: 360},
                400);

    });                  
  }



  function sektor2(){
    $(".sektor2").click(function(){ 

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind2"); ?>';
              $.get( url, function(data) {
                  $('.subindustry2').html(data);
              });
              $('.subindustry2').slideToggle(600, 'easeInOutExpo');

        $('.subindustry1').slideUp(600, 'easeInOutExpo');
        $('.subindustry3').slideUp(600, 'easeInOutExpo');
        $('.subindustry4').slideUp(600, 'easeInOutExpo');
        $('.subindustry5').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry6').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor1 .popup').removeClass('active');
        $('.sektor3 .popup').removeClass('active');
        $('.sektor4 .popup').removeClass('active');
        $('.sektor5 .popup').removeClass('active');
        $('.sektor6 .popup').removeClass('active');

        $('div.category').animate({
                scrollTop: 360},
                400);

    });
  }


  function sektor3(){
    $(".sektor3").click(function(){

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind3"); ?>';
              $.get( url, function(data) {
                  $('.subindustry3').html(data);
              });
              $('.subindustry3').slideToggle(600, 'easeInOutExpo');

        $('.subindustry2').slideUp(600, 'easeInOutExpo');
        $('.subindustry1').slideUp(600, 'easeInOutExpo');
        $('.subindustry4').slideUp(600, 'easeInOutExpo');
        $('.subindustry5').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry6').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor1 .popup').removeClass('active');
        $('.sektor2 .popup').removeClass('active');
        $('.sektor4 .popup').removeClass('active');
        $('.sektor5 .popup').removeClass('active');
        $('.sektor6 .popup').removeClass('active');

        $('div.category').animate({
                scrollTop: 360},
                400);

    });
  }


  function sektor4(){
    $(".sektor4").click(function(){  

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind4"); ?>';
              $.get( url, function(data) {
                  $('.subindustry4').html(data);
              });
              $('.subindustry4').slideToggle(600, 'easeInOutExpo');

        $('.subindustry2').slideUp(600, 'easeInOutExpo');
        $('.subindustry3').slideUp(600, 'easeInOutExpo');
        $('.subindustry1').slideUp(600, 'easeInOutExpo');
        $('.subindustry5').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry6').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor1 .popup').removeClass('active');
        $('.sektor2 .popup').removeClass('active');
        $('.sektor3 .popup').removeClass('active');
        $('.sektor5 .popup').removeClass('active');
        $('.sektor6 .popup').removeClass('active');

        $('div.category').animate({
                scrollTop: 360},
                400);


    });
  }


  function sektor5(){
    $(".sektor5").click(function(){ 

        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind5"); ?>';
              $.get( url, function(data) {
                  $('.subindustry5').html(data);
              });
              $('.subindustry5').slideToggle(600, 'easeInOutExpo');

        $('.subindustry2').slideUp(600, 'easeInOutExpo');
        $('.subindustry3').slideUp(600, 'easeInOutExpo');
        $('.subindustry4').slideUp(600, 'easeInOutExpo');
        $('.subindustry1').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry6').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor1 .popup').removeClass('active');
        $('.sektor2 .popup').removeClass('active');
        $('.sektor3 .popup').removeClass('active');
        $('.sektor4 .popup').removeClass('active');
        $('.sektor6 .popup').removeClass('active');

        $('div.category').animate({
                scrollTop: 360},
                400);

    });
  }


  function sektor6(){
    $(".sektor6").click(function(){
      
        var url = '<?php echo Yii::$app->getUrlManager->createUrl("ind6"); ?>';
              $.get( url, function(data) {
                  $('.subindustry6').html(data);
              });
              $('.subindustry6').slideToggle(600, 'easeInOutExpo');


        $('.subindustry2').slideUp(600, 'easeInOutExpo');
        $('.subindustry3').slideUp(600, 'easeInOutExpo');
        $('.subindustry4').slideUp(600, 'easeInOutExpo');
        $('.subindustry5').slideUp(600, 'easeInOutExpo'); 
        $('.subindustry1').slideUp(600, 'easeInOutExpo');

        $(this).find('.popup').toggleClass('active');
        $('.sektor1 .popup').removeClass('active');
        $('.sektor2 .popup').removeClass('active');
        $('.sektor3 .popup').removeClass('active');
        $('.sektor4 .popup').removeClass('active');
        $('.sektor5 .popup').removeClass('active');

        $('div.category').animate({
                scrollTop: 360},
                400);

    });
  }