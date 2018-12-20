/*
 Template Name: Lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Morris chart Init
 */


!function ($) {
    "use strict";

    var MorrisCharts = function () {
    };

        //creates area chart
        MorrisCharts.prototype.createAreaChart = function (element, pointSize, lineWidth, data, xkey, ykeys, labels, lineColors) {
            Morris.Area({
                element: element,
                pointSize: 0,
                lineWidth: 0,
                data: data,
                xkey: xkey,
                ykeys: ykeys,
                labels: labels,
                resize: true,
                gridLineColor: '#eee',
                hideHover: 'auto',
                lineColors: lineColors,
                fillOpacity: .6,
                behaveLikeLine: true
            });
        },


        MorrisCharts.prototype.init = function () {


            //creating area chart
            // var $areaData = [
            //     {y: '2007', a: 0, b: 0, c:0},
            //     {y: '2008', a: 150, b: 45, c:15},
            //     {y: '2009', a: 60, b: 150, c:195},
            //     {y: '2010', a: 180, b: 36, c:21},
            //     {y: '2011', a: 90, b: 60, c:360},
            //     {y: '2012', a: 75, b: 240, c:120},
            //     {y: '2013', a: 30, b: 30, c:30}
            // ];
            // this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a', 'b', 'c'], ['Series A', 'Series B', 'Series C'], ['#ccc', '#36508b', '#3eb7ba']);

            //creating area chart
            var $areaData = [
                {y: '09', a: 0},
                {y: '10', a: 150},
                {y: '11', a: 60},
                {y: '12', a: 180},
            ];
            this.createAreaChart('morris-area-example', 0, 0, $areaData, 'y', ['a'], ['Series A'], ['#36508b']);

           
        },
        //init
        $.MorrisCharts = new MorrisCharts, $.MorrisCharts.Constructor = MorrisCharts
}(window.jQuery),

//initializing 
    function ($) {
        "use strict";
        $.MorrisCharts.init();
    }(window.jQuery);