/*
 Template Name: Admiry - Bootstrap 4 Admin Dashboard
 Author: Themesdesign
 Website: www.themesdesign.in
 File: C3 Chart init js
 */

!function($) {
    "use strict";

    var ChartC3 = function() {};

    ChartC3.prototype.init = function () {
        //generating chart
        c3.generate({
            bindto: '#chart',
            data: {
                columns: [
                    ['Desktop', 150, 80, 70, 152, 250, 95],
                    ['Mobile', 200, 130, 90, 240, 130, 220],
                    ['Tablet', 300, 200, 160, 400, 250, 250]
                ],
                type: 'bar',
                colors: {
                    Desktop: '#2683d8',
                    Mobile: '#67a8e4',
                    Tablet: '#a8cdf0'
                }
            }
        });


    };
        $.ChartC3 = new ChartC3;
    $.ChartC3.Constructor = ChartC3

}(window.jQuery),

//initializing
    function($) {
        "use strict";
        $.ChartC3.init()
    }(window.jQuery);


