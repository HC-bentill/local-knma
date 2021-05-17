<?php
  $pie = '';
  $pie .= "{ name: 'Tickets Sold,y:5'},{ name: 'Tickets Unsold,y:4'}";
  //exit(var_dump($pie));
?>	
<style>
  .ccdet {
    font-weight: bold;
  }
  
  .ccdetinfo {
    
  }
</style>
<!-- Page -->
  <div class="page animsition" id = "something">
       
    <div class="page-content container-fluid">
          
      	<div class="panel" style="min-height: 70px;" >
          		<div class="col-sm-12" >
          			<a href="<?=base_url()?>event">
                  <button type="button" class="btn btn-outline btn-responsive btn-primary" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-reply" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Back</span>
          			   </button>
                </a>
          			<button type="button" class="btn btn-outline btn-responsive btn-primary" onclick="window.print()" style="margin-right: 2px; margin-top : 15px;"  ><i class="icon wb-print" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Print</span>
          			</button>

                 <button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-edit" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Edit</span>
                </button>

                <button type="button" onclick='initiate_delete(<?=$event['eventid']?>)' class="btn btn-outline btn-responsive btn-danger" style="margin-right: 2px; margin-top : 15px;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Delete</span>
                </button>
                <button type="button" class="btn btn-outline btn-responsive btn-success"  data-toggle="modal" data-target="#myAgent" style="margin-right: 2px; margin-top : 15px;"><i class="icon fa fa-ticket" aria-hidden="true"></i><span class="hidden-sm hidden-xs">Generate Tickets</span>
                </button>

                <button id="dpop" type="button" class="btn btn-outline btn-primary btn-responsive deleteEvent" style="margin-right: 2px; margin-top : 15px; display: none;"><i class="icon wb-trash" aria-hidden="true"></i><span class="hidden-sm hidden-xs" >Delete</span>
                </button>
				      </div>
              <div style="display: none" class="col-sm-4 margin-bottom-10">
                  <a class="btn btn-block btn-success" id="exampleTopRight" data-plugin="toastr"
                  data-message="Agency status was updated"
                  data-container-id="toast-top-right" data-position-class="toast-top-right"
                  href="javascript:void(0)" role="button"></a>
              </div>      			
	  	</div>    
   <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
            <div class="panel-body container-fluid" id="loaddata">
              <div class="row">
                <div class="col-md-12">
                  <div class="col-md-6">
                    <div id="contain" class="no_print" style="min-width: 310px; height: 250px; margin: 0 auto"></div> 
                  </div>
                  <div class="col-md-6">
                    
                  </div>
                </div>
              </div>
	          </div>
	      </div>
		  </div>
    </div>
  </div>
  </div>

   <!--  Add agent modal-->
    <div id="myAgent" class="modal fade modal-info" id="exampleModalInfo" aria-hidden="true" aria-labelledby="exampleModalInfo" role="dialog" tabindex="-1">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header panel-heading">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Generate Tickets</h4>
          </div>
          <div class="modal-body">
              <form method="post" action="<?=base_url()?>Ticket/generate_ticket" autocomplete="off" />
              <div class="row">
                  <div class="col-xs-12">
                    <table class="table table-striped" style="border:none;">
                        <thead style="border:none;">
                        <tr style="border:none;">
                            <th>Ticket</th>
                            <th>No Of Tickets</th>
                        </tr>
                        </thead>


                        <tbody style="border:none;">

                        <?php foreach($ticket as $tic){?> 
                        <tr style="border:none;">
                            <td>
                              <?=$tic->ticket?>
                              <input class="form-control" name="ticket[]" type="hidden" value="<?php echo $tic->ticket_costid;?>" />
                            <td>
                              <input class="form-control" name="number[]" type="number" placeholder="Number of ticket" />
                              <input class="form-control" name="eventid[]" type="hidden" placeholder="" value="<?=$this->uri->segment(2)?>" />
                              <input class="form-control" name="eventidd" type="hidden" placeholder="" value="<?=$this->uri->segment(2)?>" />
                            </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                  </div>
              </div>   
          </div>
          <div class="modal-footer">
              <button type="submit" class="btn btn-success">Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </form>

<script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/series-label.js"></script>
<script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
<script type="text/javascript">

      Highcharts.chart('contain', {
          chart: {
              plotBackgroundColor: null,
              plotBorderWidth: null,
              plotShadow: false,
              type: 'pie'
          },
          title: {
              text: 'Ticket Statistics'
          },
          tooltip: {
              pointFormat: '{series.name}: <b>{point.y:.1f}</b>'
          },
          plotOptions: {
              pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                      enabled: true,
                      format: '<b>{point.name}</b>: {point.y:.1f}',
                      style: {
                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                      }
                  }
              }
          },
          series: [{
              name: 'Ticket Statistics',
              colorByPoint: true,
              data: [{
                name: 'Tickets Not Sold',
                y: 56.33
            }, {
                name: 'Tickets Sold',
                y: 24.03
            }]
          }]
      });
 </script>
