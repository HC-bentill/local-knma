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
                    <div class="col-md-4">
                      
                    </div>
                    <div align="center" class="col-md-4" style="margin: 0 auto;max-width:20em;max-height:20em;">
                          <div class="example-wrap"  style="margin-bottom: 0em;">
                              <div class="example">
                                <div class="carousel slide" id="exampleCarouselCaptions" data-ride="carousel">
                                  <ol class="carousel-indicators carousel-indicators-fillin">
                                    
                                    <?php $c = 1;
                                    foreach ($eventimage as $img) { ?>
                                    
                              <?php if($c==1){ ?>
                                <li class="active" data-slide-to=". $c ." data-target="#exampleCarouselCaptions"></li>
                              <?php }else{ ?>
                                    <li class="" data-slide-to=". $c ." data-target="#exampleCarouselCaptions"></li>
                                     <?php  }; 
                                      
                                    $c++;
                                    
                                    } ?>
                                  </ol>
                                  
                                   <div class="carousel-inner" role="listbox">
                                    
                                    <?php $c = 1;
                                    foreach ($eventimage as $img) { ?>
                                    
                                    <?php if($c==1){?>
                                    <div class="item active">
                                     <?php }else{?>
                                     <div class="item">
                                     <?php }; ?>
                                      <div class="example exampleZoom" id="exampleZoom">
                                          <a class="inline-block" href="<?php echo base_url();?><?php echo $img->path.$img->image ?>" title=""
                                              data-source="<?php echo base_url();?><?php echo $img->path.$img->image ?>">
                                      <img class="width-full img-responsive" src="<?php echo base_url();?><?php echo $img->path.$img->image ?>" alt="..." />
                                      <div class="carousel-caption">
                                        <h3>Location Image <?php echo $c ?></h3>
                                        
                                      </div>
                                      </a>  
                                      </div>
                                    </div>
                                    
                                    <?php $c++;
                                    
                                    } ?>
                                    
                                    
                                  </div>
                                  <a class="left carousel-control" href="#exampleCarouselCaptions" role="button"
                                  data-slide="prev">
                                    <span class="icon wb-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                  </a>
                                  <a class="right carousel-control" href="#exampleCarouselCaptions" role="button"
                                  data-slide="next">
                                    <span class="icon wb-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                  </a>
                                </div>
                              </div>
                            </div>              
                      
                    </div>
                    <div class="col-md-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                    <div align="center" class="col-md-4 col-xs-4">
                      <h4 class="ccdet"><?php echo $event['eventname'] ?></h4>
                    </div>
                    <div class="col-md-4 col-xs-4">
                      
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    
                      <div class="row">
                        
                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Date</h5>
                          <?php
                          if($event['enddate'] == ""){
                            echo "<h5>". date('d M Y',strtotime($event['date']))."</h5>";
                          }
                          else{
                            echo "<h5>".date('d M Y', strtotime($event['date'])).' To '.date('d M Y', strtotime($event['enddate']))."</h5>";
                          }
                          ?>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Time</h5>
                          <h5><?php echo $event['time']; ?></h5>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Category</h5>
                          <h5><?php echo $event['category_name']; ?></h5>
                        </div>
                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Venue</h5>
                          <h5><?php echo $event['venue']; ?></h5>
                        </div> 
                        
                      </div>

                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        
                         <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Location</h5>
                          <h5><?php echo $event['location']; ?></h5>
                        </div> 

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Ghana Post GPS</h5>
                          <h5><?php echo $event['gpostgps']; ?></h5>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Category</h5>
                          <h5><?php echo $event['category_name']; ?></h5>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Location</h5>
                          <h5><?php echo $event['location']; ?></h5>
                        </div> 
                      </div>

                      <div class="row">
                        &nbsp;
                      </div>

                      <?php if($event['eventcategory'] == 3){?>
                         <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Depature Time</h5>
                          <h5><?php echo $event['departure_from']; ?></h5>
                        </div> 

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Arrival At</h5>
                          <h5><?php echo $event['arrival_at']; ?></h5>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Departure Time</h5>
                          <h5><?php echo $event['departure_time']; ?></h5>
                        </div>

                        <div class="col-md-3 col-xs-6">
                          <h5 class="ccdet">Possible Arrival Time</h5>
                          <h5><?php echo $event['posarrival_time']; ?></h5>
                        </div>
                        <div class="row">
                          &nbsp;
                        </div> 
                      <?php }elseif($event['eventcategory'] == 4){ ?>

                        <div class="row" >
                           <div class="col-md-3 col-xs-6">
                            <h5 class="ccdet">Title</h5>
                            <h5><?php echo $event['title']; ?></h5>
                          </div>

                           <div class="col-md-3 col-xs-6">
                            <h5 class="ccdet">Origin</h5>
                            <h5><?php echo $event['origin']; ?></h5>
                          </div> 

                          <div class="col-md-3 col-xs-6">
                            <h5 class="ccdet">PG</h5>
                            <h5><?php echo $event['PG']; ?></h5>
                          </div>

                          <div class="col-md-3 col-xs-6">
                            <h5 class="ccdet">Release Date</h5>
                            <?php if($event['releasedate'] == ''){ }else{?>
                              <h5><?php echo date('d M Y',strtotime($event['releasedate'])); ?></h5>
                            <?php } ?>
                          </div> 
                        </div>
                        <div class="row">
                          &nbsp;
                        </div>
                      <?php }else{} ?>

                      

                      <div class="row">
                         <div class="col-md-6 col-xs-6">
                          <h5 class="ccdet">Cast</h5>
                          <h5><?php echo $event['cast']; ?></h5>
                        </div>

                        <div class="col-md-6 col-xs-6">
                          <h5 class="ccdet">Description</h5>
                          <h5><?php echo $event['description']; ?></h5>
                          <input type="hidden" id="eventcat" value ="<?php echo $event['eventcategory']; ?>">
                        </div>
                      </div>

                      <div class="row">
                        &nbsp;
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                        <table  class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                  <th>Ticket</th>
                                  <th>Cost</th>
                                  <th>Tickets Generated</th>
                              </tr>
                            </thead>
                           <tbody>
                              <?php foreach($ticket as $tic){?>
                              <tr>
                                  <td>
                                    <?php echo $tic->ticket;?>
                                  <td>
                                    <?php echo $tic->cost; ?>
                                  </td>
                                  <td>
                                    <?= number_of_tickets($eventid,$tic->ticket_costid) ?>
                                  </td>
                              </tr>
                               <?php } ?>
                            </tbody>
                        </table>
                        </div>
                      </div> 
                  </div>
                </div>

            </div>
	       </div>
	      </div>
		  </div>
    </div>
  </div>
  </div>


