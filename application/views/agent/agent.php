
  <!-- Page -->
<div class="page animsition" id = "something">     
  <div class="page-content container-fluid">
  	<div class="panel" style="min-height: 70px;" >
  		<div class="col-sm-6" >
  			<?php if(has_permission($this->session->userdata('user_info')['id'],'create agent')){ ?>
          <button type="button" class="btn btn-outline btn-responsive btn-primary" data-toggle="modal" data-target=".example-modal-lg" style="margin-right: 2px; margin-top : 15px;">
            <i class="icon wb-user-add" aria-hidden="true"></i>
            <span class="hidden-sm hidden-xs">Add New</span>
          </button>
        <?php }else{ ?>
          <button type="button" class="btn btn-outline btn-responsive btn-primary" onclick='has_permission()' style="margin-right: 2px; margin-top : 15px;">
            <i class="icon wb-user-add" aria-hidden="true"></i>
            <span class="hidden-sm hidden-xs">Add New</span>
          </button>
        <?php } ?>
      </div>      			
	  </div>    
      <div class="row ">
        <div class="col-md-12">
         <?php echo $this->session->flashdata('message'); ?>
         <div class="panel panel-info panel-bordered" data-plugin="appear" data-animate="scale-down">
           <div class="panel-body container-fluid" id="loaddata">
            <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
              
                <thead>
                  <tr>
                    <th><b>Name (Agent Code)</b></th>
                    <th><b>Phone no</b></th>
                    <th><b>ID Type</b></th>
                    <th><b>ID Number</b></th>
                    <th><b>E-mail</b></th>
                    <th><b>Account Status</b></th>
            				<th><b>View</b></th>
                  </tr>
          			</thead>      
               <!--  <?php foreach($result as $row): ?>
                  <tr>
                    <td><?= $row->firstnames.' '.$row->lastname.' ('.$row->agentcode.')'; ?></td>
                    <td><?= $row->phone;?></td>
                    <td><?= $row->idtype;?></td>
                    <td><?= $row->idnum?></td>
                    <td><?= $row->email; ?></td>
                    <?php if($row->accstatus == 'P'){?>
                      <td><span class="label label-warning" Onclick="edit(<?=$row->agentid;?>)">Pending</span></td>
                    <?php }elseif($row->accstatus == 'A'){?>
                      <td><span class="label label-success" Onclick="edit(<?=$row->agentid;?>)">Approved</span></td>
                    <?php }elseif($row->accstatus == 'R'){?>
                      <td><span class="label label-danger" Onclick="edit(<?=$row->agentid;?>)">Rejected</span></td>
                    <?php };?>
                    <td><a href="<?=base_url()?>view_member/<?=$row->agentid;?>"><i class='icon wb-eye' aria-hidden='true' ></i></a></td>
                  </tr>
                <?php endforeach;?> -->
            </table>
        </div>
        
     
	    </div>
	   </div>
		</div>
  </div>
</div>

<?php $this->load->view("agent/agent_modal.php");?>
 



  
  