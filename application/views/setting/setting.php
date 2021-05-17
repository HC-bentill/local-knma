 <div class="page animsition">
    <div class="page-content container-fluid">
      <div class="panel">
        <div class="panel-body">
          <?=$this->session->flashdata('message'); ?>
          <div class="row">
            <div class="col-md-12">
              <h4 style="font-weight: bold;">Agency Details</h4>
            </div>
          </div>
          <form method="post" action="Setup/update_agency" autocomplete="off" enctype="multipart/form-data">
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
                              <img src="<?php echo base_url();?><?=$result['logo']?>" id="user_img" class="thumbnail" width="120" height="100">
                              <div style="margin-top: -1em;">
                                  <input name="userfile" onchange="userImg(this);" value="" id="filePhoto" data-errormsg="PhotoUploadErrorMsg" type="file">
                                  <input type="hidden" name="img_path" value="<?=$result['logo'];?>">
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
            	<div class="row">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      <label class="control-label">Agency Code</label>
                      <input class="form-control" id="agencycode" name="agencycode" type="text" value="<?=$result['agencycode'];?>" onKeyUp="check_username();" disabled/>
                      <p id="status" class="privacy text-left" style="display:none">Available</p>                               
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-5">
                       <label class="control-label">Agency Name</label>
                      <input class="form-control" name="agencyname" type="text" value="<?=$result['agencyname'];?>"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      <label class="control-label">Agency Type</label>
                      <select class="form-control" name="agencytype">
                        <?php foreach ($type as $t): ?>
                          <option value="<?=$t->agency_typeid?>" <?= $t->agency_typeid == $result['agencytype'] ?'selected=selected':'';?> ><?=$t->agency_typename?></option>
                        <?php endforeach ?>  
                      </select>
                                                      
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-5">
                       <label class="control-label">E-mail</label>
                      <input class="form-control" name="email" type="text" value="<?=$result['email'];?>"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      <label class="control-label">Contact</label>
                      <input class="form-control" name="contact" type="text" value="<?=$result['contact'];?>"/>
                                                      
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-5">
                       <label class="control-label">Location</label>
                      <input class="form-control" name="location" type="text" value="<?=$result['location'];?>"/>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      <label class="control-label">Website Url</label>
                      <input class="form-control" name="weburl" type="text" value="<?=$result['weburl'];?>"/>
                                                      
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-5">
                       <label class="control-label">Description</label>
                       <textarea class="form-control" id="#" name="description" rows="1"><?=$result['description'];?></textarea>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row hidden">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      <label class="control-label">Agency Id</label>
                      <input class="form-control" name="agencyid" value="<?=$result['agencyid'];?>" type="text"/>
                                                      
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                  </div>
                </div>
              </div>

               <div class="row">
                <div class="col-md-12">
                  <div class="form-group form-material floating row">
                    <div class="col-md-5">
                      
                                                      
                    </div>
                    <div class="col-md-2">
                      
                    </div>
                    <div class="col-md-5">
                      <button type="submit" style="float: right;" id="savenew_a" class="btn btn-success">Update</button>
                    </div>
                  </div>
                </div>
              </div>
          </form>

        </div>
      </div>
    </div>
</div>

<script type="text/javascript">
  function check_username(){
      
      var vfing = "This agent code is available to use"
      document.getElementById("status").innerHTML= vfing ;
      //document.getElementById("sbt").disabled  = true ;
      
      var baseurl = "<?php echo base_url(); ?>";
      var username = document.getElementById("agencycode").value;
    
      document.getElementById("status").style.display = 'inline-block';
      document.getElementById("status").innerHTML = "This agent code is available to use";
      document.getElementById("savenew_a").disabled  = false ;
      
      
      var n = username.length;
    
      if (n == "0") {
        document.getElementById("status").innerHTML= "" ;
      }
    
        var url = baseurl + "Agency/search_agencycode/" + username;
        
        var xmlhttp = new XMLHttpRequest();
    
        xmlhttp.onreadystatechange=function() {
          if (this.readyState == 4 && this.status == 200) {
            myFunction(this.responseText);
          }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();
        
        function myFunction(response) {
          
          
          var arr = JSON.parse(response);
      
          for (var i = 0; i < arr.length; i++) {
        
          
          var userid = arr[i].user_id;
          
          if (userid != "") {
            
            document.getElementById("status").style.display = 'inline-block';
            document.getElementById("status").innerHTML = "This agent code is already taken";
            document.getElementById("savenew_a").disabled  = true ;
              
          } 
          } 
        }
  
  }
</script>           
      