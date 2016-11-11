$(document).ready(function(){
  $('#clearButton').click(function(){
    $(this).text(v.clearing);

    $.getJSON($(this).attr('href'), function(response){
      if(response.result == 'success')
      {
        $('#clearButton').text(v.clear);
         new $.zui.Messager(v.cleared, {
               type: 'success'
         }).show();
        return true;
      }
      else
      {
        $('#clearButton').text(response.message).removeClass('btn-primary').addClass('btn-danger');
        $('#clearButton').attr("disabled","disabled")
        $('#saveCacheSetting').after(v.clearCacheTip);
        return false;
      }
    });
    return false;
  });
})
