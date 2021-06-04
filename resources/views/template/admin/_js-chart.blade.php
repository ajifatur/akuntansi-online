<script type="text/javascript" src="{{ asset('assets/plugins/chart.js/chart.min.js') }}"></script>
<script>
    function generate_chart_line(selector, data, moneyFormat = false){
        var ctx = document.getElementById(selector);
        var myChart = new Chart(ctx, {
            type: "line",
            data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            // min: 0,
                            beginAtZero: true,
                            callback: function(value, index, values){
                                if(moneyFormat == true){
                                    return thousand_format(value.toString(), 'Rp ');
                                }
                                else{
                                    if(Math.floor(value) === value){
                                        return thousand_format(value.toString());
                                    }   
                                }
                            }
                        }
                    }]
                }
            }
        });
        return myChart;
    }

    function generate_chart_bar(selector, data, moneyFormat = false){
        var ctx = document.getElementById(selector);
        var myChart = new Chart(ctx, {
            type: "bar",
            data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            // min: 0,
                            beginAtZero: true,
                            callback: function(value, index, values){
                                if(moneyFormat == true){
                                    if(Math.floor(value) === value){
                                        return thousand_format(value.toString(), 'Rp ');
                                    } 
                                }
                                else{
                                    if(Math.floor(value) === value){
                                        return thousand_format(value.toString());
                                    }   
                                }
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                          return tooltipItem[0].label;
                        },
                        label: function(tooltipItem, data) {
                          return moneyFormat == true ? thousand_format(tooltipItem.yLabel.toString(), 'Rp ') : thousand_format(tooltipItem.yLabel.toString());
                        }
                    }
                }
            }
        });
        return myChart;
    }

    function generate_chart_doughnut(selector, data, moneyFormat = false){
        var ctx = document.getElementById(selector);
        var myChart = new Chart(ctx, {
            type: "doughnut",
            data: {
                labels: data.labels,
                datasets: data.datasets,
            },
            options: {
                responsive: true,
                cutoutPercentage: 75,
                legend: {
                    // display: false
                },
                tooltips: {
                    callbacks: {
                        title: function(tooltipItem, data) {
                            return data['labels'][tooltipItem[0]['index']];
                        },
                        label: function(tooltipItem, data) {
                            return moneyFormat == true ? thousand_format(data['datasets'][0]['data'][tooltipItem['index']], 'Rp ') : thousand_format(data['datasets'][0]['data'][tooltipItem['index']]);
                        }
                    }
                }
            },
        });
        return myChart;
    }
</script>