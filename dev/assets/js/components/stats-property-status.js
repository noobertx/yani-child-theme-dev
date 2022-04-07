/* ------------------------------------------------------------------------ */
/*  Status chart for agent and agency
 /* ------------------------------------------------------------------------ */
(function($,Chart){

    if( $('#stats-property-status').length > 0 ) { 
        var chartData = $('#stats-property-status').data('chart');
        var ctx = document.getElementById('stats-property-status').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                datasets: [{
                    data: chartData,
                    backgroundColor: [
                    'rgba(255, 99, 132, 0.5)',
                    'rgba(54, 162, 235, 0.5)',
                    'rgba(255, 206, 86, 0.5)',
                    'rgba(75, 192, 192, 0.5)'
                    ],
                    borderColor: [
                    'rgba(255 ,99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                cutoutPercentage: 60,
                responsive: false,
                tooltips: false,
            }
        });
    }
})(jQuery,Chart)