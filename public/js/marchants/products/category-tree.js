$(function() {
    function processCategoryTree() {
        var nestingLevel = 0;
        var container = $('div.select-items');
        return function process(categories) {
            nestingLevel++;
            categories.forEach(function(e) {
                var element = container.find(`:contains(${e.name})`);
                if(e.children) {
                    process(e.children);
                }
                if(!e.is_final) {
                    var clone = element.clone();
                    element.replaceWith(clone);
                    element = clone.addClass('not-allowed').click(function(e) {
                        e.stopPropagation();
                    });
                }
                element.css('padding-left', `${nestingLevel}em`);
            });
            nestingLevel--;
        }
    }

    $.get('/categories/tree', function(data){
        processCategoryTree()(data.categories);
    });
});
