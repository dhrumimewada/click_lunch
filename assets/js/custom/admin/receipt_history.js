
/*
 Template Name: Lexa - Responsive Bootstrap 4 Admin Dashboard
 Author: Themesbrand
 File: Dashboard init js
 */
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

    $("#chart-with-area-yearly").hide();

   

    $(".monthly").click(function(){

        $("#chart-with-area-monthly").show();
        $("#chart-with-area-yearly").hide();

        $('.toggle-div .chart-radio').removeClass('active');
        $('.monthly .chart-radio').addClass('active');
        
        $(".selected-g-type").html('Monthly');
    });

    $(".yearly").click(function(){

        $("#chart-with-area-monthly").hide();
        $("#chart-with-area-yearly").show();
        
        $('.toggle-div .chart-radio').removeClass('active');
        $('.yearly .chart-radio').addClass('active');

        $(".selected-g-type").html('Yearly');
    });

});