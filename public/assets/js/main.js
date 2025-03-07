$(function () {
    "use strict";
  
 //Trigger the selectbox

$("select").selectBoxIt({
    autoWidth: false 
  });
  
  
  // Dashbord + icon 
  $('.toggle-info').click(function(){
  
    $(this).toggleClass('selected').parent().next('.panel-body').fadeToggle(100);
  
    if($(this).hasClass('selected')){
    
      $(this).html('<i class="fa fa-plus fa-lg"></i>');
    
    }else{
      $(this).html('<i class="fa fa-minus fa-lg"></i>');
    }
  })
 //Hide placeholder when foucs

 $("[placeholder]")
 .focus(function () {
   $(this).attr("data-text", $(this).attr("placeholder"));
   $(this).attr("placeholder", "");
 })
 .blur(function () {
   $(this).attr("placeholder", $(this).attr("data-text"));
 });

// Add * on Required fileds
$('input').each(function () {
 if ($(this).attr('required') === 'required') {
     $(this).after('<span class="asterisk"> * </span>');
 }
});




});