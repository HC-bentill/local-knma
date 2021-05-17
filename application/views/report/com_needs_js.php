<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/data.js"></script>
<script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
<script src="<?php echo base_url(); ?>assets/js/export-data.js"></script>
<script type="text/javascript">

            // Create the chart
            Highcharts.chart('container7', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: <?=$header?>
                },
                subtitle: {
                    text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total Number Of People'
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
                            format: '{point.y:.f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
                },

                "series": [
                    {
                        "name": "District",
                        "colorByPoint": true,
                        "data": [<?=$graph_data?>]
                    }
                ]
                });
  </script>
  <script type="text/javascript">

            // Create the chart
            Highcharts.chart('container8', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: <?=$header?>
                },
                subtitle: {
                    text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>'
                },
                xAxis: {
                    type: 'category'
                },
                yAxis: {
                    title: {
                        text: 'Total Number Of People'
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
                            format: '{point.y:.f}'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b> of total<br/>'
                },

                "series": [
                    {
                        "name": "District",
                        "colorByPoint": true,
                        "data": [<?=$graph_data?>]
                    }
                ]
                });
  </script>