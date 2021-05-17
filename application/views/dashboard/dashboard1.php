<?php
   //$data = get_gender_stats();
   // $educational_data = get_educational_data();
   // $profession_data = get_profession_data();
   // $profession_area_data = get_area_profession_data();
   // $edu_area_data = get_area_edu_data();
?>

<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/data.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/drilldown.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
 <script src="<?php echo base_url(); ?>assets/js/export-data.js"></script>
 <script type="text/javascript">
     function shuffle(array) {
           let currentIndex = array.length, temporaryValue, randomIndex;

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
 <!-- <script type="text/javascript">

       // Create the chart
       Highcharts.chart('container', {
           chart: {
               type: 'pie'
           },
           title: {
               text: 'Statistic On Gender Of Household Occupants.'
           },
           subtitle: {
               text: 'Click the pie chat to view area council statistic on gender.'
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
                   "data": [<?=$data?>]
               }
           ],
           colors: shuffle(['#2f7ed8', '#0d233a', '#8bbc21', '#910000', '#1aadce','#492970', '#f28f43', '#77a1e5', '#c42525', '#a6c96a','#e9b704','#c50d63','#89A54E','#ffccff','#492970','#4b0d2b','#319fbb','#0d233a','#77a1e5','#c42525','#a6c96a','#1aadce','#2f7ed8','#AA4643','#80699B','#3D96AE','#DB843D','#92A8CD','#A47D7C','#f28f43',"#319fbb"]),
           "drilldown": {
               "series": [<?=get_gender_area_council()?>]
           }
       });
 </script> -->
 <!-- <script type="text/javascript">

           // Create the chart
           Highcharts.chart('container1', {
               chart: {
                   type: 'column'
               },
               title: {
                   text: 'Statistic On Highest Educational Level Of Household Occupants'
               },
               subtitle: {
                   text: 'Click the columns to view area council statistic on highest education of household.'
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
                       "data": [<?=$educational_data?>]
                   }
               ],
               "drilldown": {
                   "series": [<?=get_area_edu_data()?>]
               }
               });
 </script> -->
 <!-- <script type="text/javascript">

           // Create the chart
           Highcharts.chart('container6', {
               chart: {
                   type: 'column'
               },
               title: {
                   text: 'Statistic On Top 5 community needs'
               },
               subtitle: {
                   text: 'This shows the top 5 community needs at the district level.'
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
                       "data": [<?=get_com_need_stats()?>]
                   }
               ]
               });
 </script> -->
 <!-- <script type="text/javascript">

           // Create the chart
           Highcharts.chart('container2', {
               chart: {
                   type: 'column'
               },
               title: {
                   text: 'Statistic On Professions Of Household Occupants'
               },
               subtitle: {
                   text: 'Click the columns to view area council statistic on profession of household.'
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
                       "data": [<?=$profession_data?>]
                   }
               ],
               "drilldown": {
                   "series": [<?=$profession_area_data?>]
               }
           });
 </script> -->
 <!-- <script type="text/javascript">

       // Create the chart
       Highcharts.chart('container4', {
           chart: {
               type: 'pie'
           },
           title: {
               text: 'Statistic On Employment Status.'
           },
           subtitle: {
               text: 'Click the pie-chart to view area council statistic on employment status of household.'
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
                   "data": [<?=get_employment_status_data()?>]
               }
           ],
           "drilldown": {
               "series": [<?=get_area_employment_status_data()?>]
           }
       });
 </script> -->
 <!-- <script type="text/javascript">

       // Create the chart
       Highcharts.chart('container5', {
           chart: {
               type: 'pie'
           },
           title: {
               text: 'Statistic On Data.'
           },
           subtitle: {
               text: 'Click the pie-chart to view area council statistic on data collected.'
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
                   "data": [<?=get_data_stat()?>]
               }
           ],
           "drilldown": {
               "series": [<?=get_data_area_council_stats()?>]
           }
       });
 </script> -->
