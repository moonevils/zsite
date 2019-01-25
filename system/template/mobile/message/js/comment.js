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
});
