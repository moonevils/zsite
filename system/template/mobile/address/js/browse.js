$(function () {
    $('.item').on('click', function () {
        if ($('.manage').children('p[name="operate"]').attr('current') === 'manageDone') {
            if ($(this).find('input[name="delAddresses"]').attr('checked') === false) {
                $(this).find('input[name="delAddresses"]').attr('checked', true);
            } else {
                $(this).find('input[name="delAddresses"]').removeAttr('checked');
            }
            setDelHref();
        }
    });

    $('.manage').on('click', function () {
        if ($(this).children('p[name="operate"]').attr('current') === 'manage') {
            $(this).children('p[name="operate"]').html($(this).children('input[name="manageDone"]').val());
            $(this).children('p[name="operate"]').attr('current', 'manageDone');
            $('.checkbox-circle').show();
            $('#create').hide();
            $('#delete').show();
            $('.edit-button').hide();
        } else {
            $(this).children('p[name="operate"]').html($(this).children('input[name="manage"]').val());
            $(this).children('p[name="operate"]').attr('current', 'manage');
            $('.checkbox-circle').hide();
            $('#create').show();
            $('#delete').hide();
            $('.edit-button').show();
        }
    });

    $('#allDelete').on('click', function () {
        if ($(this).attr('checked') === true) {
            $('input[name="delAddresses"]').attr('checked', true);
        } else {
            $('input[name="delAddresses"]').removeAttr('checked');
        }
        setDelHref();
    });

    function setDelHref() {
        var delIDs = [];
        $('input[name="delAddresses"]:checked').each(function (i) {
            delIDs[i] = $(this).val();
        });
        var delHref = $('.deleter').attr('href');
        delHref = delHref.replace(/(.*-).*(\..*)/, '$1' + delIDs.join(',') + '$2');
        $('.deleter').attr('href', delHref);
    }
});
