jQuery('.treeview-toggle').on('click', function(e){
    e.preventDefault();
    _that = $('.treeview');
    var el = _that.find('ul');
    if (_that.hasClass('open')) {
        el.slideUp(500);
        _that.removeClass('open')
    } else {
        el.slideDown(500);
        _that.addClass('open');
    }
});
$(
    function() {
        var treeView = $('.treeview');
        treeItems = treeView.find('ul li > a').map(function() {
            return $(this).attr('href');
        });
        console.log(treeItems);
        if(treeItems.find(function(value) {
            console.log(value);

            if (window.location.href.indexOf(value)) {return true;}
            return false;
        })) {
            console.log('yep');
        }

       // if()
    }
)
