$(document).ready(function(){
  var nameInput = $('.name_translated');
  var nameInputValue = nameInput.val();
  nameInput.keyUp(function(){
      $(this).closest('.title_holder_home').find('.user-objects-search').toggle();
  });
}