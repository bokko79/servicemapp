<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;

?>
<script type="text/javascript">            
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

    var url_glob = '<?= Url::to("/global-nav/glob-ind-ser") ?>';
    $.get( url_glob, function(data) {
        $('.industry_6box').html(data);
        sektor();
    });

    var url_globHead = '<?= Url::to("/glob-nav-market-head") ?>';
    $.get( url_globHead, function(data) {
        $('.industry_6box_head').html(data);
    }); 

    var url = '<?= Url::to("/glob-nav-market-body") ?>';
    $.get( url, function(data) {
        $('.subindustry0').html(data);
    });          
  }); 

// REQUEST/SERVICE
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

    var url_glob = '<?= Url::to("/global-nav/glob-ind-ser") ?>';
      $.get( url_glob, function(data) {
          $('.industry_6box').html(data);
          sektor();
      });

    var url_globHead = '<?= Url::to("/glob-nav-services-head") ?>';
      $.get( url_globHead, function(data) {
          $('.industry_6box_head').html(data);
      }); 

    var url = '<?= Url::to("/glob-nav-services-body") ?>';
      $.get( url, function(data) {
          $('.subindustry0').html(data);
      });          
  });     

// GLOBAL NAV GENERAL
  $("#glob_hover_service, #glob_hover_market, #glob_hover_provider").click(function(){
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

    var url_glob = '<?= Url::to("/glob-ind-ser") ?>';
    $.get( url_glob, function(data) {
        $('.industry_6box').html(data);
        sektor();
    });
  });  

// SERVICES
  $("#glob_hover_service").click(function(){      
    var url_globHead = '<?= Url::to("/glob-nav-services-head") ?>';
    $.get( url_globHead, function(data) {
        $('.industry_6box_head').html(data);
    });                    

    var url = '<?= Url::to("/glob-nav-services-body") ?>';
    $.get( url, function(data) {
        $('.subindustry0').html(data);
    });
  });                  

// MARKET
  $("#glob_hover_market").click(function(){
    var url_globHead = '<?= Url::to("/glob-nav-market-head") ?>';
    $.get( url_globHead, function(data) {
        $('.industry_6box_head').html(data);
    });

    var url = '<?= Url::to("/glob-nav-market-body") ?>';
    $.get( url, function(data) {
        $('.subindustry0').html(data);
    });
  }); 

  $("#glob_hover_provider").click(function(){
    var url_globHead = '<?= Url::to("/glob-nav-providers-head") ?>';
    $.get( url_globHead, function(data) {
        $('.industry_6box_head').html(data);
    });

    var url = '<?= Url::to("/glob-nav-providers-body") ?>';
    $.get( url, function(data) {
        $('.subindustry0').html(data);
    });
  });                  
});

/*$(document).ready(function(){
    $("#glob_hover_event").click(function(){
        
        $('.category').hide();

        $(this).closest('li').find('.category').show();

        var url_globHead = '<?= Url::to("globEventHead"); ?>';
          $.get( url_globHead, function(data) {
              $('.industry_6box_head').html(data);
          });

        var url = '<?= Url::to("globEvent"); ?>';
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

$(document).mouseup(function (e){
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

$(document).keyup(function (e) {
  if (e.keyCode == 27) { // escape key maps to keycode `27`
    close_all();
  }
});


function sektor(){
  $("[id^=sektor]").click(function(){
    var id = $(this).attr('id');
    var lastChar = id.substr(id.length - 1);
    var sub = '.subindustry' + lastChar;

    $.post('<?= Url::to("/getid"); ?>', { 
          lastChar: lastChar 
      }, function(data){
        $.get( data, function(data) {
          $(sub).html(data);
        });

        $(sub).slideToggle(300);

        for (i = 1; i < 7; i++) { 
          var subindustry = '.subindustry' + i;
          if (i!=lastChar) {
            $(subindustry).slideUp(300);
          }
        }

        $(this).find('.popup').toggleClass('active');
        for (i = 1; i < 7; i++) { 
          var popup = '#sektor' + i + ' .popup';
          if (i!=lastChar) {
            $(popup).removeClass('active');
          }
        }
    });

    $('div.category').animate({scrollTop: 365}, 400);
  });
}
</script>
