$(function()
{
    if(v.regAgreement == 'open')
    {
        $('#submit').attr("disabled",true);
        $("input[name=registerAgreement]").change(function()
        {
            if($('input[name=registerAgreement]').prop('checked'))
            {
                $('#submit').attr("disabled", false);
            }
            if(!$('input[name=registerAgreement]').prop('checked'))
            {
                $('#submit').attr("disabled", true);
            }
        });
    }
});
