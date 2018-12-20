
/*
 Template Name: Lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Dashboard init js
 */

!function($) {
    "use strict";

    var Dashboard = function() {};
  
    //creates Donut chart
    Dashboard.prototype.createDonutChart = function (element, data, colors) {
        Morris.Donut({
            element: element,
            data: data,
            resize: true,
            colors: colors
        });
    },

    Dashboard.prototype.init = function() {
        
    //creating donut chart
        var $donutData = [
            {label: "Today", value: 40},
            {label: "Monthly", value: 25},
            {label: "Weekly", value: 10},
            {label: "Yearly", value: 25}
        ];
        this.createDonutChart('morris-donut-example', $donutData, ['#FF9801', '#ffd902', '#02aaff','#2eba41']);

        },
    //init
    $.Dashboard = new Dashboard, $.Dashboard.Constructor = Dashboard
}(window.jQuery),

//initializing 
function($) {
    "use strict";
    $.Dashboard.init();
}(window.jQuery);


//Line chart with area

new Chartist.Line('#chart-with-area-daily', {
  labels: ['Monday','Tuesday','Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
  series: [
    [5, 9, 7, 8, 5, 3, 5]
  ]
}, {
  low: 0,
  showArea: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});


new Chartist.Line('#chart-with-area-monthly', {
  labels: ['January','February','March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
  series: [
    [5, 9, 7, 8, 5, 3, 5,2,5, 9, 7, 8]
  ]
}, {
  low: 0,
  showArea: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});

new Chartist.Line('#chart-with-area-yearly', {
  labels: ['2014','2015','2016','2017','2018'],
  series: [
    [5, 9, 7, 8, 9]
  ]
}, {
  low: 0,
  showArea: true,
  plugins: [
    Chartist.plugins.tooltip()
  ]
});




$(document).ready(function(){

    $("#chart-with-area-monthly").hide();
    $("#chart-with-area-yearly").hide();

    $(".daily").click(function(){
        $("#chart-with-area-daily").show();
        $("#chart-with-area-monthly").hide();
        $("#chart-with-area-yearly").hide();

        $('.toggle-div .chart-radio').removeClass('active');
        $('.daily .chart-radio').addClass('active');
    });

    $(".monthly").click(function(){
        $("#chart-with-area-daily").hide();
        $("#chart-with-area-monthly").show();
        $("#chart-with-area-yearly").hide();

        $('.toggle-div .chart-radio').removeClass('active');
        $('.monthly .chart-radio').addClass('active');
    });

    $(".yearly").click(function(){
        $("#chart-with-area-daily").hide();
        $("#chart-with-area-monthly").hide();
        $("#chart-with-area-yearly").show();
        
        $('.toggle-div .chart-radio').removeClass('active');
        $('.yearly .chart-radio').addClass('active');
    });

});