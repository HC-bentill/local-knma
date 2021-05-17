 <?php
    $data = get_data_stat();
    $data_area_council = get_data_area_council_statss();
    $get_daily_registration = get_daily_registration();
    // $get_data_integrity = get_data_integrity();
    $month_ago = new DateTime('now'); $month_ago->modify('1 month ago'); $month_ago = $month_ago->format('Y-m-d');
    $get_weekly_registration = get_weekly_registration($month_ago, date('Y-m-d'));
    $total_registration_month = get_total_registration(date('Y-m').'-01',date('Y-m-d'));
    $total_registration_ytd = get_total_registration_ytd('2018-01-01',date('Y-m-d'));
    $get_registration_status_month = get_registration_status(date('Y-m').'-01',date('Y-m-d'));
    $get_registration_status_ytd = get_registration_status('2018-01-01',date('Y-m-d'));
    $get_top_weekly_registration = get_top_weekly_registration(date('Y-m-d'));
    // $gender_data = get_gender_stats();
    // $gender_area_council = get_gender_area_council();
    // $educational_data = get_educational_data();
    // $education_area_council = get_area_edu_data();
    // $profession_data = get_profession_data();
    // $profession_area_data = get_area_profession_data();
    // $employment_data = get_employment_status_data();
    // $employment_area_council_data = get_area_employment_status_dataa();
    // $com_needs_data = get_com_need_stats();
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
               "data": [<?=$gender_data?>]
           }
       ],
       colors: shuffle(['#17a2b8', '#50b432']),
       "drilldown": {
           "series": <?=$gender_area_council?>
       }
   });
 </script> -->
 <script type="text/javascript">

   // Create the chart
   Highcharts.chart('container5', {
       chart: {
           type: 'pie'
       },
       title: {
           text: 'Statistic On Data.'
       },
       subtitle: {
           text: 'Click the pie-chart to view electoral area statistic on data collected.'
       },
       plotOptions: {
           series: {
               dataLabels: {
                   enabled: true,
                   format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
               }
           }
       },

       tooltip: {
           headerFormat: '<span style="font-size:11px">{point.name}</span><br>',
           pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
       },

       "series": [
           {
               "name": "Electoral Area",
               "colorByPoint": true,
               "data": [<?=$data?>]
           }
       ],
       colors: shuffle(['#17a2b8', '#50b432', '#f4516c', '#22b9ff']),
       "drilldown": {
           "series": <?=$data_area_council?>
       }
   });
 </script>
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
               "data": [<?=$employment_data?>]
           }
       ],
       colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
       "drilldown": {
           "series": <?=$employment_area_council_data?>
       }
   });
 </script> -->
 <script type="text/javascript">

// Create the chart
Highcharts.chart('container7', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Residence Properties Toilet Facilities.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on toilet facilities of residence properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_residence_toilet_facility_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_residence_toilet_facility_data()?>
    }
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container8', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Business Properties Toilet Facilities.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on toilet facilities of business properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_business_property_toilet_facility_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_business_property_toilet_facility_data()?>
    }
});
</script>
 <script type="text/javascript">

// Create the chart
Highcharts.chart('container9', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Residence Properties Means Of Disposal.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on means of disposal of residence properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_residence_means_disposal_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_residence_means_disposal_data()?>
    }
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container10', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Business Properties Means Of Disposal.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on means of disposal of business properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_business_property_means_disposal_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_business_property_means_disposal_data()?>
    }
});
</script>

<script type="text/javascript">

