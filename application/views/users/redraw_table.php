<?php
      $orgid = $this->session->userdata('user_info')['orgid'];
    	$result = $this->db->query( "select * from users WHERE delete_status='Active' AND orgid = '$orgid' order by user_id asc")->result();
?> 
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables-fixedheader/dataTables.fixedHeader.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.css">
 <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendor/datatable/datatables.min.css"> 

 <table id="tt" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">   
        <thead>
              <tr>
                <th>Username</th>
                <th>Role</th>
                <th>Fullname</th>
                <th>Edit</th>
                <th>Delete</th>
              </tr>
        </thead>           
        <?php 
          $c=1;
            foreach ($result as $row){
              $username = $row->username;   
              $role = $row->role;
              $fullname = $row->fullname;
              $userid = $row->user_id;
              echo '<tr>';
              echo '<td>'. $username . '</td>';
              echo '<td>'. $role . '</td>';
              echo '<td>'. $fullname . '</td>';
              echo "<td><i onclick='lef($userid)' class='icon wb-edit' aria-hidden='true' ></i></td>";
              echo "<td><i onclick='initiate_delete($userid)' class='icon wb-trash' aria-hidden='true' ></i></td>";

              echo '</tr>';
              $c++;
              
            }
        ?>
</table>

 <!-- Core  -->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/animsition/jquery.animsition.js"></script>

  <!-- Plugins -->

  <script src="<?php echo base_url(); ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables-fixedheader/dataTables.fixedHeader.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables-bootstrap/dataTables.bootstrap.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables-responsive/dataTables.responsive.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatables-tabletools/dataTables.tableTools.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/datatable/datatables.min.js"></script>


  <!-- Scripts -->
  <script src="<?php echo base_url(); ?>assets/js/core.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/site.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/sections/menu.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/sections/menubar.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/sections/sidebar.js"></script>

  <script src="<?php echo base_url(); ?>assets/js/components/animsition.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/components/datatables.js"></script>



   <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;

      $(document).ready(function($) {
        Site.run();
      });

      // Fixed Header Example
      // --------------------
      (function() {
        // initialize datatable
        var table = $('#exampleFixedHeader').DataTable({
          responsive: true,
          "bPaginate": false,
          "sDom": "t" // just show table, no other controls
        });

        // initialize FixedHeader
        var offsetTop = 0;
        if ($('.site-navbar').length > 0) {
          offsetTop = $('.site-navbar').eq(0).innerHeight();
        }
        var fixedHeader = new FixedHeader(table, {
          offsetTop: offsetTop
        });

        // redraw fixedHeaders as necessary
        $(window).resize(function() {
          fixedHeader._fnUpdateClones(true);
          fixedHeader._fnUpdatePositions();
        });
      })();

    })(document, window, jQuery);
  </script>
  <script>
    (function(document, window, $) {
      'use strict';

      var Site = window.Site;
      $(document).ready(function() {
        Site.run();
      });
    })(document, window, jQuery);

  </script>