<!-- modal        -->
   <div class="modal fade example-modal-lg modal-info" aria-hidden="true" aria-labelledby="exampleOptionalLarge"
                  role="dialog" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                          </button>
                          <h4 class="modal-title" id="exampleOptionalLarge">Event Form</h4>
                        </div>
                        <div class="modal-body">
                          <div class="panel panel-primary">
                            <div class="panel-body">
                              <form method="post" action="Event/add_event" autocomplete="off" enctype="multipart/form-data">
                                  <div class="row">
                                      <div class="col col-md-6">

                                          <script type="text/javascript">
                                              function userImg(input) {
                                                  if (input.files && input.files[0]) {
                                                      var reader = new FileReader();
                                                      reader.onload = function(e) {
                                                          $('#user_img')
                                                              .attr('src', e.target.result);
                                                      };
                                                      reader.readAsDataURL(input.files[0]);
                                                  }
                                              }
                                          </script>
                                          <div class="">
                                              <div class="">
                                                  <img src="<?php echo base_url();?>upload/user-avatar.png" id="user_img" class="thumbnail" width="120" height="100">
                                                  <div style="margin-top: -1em;">
                                                      <input name="userfile1[]" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file" multiple="">
                                                  </div>
                                              </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                              <div class="col-sm-12">
                                                <label class="control-label">Time</label>
                                                <input class="form-control" name="time" type="text" value="<?=$event['time']?>" required/>
                                             </div>
                                          </div>
                                      </div>
                                      <div class="col col-md-6">
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control" name="eventname" type="text" value="<?=$event['eventname']?>" required/>
                                                <label class="floating-label">Event Name</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                                <input class="form-control calender" name="date" type="text" value="<?=$event['date']?>" required/>
                                                <label class="floating-label">Date</label>
                                            </div>
                                          </div>
                                          <div class="form-group form-material floating row">
                                            <div class="col col-md-12">
                                                <input class="form-control calender" name="enddate" value="<?=$event['enddate']?>" type="text">
                                                <label class="floating-label">End Date</label>
                                            </div>
                                          </div>
                                      </div>
                               </div>
                               <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <select class="form-control" id="eventcatt" name="eventcategory">
                                                    <?php foreach ($eventcat as $e): ?>
                                                      <option value="<?=$e->categoryid?>"  <?=$event['eventcategory']== $e->categoryid ?'selected=selected':'';?>><?=$e->category_name?></option>
                                                    <?php endforeach ?>  
                                                </select>
                                                 <label class="floating-label">Event Category</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="venue" value="<?=$event['venue']?>" type="text"/>
                                                <label class="floating-label">Venue</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="row"> 
                                    <div class="form-group form-material floating row">
                                        <div class="col-sm-6">
                                                <input class="form-control" name="location" value="<?=$event['location']?>" type="text"/>
                                                <label class="floating-label">Event Location</label>
                                        </div>
                                        <div class="col-sm-6">
                                                <input class="form-control" name="gpostgps" value="<?=$event['gpostgps']?>" type="text"/>
                                                <label class="floating-label">Ghana Post GPS Adress</label>
                                        </div>
                                        
                                    </div>
                                </div>
                                <?php if($event['eventcategory'] == 3){ ?>
                                <div id="transportt">
                                  <div class="row"> 
                                      <div class="form-group form-material floating row">
                                          <div class="col-sm-6">
                                                  <input class="form-control" name="departure_from" value="<?=$event['departure_from']?>" type="text"/>
                                                  <label class="floating-label">Depature From</label>
                                          </div>

                                          <div class="col-sm-6">
                                                  <input class="form-control" name="arrival_at" value="<?=$event['arrival_at']?>" type="text"/>
                                                  <label class="floating-label">Arrival At</label>
                                          </div>
                                      </div>
                                  </div>

                                  <div class="row"> 
                                      <div class="form-group form-material floating row">
                                          <div class="col-sm-6">
                                                  <input class="form-control" name="departure_time" value="<?=$event['departure_time']?>" type="text"/>
                                                  <label class="floating-label">Depature Time</label>
                                          </div>

                                          <div class="col-sm-6">
                                                  <input class="form-control" name="posarrival_time" type="text" value="<?=$event['posarrival_time']?>"/>
                                                  <label class="floating-label">Possible Arrival Time</label>
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                                <?php }elseif($event['eventcategory'] == 4){?>
                                  <div id="moviet"  style="">
                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="title" type="text" value="<?=$event['title']?>"/>
                                                      <label class="floating-label">Title</label>
                                              </div>
                                              <div class="col-sm-6">
                                                      <label class="floating-label">Origin</label>
                                                      <select class="form-control" name="origin">
                                                         <option  <?=$event['origin']== 'Ghallywood' ?'selected=selected':'';?>>Ghallywood</option>
                                                         <option <?=$event['origin']== 'Nollywood' ?'selected=selected':'';?>>Nollywood</option>
                                                         <option <?=$event['origin']== 'Hollywood' ?'selected=selected':'';?>>Hollywood</option>
                                                         <option <?=$event['origin']== 'Bollywood' ?'selected=selected':'';?>>Bollywood</option>
                                                      </select>
                                              </div>
                                          </div>
                                      </div>

                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="director" type="text" value="<?=$event['director']?>"/>
                                                      <label class="floating-label">Director</label>
                                              </div>
                                              <div class="col-sm-6">
                                                    <input class="form-control" name="thumbnail" type="text" value="<?=$event['thumbnail']?>"/>
                                                    <label class="floating-label">Thumbnail</label> 
                                              </div>
                                          </div>
                                      </div>

                                       <div class="row"> 
                                          <div class="form-group form-material floating row">
                                             <div class="col-sm-6">
                                                      <input class="form-control" name="pg" type="text" value="<?=$event['PG']?>"/>
                                                      <label class="floating-label">PG</label>
                                              </div>
                                              <div class="col-sm-6">
                                                    <input class="form-control calender" name="releasedate" type="text" value="<?=$event['releasedate']?>"/>
                                                    <label class="floating-label">Realease Date</label> 
                                              </div>
                                          </div>
                                      </div>
                                    
                                    <div class="row"> 
                                        <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="#" name="cast" rows="2"><?=$event['cast']?>"</textarea>
                                            <label class="floating-label">Cast</label>
                                        </div>
                                            
                                        </div>
                                    </div>
                                   
                                  </div>
                                   <?php }else{}?>
                                  <div class="row"> 
                                        <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                            <textarea class="form-control" id="#" name="description" rows="2"><?=$event['description']?></textarea>
                                            <label class="floating-label">Description</label>
                                        </div>
                                            
                                        </div>
                                  </div>
                                  <h3>Tickets And Cost</h3>
                                  <div class="row">
                                    <div class="col-md-12">
                                        <table id="quotaTbl" class="table table-striped" style="border:none;">
                                            <thead style="border:none;">
                                            <tr style="border:none;">
                                                <th>Ticket</th>
                                                <th>Cost</th>
                                                
                                            </tr>
                                            </thead>


                                            <tbody style="border:none;">

                                            <?php foreach($ticket as $tic){?> 
                                            <tr style="border:none;">
                                                <td>
                                                  <input class="form-control" name="ticket[]" type="text" placeholder="Eg: Premuim, vip, etc" value="<?php echo $tic->ticket;?>" />
                                                <td>
                                                  <input class="form-control" name="cost[]" type="number" placeholder="Eg: 50 , 20 ,30" value="<?php echo $tic->cost; ?>" />
                                                </td>

                                                <td>
                                                    <a href="#" class="btn btn-success btn-sm clone_tbl_row"><i class="fa fa-plus"></i></a>
                                                    <a href="#" class="btn btn-danger btn-sm del"><i class="fa fa-minus"></i></a>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>
                                      </div> 
                                    </div>
                                     <div class="row hidden"> 
                                        <div class="form-group form-material floating row">
                                            <div class="col-sm-12">
                                            <input class="form-control" name="eventid" type="text" value="<?=$event['eventid']?>"/>
                                            <label class="floating-label">eventid</label>
                                        </div>
                                            
                                        </div>
                                  `  </div>              
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer">
                                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  <button type="submit" id="savenew_a" class="btn btn-success">Save</button>
                      </div>
                  </div>
                </form>
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
                              <input class="form-control" name="eventid[]" type="hidden" placeholder="" value="<?=$eventid?>" />
                              <input class="form-control" name="eventidd" type="hidden" placeholder="" value="<?=$eventid?>" />
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

   <script>
            var selected_row_id;
            var selected_agent_id;
            var deleteid;
            
            function initiate_delete(x){
              deleteid = x;
              document.getElementById("dpop").click();
            }
            
            function draw_table(){
              
              $('#something').load('<?=base_url()?>Member/redraw');

            }
            
            function checkAddress(checkbox){
    
                if (document.getElementById(checkbox).checked){
                  var state = "1";
                  //update to true
                }else{
                  //update to false
                  var state = "0";
                }

                var baseurl = "<?php echo base_url(); ?>";       
                var xmlhttp = new XMLHttpRequest();
                var url1 = baseurl + "Agency/update_agency_status/" + checkbox  + "/" + state ;
                var url = url1;   
                
                xmlhttp.onreadystatechange=function() {
                  if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    myFunction(xmlhttp.responseText);
                  }
                }

                xmlhttp.open("GET",url, true);
                xmlhttp.send();
                
                
                function myFunction(response) {
                  
                  document.getElementById("exampleTopRight").click();
                }
            }

            function event(){
              var eventcat = document.getElementById('eventcat').value;

              if(eventcat == 3){
                document.getElementById('transport').style.display = "inline-block";
                document.getElementById('movie').style.display = "none";
              }
              else if(eventcat == 4){
                document.getElementById('transport').style.display = "none";
                document.getElementById('movie').style.display = "inline-block";
              }
              else{
                document.getElementById('transport').style.display = "inline-block";
                document.getElementById('movie').style.display = "inline-block";
              }
            }
    </script>

            