<?php
js::import($jsRoot . 'videojs/video.min.js');
css::import($jsRoot . 'videojs/video-js.min.css');
?>
<?php
$videoHtml = <<<EOT
<video id="VIDEO_ID"
class="video-js vjs-default-skin vjs-big-play-centered "
controls preload="auto" loop='loop' autosplay="VIDEO_AUTOSTART" allowfullscreen=VIDEO_FULLSCREEN
width="VIDEO_WIDTH" height="VIDEO_HEIGHT">
<source src="VIDEO_SRC" />
</video>
EOT;
?>
<script>
$(function()
{
    var videoContainer = <?php echo json_encode($videoHtml);?>;
    $('embed').each(function(index)
    {
        if($(this).hasClass('videojs')) 
        {
            var $embed      = $(this),
                src         = $embed.attr('src'),
                w           = $embed.width(),
                h           = $embed.height(),
                autostart   = $embed.attr('autostart');
                fullscreen  = $embed.attr('allowfullscreen');
                containerID = 'video_' + index;

            $container = videoContainer.replace(/VIDEO_SRC/, src);
            $container = $container.replace(/VIDEO_WIDTH/, w);
            $container = $container.replace(/VIDEO_HEIGHT/, h);
            $container = $container.replace(/VIDEO_ID/, containerID);
            $container = $container.replace(/VIDEO_AUTOSTART/, autostart);
            $container = $container.replace(/VIDEO_FULLSCREEN/, fullscreen);
            $(this).replaceWith($container);
            $('#'+containerID).width(w);
            $('#'+containerID).height(h);
        }
    })
});
</script>
