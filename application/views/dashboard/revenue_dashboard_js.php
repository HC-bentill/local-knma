<?php


$get_revenue = get_total_revenue();
$get_total_revenue_yearly = get_total_revenue_yearly();
$get_revenue_drill = get_revenue_drill();
$get_revenue_year_drill = get_revenue_year_drill();

$get_revenue_by_collectors = get_collectors_total_revenue();

$get_revenue_streams = collections_revenue_streams();

$get_revenue_streams_drill = get_revenue_streams_drill();

$get_revenue_by_bop = collections_revenue_bop();
?>

<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/export-data.js"></script>
<script type="text/javascript">


     function shuffle(array) {
         let currentIndex = array.length,
             temporaryValue, randomIndex;

         // While there remain elements to shuffle...
         while (0 !== currentIndex) {

             // Pick a remaining element...
             randomIndex = Math.floor(Math.random() * currentIndex);
             currentIndex -= 1;

             // And swap it with the current element.
             temporaryValue = array[currentIndex];
             array[currentIndex] = array[randomIndex];
             array[randomIndex] = temporaryValue;
         }

         return array;
     }

     let colors = shuffle([
         '#e9b704',
         '#c50d63',
         '#89A54E',
         '#ffccff',
         '#492970',
         '#4b0d2b',
         '#319fbb',
         '#0d233a',
         '#4572A7',
         '#B5CA92',
         '#8bbc21',
         '#910000',
         '#77a1e5',
         '#c42525',
         '#a6c96a',
         '#1aadce',
         '#2f7ed8',
         '#AA4643',
         '#80699B',
         '#3D96AE',
         '#DB843D',
         '#92A8CD',
         '#A47D7C',
         '#f28f43',
     ]);
 </script>
<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container_new', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Revenue Collection'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: 'Total Collections',
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total Count Of Collections'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    //  format: '{point.name}{Total Value: point.y}'
                    format: '{point.name}</span>: <b>{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
        },
        credits: {
            enabled: false
        },
        "series": [{
            "name": "Total Transaction",
            "colorByPoint": true,
            "data": [
                <?php if (isset($total_rev_buttons)) {
                    echo $total_rev_buttons;
                } else {
                    echo $get_revenue;
                } ?>
            ]
        }],
        colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
        "drilldown": {
            "series": <?php print_r($get_revenue_drill) ?>
        }


    });
</script>

<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container_streams', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Revenue Collection Per Business Streams'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: 'Total Collections',
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total Count Of Collections'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                //  borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}</span>: <b>{point.y:.f}'
                    //  format: '{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
        },
        credits: {
            enabled: false
        },
        "series": [{
            "name": "Total Transaction",
            "colorByPoint": true,
            "data": [
                <?php if (isset($streams_chat_btn)) {
                    echo json_encode($streams_chat_btn);
                } else {
                    echo $get_revenue_streams;
                } ?>
            ]
        }],
        colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
         "drilldown": {
            "series": <?php print_r($get_revenue_streams_drill) ?>
         }


    });
</script>




<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container_collectors', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Revenue Collection Per Collectors'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: 'Total Transactions',
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total Count Of Transactions'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}</span>: <b>{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
        },
        credits: {
            enabled: false
        },
        "series": [{
            "name": "Total Transaction",
            "colorByPoint": true,
            "data": [
                <?php if (isset($collectors_chat_btn)) {
                    echo $collectors_chat_btn;
                } else {
                    echo $get_revenue_by_collectors;
                } ?>
            ]
        }],
        colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
        "drilldown": {
            "series": <?php print_r($get_revenue_drill) ?>
        }


    });
</script>

<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container_bop', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Revenue Collection Per Business Type'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: 'Total Revenue',
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total Count Of Revenue'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    format: '{point.name}</span>: <b>{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
        },
        credits: {
            enabled: false
        },
        "series": [{
            "name": "Total Revenue",
            "colorByPoint": true,
            "data": [
                <?php if (isset($week_revenue)) {
                    echo json_encode($week_revenue);
                } else {
                    echo $get_revenue_by_bop;
                } ?>
            ]
        }],
        colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
        "drilldown": {
            "series": <?php print_r($get_revenue_drill) ?>
        }


    });
</script>



<script type="text/javascript">
    // Create the chart
    Highcharts.chart('container_rev_year', {
        chart: {
            type: 'pie'
        },
        title: {
            text: 'Total Collections Per Year'
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: 'Total Collections Per Year',
            crosshair: true
        },
        yAxis: {
            title: {
                text: 'Total Collections Per Year'
            }

        },
        legend: {
            enabled: false
        },
        plotOptions: {
            series: {
                borderWidth: 0,
                dataLabels: {
                    enabled: true,
                    //  format: '{point.name}{Total Value: point.y}'
                    format: '{point.name}</span>: <b>{point.y:.f}'
                }
            }
        },

        tooltip: {
            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
        },
        credits: {
            enabled: false
        },
        "series": [{
            "name": "Total Yearly Transaction",
            "colorByPoint": true,
            "data": [
                <?php 
                    echo $get_total_revenue_yearly;
                 ?>
            ]
        }],
        colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
        "drilldown": {
            "series": <?php print_r($get_revenue_year_drill) ?>
        }


    });
</script>