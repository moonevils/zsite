$(function()
{
    var $commentForm = $('#commentForm'),
        $commentBox = $('#commentBox'),
        $commentContent = localStorage.getItem('commentContent');

    if($commentContent)
    {
        $commentForm.find('#commentContent').val($commentContent);
    }

    $commentBox.find('.pager').on('click', 'a', function()
    {
        $commentBox.load($(this).attr('href'));
        return false;
    });

    $commentForm.ajaxform({
        onSubmit: function () 
        {
            localStorage.setItem('commentContent', $commentForm.find('#commentContent').val());
        },
        onSuccess: function(response)
        {
            if(response.result == 'success')
            {
                localStorage.setItem('commentContent', '');
                $commentForm.find('#commentContent').val('');
                setTimeout($.refreshCommentList, 200);
                $('.comment-list').show();
            }
        }
    });

    var moreRepliesHide = function ()
    {
        $('.comment').each(function ()
        {
            var i = 0;
            $(this).children('.replies').find('.reply-heading').each(function ()
            {
                i++;
                if(i > 3) $(this).hide();
            });
            var j = 0;
            $(this).children('.replies').find('.reply-body').each(function ()
            {
                j++;
                if(j > 3) $(this).hide();
            });
            $(this).find('.more-replies-amount').html(j - 3);
        });
    };
    moreRepliesHide();

    $('.more-replies').on('click', function ()
    {
        $(this).hide();
        $(this).parent().parent().children('.replies').find('.reply-heading,.reply-body').show();
    });

});
