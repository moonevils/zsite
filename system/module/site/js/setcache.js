$(document).ready(function(){
  $('#clearButton').click(function(){
    $(this).text(v.clearing);

    $.getJSON($(this).attr('href'), function(response){
      if(response.result == 'success')
      {
        $('#clearButton').text(v.cleared).removeClass('btn-primary').addClass('btn-success');
        return true;
      }
      else
      {
        $('#clearButton').text(response.message).removeClass('btn-primary').addClass('btn-danger');
        $('#saveCacheSetting').after(v.clearCacheTip);
        return false;
      }
    });
    return false;
  });
})
