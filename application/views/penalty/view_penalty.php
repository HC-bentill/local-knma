
<!-- start: page -->

<div class="row">
    <div class="col-md-12">
        <section class="card card-featured-bottom card-featured-primary">
            <div class="card-body">
                <div class="col-md-12">
                    <table id="datatable-tabletools" class="table table-hover dataTable table-striped width-full" data-plugin="dataTable" style="cursor: pointer;">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Category Level</th>
                            <th>Category</th>
                            <th>Penalty Mode</th>
                            <th>Penalty Amount</th>
                            <th>Penalty Percentage</th>
<!--                            <th>Delete</th>-->
                        </tr>
                        </thead>
                        <?php

                        foreach ($result as $row){
                            $product_id = $row->product_id;
                            $subcat_id = $row->subcat_id;
                            $subcat_level = $row->subcat_level;
                            $penalty_mode = $row->penalty_mode;
                            $penalty_amount = $row->penalty_amount;
                            $penalty_percentage = $row->penalty_percentage;

                            $product_name = get_product_name($product_id);
                            if(isset($subcat_level) && $subcat_level != ''){
                                $category_name = get_category_name($subcat_id, $subcat_level);
                            } else{
                                $category_name = '';
                            }

                            $subcat_level_name = (isset($subcat_level) && $subcat_id != '') ? 'Category'.$subcat_level : '';
                            $penalty_percentage = (isset($penalty_percentage) && $penalty_percentage != '') ? $penalty_percentage.'%' : '';

                            $url = base_url().'edit_penalty/'.$product_id;
                            echo '<tr>';
                            echo '<td>'. $product_name . '</td>';
                            echo '<td>'. $subcat_level_name . '</td>';
                            echo '<td>'. $category_name . '</td>';
                            echo '<td>'. $penalty_mode . '</td>';
                            echo '<td>'. $penalty_amount . '</td>';
                            echo '<td>'. $penalty_percentage . '</td>';
//                            if(has_permission($this->session->userdata('user_info')['id'],'delete user')){
//                                echo "<td><i onclick='initiate_delete($product_id)' class='icon wb-trash' aria-hidden='true' ></i></td>";
//                            }else{
//                                echo "<td><i onclick='has_permission()' class='icon wb-trash' aria-hidden='true' ></i></td>";
//                            }
//
//                            echo '</tr>';

                        }
                        ?>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>

<!-- end: page -->









