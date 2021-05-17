
  <!-- start: page -->
  
  <div class="row">
    <div class="col-md-12">
      <section class="card card-featured-bottom card-featured-primary">
        <?= $this->session->flashdata('message');?>
        <div class="card-body">
          <div class="col-md-12">
            <table class="table table-bordered table-striped mb-0" id="datatable-tabletools">
              <thead>
                <tr>
                  <th>DATETIME</th>
                  <th>INVOICE NO</th>
                  <th>INVOICE TYPE</th>
                  <th>INVOICE AMOUNT (GHS)</th>
                  <th>ADJUSTMENT AMOUNT (GHS)</th>
                  <th>REASON</th>
                  <th>AUDIT STATUS</th>
                  <th>APPROVAL STATUS</th>
                  <th>DOCUMENT</th>
                  <th>CREATED BY</th>  
                  <?php if(has_permission($this->session->userdata('user_info')['id'],'approve adjustment')){ ?>
                    <th>ACTION</th>
                  <?php }else{ ?>
                    
                  <?php } ?>
                  <?php if(has_permission($this->session->userdata('user_info')['id'],'audit approval')){ ?>
                    <th>AUDIT APPROVAL</th>
                  <?php }else{ ?>
                    
                  <?php } ?>
                </tr>
              </thead>     
              <tbody>
                <?php foreach($result as $value):?>
                  <tr>
                    <td class="text-center">
                        <?= date('Y-m-d H:i:s',strtotime($value->datetime_created))?>
                    </td>
                    <td><?=$value->invoice_no ?></td>
                    <td>
                      <?php if($value->invoice_type == "1"){?>
                        Onetime
                      <?php }else{?>
                        System Generated
                      <?php }?>
                    </td>
                    <td class="text-center"><?=$value->invoice_amount ?></td>
                    <td class="text-center">
                      <b>
                        <?=$value->adjustment_amount ?>
                        <?php if($value->adjustment_type == '-'){?>
                            <i class="fa fa-arrow-down" style="color:red;" aria-hidden="true"></i>
                        <?php }else if($value->adjustment_type == '+'){?>
                          <i class="fa fa-arrow-up" style="color:green;" aria-hidden="true"></i>
                        <?php }else if ($value->adjustment_type == ''){?>
                            
                        <?php }else{ }?>
                      </b>
                    </td>
                    <td><?=$value->reason ?></td>
                    <td class="text-center">
                        <?php if($value->audit_approval == 's'){?>
                            <span class="badge badge-success">Approved</span>
                        <?php }else if($value->audit_approval == 'p'){?>
                            <span class="badge badge-warning">Pending</span>
                        <?php }else if ($value->audit_approval == 'f'){?>
                            <span class="badge badge-danger">Declined</span>
                        <?php }else{ }?>
                    </td>
                    <td class="text-center">
                        <?php if($value->approval_status == 's'){?>
                            <span class="badge badge-success">Approved</span>
                        <?php }else if($value->approval_status == 'p'){?>
                            <span class="badge badge-warning">Pending</span>
                        <?php }else if ($value->approval_status == 'f'){?>
                            <span class="badge badge-danger">Declined</span>
                        <?php }else{ }?>
                    </td>
                    <td>
                      <?php if($value->document == ""){ ?>
                        <span class="badge badge-danger">No Document</span>
                      <?php }else{ ?>
                        <a download="" href="<?= base_url().$value->file_path.$value->document?>"><span class="badge badge-success"><i class="fa fa-download"></i> Download Document</span></a>
                      <?php } ?>
                    </td>
                    <td><?= $value->creator ?></td>
                    <?php if(has_permission($this->session->userdata('user_info')['id'],'approve adjustment')){ ?>
                      <td>
                        <?php if($value->approval_status == 's'){?>
                          
                        <?php }else if($value->approval_status == 'p'){?>
                          <a onclick="confirm_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','s','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-check" style="color:green"></i></a> | 
                          <a onclick="confirm_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','f','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-times" style="color:red"></i></a>   
                        <?php }else if ($value->approval_status == 'f'){?>
                          
                        <?php }else{ ?>
                          
                        <?php } ?>
                      </td>
                    <?php }else{ ?>
                    
                    <?php } ?>
                    <?php if(has_permission($this->session->userdata('user_info')['id'],'audit approval')){ ?>
                        <td>
                            <?php if($value->audit_approval == 's'){?>
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','f','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-times" style="color:red"></i></a>
                            <?php }else if($value->audit_approval == 'p'){?>
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','s','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-check" style="color:green"></i></a> | 
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','f','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-times" style="color:red"></i></a>   
                            <?php }else if ($value->audit_approval == 'f'){?>
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','s','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-check" style="color:green"></i></a>
                            <?php }else{ ?>
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','s','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-check" style="color:green"></i></a> | 
                                <a onclick="approval_modal('<?php echo $value->invoice_id ?>','<?php echo $value->adjustment_amount ?>','<?php echo $value->adjustment_type ?>','<?php echo $value->id ?>','<?php echo $value->approval_status?>','f','<?php echo $value->invoice_no?>','<?php echo $value->invoice_amount?>','<?php echo $value->invoice_type?>');"><i class="fa fa-times" style="color:red"></i></a>  
                            <?php } ?>
                        </td>
                    <?php }else{ ?>
                    
                    <?php } ?>
                  </tr>
                <?php endforeach; ?>
              </tbody>                   
          </table>
        </div>
        </div>
      </section>
    </div>
  </div>
  
