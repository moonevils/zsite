$(document).ready(function()
{
    $('[name=regAgreement]').change(function()
    {
        var agreement = $('[name=regAgreement]:checked').val(); 
        if(agreement == 'close')
        {
            $('#regAgreementTitle').parents('tr').addClass('hide');
            $('#regAgreementContent').parents('tr').addClass('hide');
        }
        else
        {
            $('#regAgreementTitle').parents('tr').removeClass('hide');
            $('#regAgreementContent').parents('tr').removeClass('hide');
        }
    });

    $('[name=regAgreement]').change();
});
