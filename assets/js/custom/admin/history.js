/*
 Template Name: Lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Chartist init js
 */

//Overlapping bars on mobile - Monthly
var data = {
  labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
  series: [
    [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
    [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4],
    [5, 5, 3, 7, 5, 10, 10, 4, 8, 10, 6, 8]
  ]
};

var options = {
  seriesBarDistance: 10
};

var responsiveOptions = [
  ['screen and (max-width: 640px)', {
    seriesBarDistance: 5,
    axisX: {
      labelInterpolationFnc: function (value) {
        return value[0];
      }
    }
  }]
];

new Chartist.Bar('#overlapping-bars-monthly', data, options, responsiveOptions);


//- Yearly
var data = {
  labels: ['2016', '2017', '2018', '2019'],
  series: [
    [5, 4, 3, 7],
    [3, 2, 9, 5],
    [5, 5, 3, 7]
  ]
};

new Chartist.Bar('#overlapping-bars-yearly', data, options, responsiveOptions);

$(document).ready(function(){

    $("#overlapping-bars-yearly").hide();

    $(".yearly").click(function(){
        $("#overlapping-bars-yearly").show();
        $("#overlapping-bars-monthly").hide();

        $(".selected-g-type").html('Yearly');
        // $('.toggle-div .chart-radio').removeClass('active');
        // $('.daily .chart-radio').addClass('active');
    });

    $(".monthly").click(function(){

        $("#overlapping-bars-yearly").hide();
        $("#overlapping-bars-monthly").show();
        $(".selected-g-type").html('Monthly');
        // $('.toggle-div .chart-radio').removeClass('active');
        // $('.monthly .chart-radio').addClass('active');
    });

});




