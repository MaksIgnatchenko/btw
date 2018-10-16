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
