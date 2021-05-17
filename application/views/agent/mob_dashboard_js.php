<?php
  $get_agent_daily_registration = get_agent_daily_registration($this->uri->segment(2));
?>
<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/data.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/export-data.js"></script>
 <script type="text/javascript">

       // Create the chart
       Highcharts.chart('container', {
           chart: {
               type: 'pie'
           },
           title: {
               text: 'Registration Status Statistic.'
           },
           subtitle: {
               text: ''
           },
           plotOptions: {
               series: {
                   dataLabels: {
                       enabled: true,
                       format: '{point.name}: {point.y:.f}'
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
                   "data": [<?=get_reg_stats($this->uri->segment(2))?>]
               }
           ]
       });
 </script>
 <script type="text/javascript">
       // Create the chart
       Highcharts.chart('container5', {
           chart: {
               type: 'column'
           },
           title: {
               text: 'Statistic On Your Data Collection.'
           },
           subtitle: {
               text: ''
           },
           xAxis: {
               type: 'category'
           },
           yAxis: {
               title: {
                   text: 'Total Number Of Registrations'
               }

           },
           plotOptions: {
               series: {
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
                   "data": [<?=get_agent_data_stat($this->uri->segment(2))?>]
               }
           ]
       });
 </script>
 <script type="text/javascript">

     // Create the chart
     Highcharts.chart('container6', {
         chart: {
             type: 'column'
         },
         title: {
             text: 'Daily Registration'
         },
         subtitle: {
             text: ''
         },
         xAxis: {
             categories: [<?=$get_agent_daily_registration[1]?>],
             crosshair: true
         },
         yAxis: {
             title: {
                 text: 'Total Count Of Daily Registrants'
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

         credits: {
             enabled: false
         },

         "series": [
             {
                 "name": "Date",
                 "colorByPoint": true,
                 "data": [<?=$get_agent_daily_registration[0]?>]
             }
         ],

     });
 </script>
