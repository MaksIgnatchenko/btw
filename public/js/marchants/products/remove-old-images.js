$(function () {
    $('li.photo-additional').on('click', function () {
        $(this).parents('form')
            .append($('<input>')
                .attr('name', 'imgs_to_remove[]')
                .val($(this).data('url'))
                .attr('hidden', '')
            );
    });
});