// Create the chart
Highcharts.chart('container11', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Residence Properties Building Permit.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on building permits of residence properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_residence_building_permit_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_residence_building_permit_data()?>
    }
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container12', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Business Properties Building Permit.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on building permits of business properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_business_building_permit_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_business_building_permit_data()?>
    }
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container21', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Building Permit Of Permanent Business Properties'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on building permits of permanent business properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_permanent_business_building_permit_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_permanent_business_building_permit_data()?>
    }
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container22', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Statistic On Building Permit Of Temporary Business Properties.'
    },
    subtitle: {
        text: 'Click the pie-chart to view electoral area statistic on building permits of temporary business properties.'
    },
    plotOptions: {
        series: {
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>:<br>{point.percentage:.1f} %<br>value: {point.y}'
            }
        }
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '{point.name}: <br>{point.percentage:.1f} %<br>value: {point.y}'
    },

    "series": [
        {
            "name": "Municipal",
            "colorByPoint": true,
            "data": [<?=get_temporary_business_building_permit_data()?>]
        }
    ],
    colors: shuffle(['#50b432', '#f4516c', '#22b9ff']),
    "drilldown": {
        "series": <?=get_area_temporary_business_building_permit_data()?>
    }
});
</script>
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
         colors: shuffle(['#006080']),
         "series": [
             {
                 "name": "District",
                 "colorByPoint": true,
                 "data": [<?=$com_needs_data?>]
             }
         ]
         });
 </script>
 <script type="text/javascript">

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
         colors: shuffle(['#f451a0']),
         "drilldown": {
             "series": <?=$profession_area_data?>
         }
     });
 </script>
 <script type="text/javascript">

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
               colors: shuffle(['#17a2b8']),
               "drilldown": {
                   "series": <?=$education_area_council?>
               }
               });
 </script> -->

 <script type="text/javascript">

     // Create the chart
     Highcharts.chart('container13', {
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
             categories: [<?=$get_daily_registration[1]?>],
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
                 "data": [<?=$get_daily_registration[0]?>]
             }
         ],

     });
 </script>
 <script type="text/javascript">

// Create the chart
Highcharts.chart('container14', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Weekly Registration'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$get_weekly_registration[1]?>],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Total Count Of Registrants'
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
            "name": "Agent",
            "colorByPoint": true,
            "data": [<?=$get_weekly_registration[0]?>]
        }
    ],

    });
</script>
<!-- <script type="text/javascript">

// Create the chart
Highcharts.chart('container15', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Data Integrity'
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

    credits: {
        enabled: false
    },

    "series": [
        {
            "name": "District",
            "colorByPoint": true,
            "data": [<?=$get_data_integrity?>]
        }
    ],
});
</script> -->
<script type="text/javascript">

// Create the chart
Highcharts.chart('container16', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total registration – MTD'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$total_registration_month[1]?>],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Total registration – MTD'
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
            "name": "Agent",
            "colorByPoint": true,
            "data": [<?=$total_registration_month[0]?>]
        }
    ],
    colors: shuffle(['#E9967A', '#FFA07A'])

});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container17', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Total registration – YTD'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$total_registration_month[1]?>],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Total registration – YTD'
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
            "name": "Agent",
            "colorByPoint": true,
            "data": [<?=$total_registration_ytd[0]?>]
        }
    ],
    colors: shuffle(['#E9967A', '#FFA07A'])
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container18', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Registration Status - MTD'
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
        },
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
            "name": "Electoral Area",
            "colorByPoint": true,
            "data": [<?=$get_registration_status_month?>]
        }
    ],
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container19', {
    chart: {
        type: 'pie'
    },
    title: {
        text: 'Registration Status - YTD '
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

    credits: {
        enabled: false
    },

    "series": [
        {
            "name": "Electoral Area",
            "colorByPoint": true,
            "data": [<?=$get_registration_status_ytd?>]
        }
    ],
});
</script>
<script type="text/javascript">

// Create the chart
Highcharts.chart('container20', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Top 5 Agents This Week (<?=$get_top_weekly_registration[2]?>)'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: [<?=$get_top_weekly_registration[1]?>],
        crosshair: true
    },
    yAxis: {
        title: {
            text: 'Total Count Of Registrants This Week'
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
            "name": "Agent",
            "colorByPoint": true,
            "data": [<?=$get_top_weekly_registration[0]?>]
        }
    ],

});
</script>
