$(document).ready(function()
{
    $('[name=registerAgreement]').change(function()
    {
        var registerAgreement = $('[name=registerAgreement]:checked').val(); 
        if(registerAgreement == 'close') 
        {
            $('#registerAgreementContent').parents('tr').addClass('hidden');
            $('#registerAgreementTitle').parents('tr').addClass('hidden');
        }
        else 
        {
            $('#registerAgreementContent').parents('tr').removeClass('hidden');
            $('#registerAgreementTitle').parents('tr').removeClass('hidden');
        }
    });
    $('[name=registerAgreement]').change();
});
