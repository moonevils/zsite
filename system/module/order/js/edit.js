$(document).ready(function()
{
  $('.product-deleter').click(function(){
    $($(this).parent().prev().children('input').get(0)).val('0');
    $(this).parent().parent().parent().addClass('hidden');
  })
})
