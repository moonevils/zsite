$(document).ready(function()
{
    $('[name=filterUsernameSensitive]').change(function()
    {
        var filterUsernameSensitive = $('[name=filterUsernameSensitive]:checked').val(); 
        if(filterUsernameSensitive == 'close') $('#usernameSensitive').parents('tr').addClass('hidden');
        else $('#usernameSensitive').parents('tr').removeClass('hidden');
    });
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
    $('[name=filterUsernameSensitive]').change();
    $('[name=registerAgreement]').change();
});
