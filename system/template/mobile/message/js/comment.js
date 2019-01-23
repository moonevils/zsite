$(function()
{
    var $commentForm = $('#commentForm'),
        $commentBox = $('#commentBox'),
        $commentContent = localStorage.getItem('commentContent');
    console.log('+++++1+++++' + $commentContent);
    if($commentContent)
    {
        $commentForm.find('#commentContent').val($commentContent);
    }

    $.refreshCommentList = function()
    {
        $('#commentsListWrapper').load(window.location.href + ' #commentsList');
    };

    $commentBox.find('.pager').on('click', 'a', function()
    {
        $commentBox.load($(this).attr('href'));
        return false;
    });

    $commentForm.ajaxform({
        onSubmit: function () {
            localStorage.setItem('commentContent', $commentForm.find('#commentContent').val());
        },
        onSuccess: function(response)
        {
            localStorage.setItem('commentContent', '');
            if(response.result == 'success')
            {
                $commentForm.find('#commentContent').val('');
                setTimeout($.refreshCommentList, 200)
            }
        }
    });
});