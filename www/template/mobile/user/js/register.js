$(function()
{
    if(v.registerAgreement == 'open')
    {
        $('#submit').attr("disabled",true);
        $("input[name=registerAgreement]").change(function()
        {
            if($('input[name=registerAgreement]').prop('checked'))
            {
                $('#submit').removeAttr("disabled");
            }
            if(!$('input[name=registerAgreement]').prop('checked'))
            {
                $('#submit').attr("disabled", true);
            }
        });
    }
});
