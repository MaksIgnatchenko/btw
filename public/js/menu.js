jQuery('.treeview-toggle').on('click', function (e) {
    _this = $(this).parent();

    if (_this.hasClass('open')) {
        _this.removeClass('open').find('ul').slideUp(500);
    } else {
        $('.treeview').removeClass('open').find('ul').slideUp(500);
        _this.addClass('open');
        _this.find('ul').slideDown(500);
    }

});
$(function () {
    var treeViews = $('.treeview');
    treeViews.each(function () {
        treeItems = $(this).find('ul li > a').map(function () {
            return $(this).attr('href');
        });
        if (treeItems.toArray().find(function (value) {
            if (window.location.href.indexOf(value) !== -1) {
                return true;
            }
        })) {
            $(this).find('ul').slideDown(500);
            $(this).addClass('open');
            return true;
        }
    });
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
