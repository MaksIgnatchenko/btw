// it prevents association with #status CSS class in Admiry
$(function () {
    $('select[name=status]').attr('id', '_status');
});