<!-- end: page -->
<!-- Modal Form -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicForm" action="<?=base_url("Invoice/process_approval")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">
                      Approval Form
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                        &times;
                      </span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                      <input type="text" class="form-control" id="invoiceno" name="invoiceno" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                      <input type="number" class="form-control" id="invoiceamount" name="invoiceamount" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Adjustment Amount:</strong></label>
                      <input type="number" class="form-control" id="adjustment_amount" name="adjustment_amount" readonly>
                    </div>
                </div>
                <div class="form-group row" style="display:none">
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                      <input type="text" class="form-control" id="adjustmentid" name="adjustmentid">
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                      <input type="text" class="form-control" id="invoiceid" name="invoiceid">
                      <input type="text" class="form-control" id="status" name="status">
                      <input type="text" class="form-control" id="approval_status" name="approval_status">
                      <input type="text" class="form-control" id="invoice_type" name="invoice_type">
                      <input type="text" class="form-control" id="adjustment_type" name="adjustment_type">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Adjustment Type:</strong></label>
                      <input type="text" class="form-control" id="adjustment_type_name" name="adjustment_type_name" readonly>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2" id="reason_text"><strong>Adjustment Reason:</strong></label>
                      <textarea class="form-control" name="reason" id="reason" rows="3"></textarea>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                  </button>
                  <button type="submit" class="btn btn-success">
                      Submit
                    </button>
              </div>
          </div>
        </form>
    </div>
</div>
<!--end::Modal-->

<!-- Modal Form -->
<!--begin::Modal-->
<div class="modal fade" id="m_modal_2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="basicForm" action="<?=base_url("Invoice/process_audit_approval")?>" method="Post">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel_approval">
                      Approval Form
                  </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">
                        &times;
                      </span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                      <input type="text" class="form-control" id="invoiceno_approval" name="invoiceno" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                      <input type="number" class="form-control" id="invoiceamount_approval" name="invoiceamount" readonly>
                    </div>
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Adjustment Amount:</strong></label>
                      <input type="number" class="form-control" id="adjustment_amount_approval" name="adjustment_amount" readonly>
                    </div>
                </div>
                <div class="form-group row" style="display:none">
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice No:</strong></label>
                      <input type="text" class="form-control" id="adjustmentid_approval" name="adjustmentid">
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2"><strong>Invoice Amount:</strong></label>
                      <input type="text" class="form-control" id="invoiceid_approval" name="invoiceid">
                      <input type="text" class="form-control" id="status_approval" name="status">
                      <input type="text" class="form-control" id="approval_status_approval" name="approval_status">
                      <input type="text" class="form-control" id="invoice_type_approval" name="invoice_type">
                      <input type="text" class="form-control" id="adjustment_type_approval" name="adjustment_type">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-4">
                      <label class="control-label text-sm-right pt-2"><strong>Adjustment Type:</strong></label>
                      <input type="text" class="form-control" id="adjustment_type_name_approval" name="adjustment_type_name" readonly>
                    </div>
                    <div class="col-sm-6">
                      <label class="control-label text-sm-right pt-2" id="reason_text_approval"><strong>Adjustment Reason:</strong></label>
                      <textarea class="form-control" name="reason" id="reason_approval" rows="3"></textarea>
                    </div>
                </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                  </button>
                  <button type="submit" class="btn btn-success">
                      Submit
                    </button>
              </div>
          </div>
        </form>
    </div>
</div>
<!--end::Modal-->



 

  


 
  