<script type='text/javascript'>

    $('.bill-details').hide();

    $('body').on('click', '.more-detail-btn', function(event){
        event.preventDefault();
        let btn = $(this),
            icons = $(this).find('i'),
            currentBtnState = "collapsed",
            detailContainerId = ("tbody" + $(this).attr('data-id'));

        if (btn.hasClass('collapsed')) {
            btn.removeClass('collapsed');
            btn.addClass('expanded');
            currentBtnState = "expanded"
        } else {
            btn.removeClass('expanded');
            btn.addClass('collapsed');
            currentBtnState = "collapsed"
        }

        if (icons && currentBtnState == "expanded") {
            $(icons[0]).removeClass('fa-plus');
            $(icons[0]).addClass('fa-minus');
            $("#" + detailContainerId).show();
        } else if (icons && currentBtnState == "collapsed") {
            $(icons[0]).removeClass('fa-minus');
            $(icons[0]).addClass('fa-plus');
            $("#" + detailContainerId).hide();
        }
    });
</script>