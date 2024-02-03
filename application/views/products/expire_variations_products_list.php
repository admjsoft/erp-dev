<style>
     .custom-class-red {
    background-color: #b30000 I !important; /* Replace with your color for 'yes' */
    }

    .custom-class-red.odd {
    background-color: #b30000 !important; /* Replace with your desired color */
    }

    .custom-class-red.even {
        background-color: #b30000 !important; /* Replace with your desired color */
    }

 
    .custom-class-red1 {
    background-color: #ff0000 I !important; /* Replace with your color for 'yes' */
    }

    .custom-class-red1.odd {
    background-color: #ff0000 !important; /* Replace with your desired color */
    }

    .custom-class-red1.even {
        background-color: #ff0000 !important; /* Replace with your desired color */
    }


    
    .custom-class-red2 {
    background-color: #ff2626 I !important; /* Replace with your color for 'yes' */
    }

    .custom-class-red2.odd {
    background-color: #ff2626 !important; /* Replace with your desired color */
    }

    .custom-class-red2.even {
        background-color: #ff2626 !important; /* Replace with your desired color */
    }

    
    .custom-class-red3 {
    background-color: #ff4c4c I !important; /* Replace with your color for 'yes' */
    }

    .custom-class-red3.odd {
    background-color: #ff4c4c !important; /* Replace with your desired color */
    }

    .custom-class-red3.even {
        background-color: #ff4c4c !important; /* Replace with your desired color */
    }

 

</style>    

<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-body">
            <!-- <h5 class="card-title">Employee Details</h5> -->
            <div class="row">


                <div class="col-md-2">
                    <div class="form-group">
                        <label class="float-left" for="autocomplete"><?php echo $this->lang->line('Product Code'); ?></label>
                        <input type="text" id="product_code" list="datalistOptions" name="autocomplete"
                            class="form-control">
                        <datalist id="datalistOptions">
                            <!-- Replace these options with your actual autocomplete options -->
                            <?php if(!empty($product_codes)) { foreach( $product_codes as $p_code){ ?>
                            <option value="<?php echo $p_code['product_code']; ?>">
                                <?php }} ?>
                                <!-- Add more options as needed -->
                        </datalist>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="form-group">
                        <label for="employee"><?php echo $this->lang->line('Category'); ?></label>
                        <select class="form-control" id="do_type">
                            <option value="" selected>All</option>
                            <?php if(!empty($cat)){ foreach ($cat as $row) { ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['title']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>


                                <?php /* ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="startDate">Expiry Start Date</label>
                        <input type="date" class="form-control" id="do_start_date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="endDate">Expiry End Date</label>
                        <input type="date" class="form-control" id="do_end_date">
                    </div>
                </div>
                <?php */ ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="submit">&nbsp;</label>
                        <button class="btn btn-primary form-control" style="background-color:#B68DB8 !important;" id="search">Search</button>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <div class="card">
        <div class="card-header">
           
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                        <li><a data-action="close"><i class="ft-x"></i></a></li>
                    </ul>
                </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>

            <div class="card-body">
            <div class="row" >
                <div class="col-md-12">
                <h4 style="background-color:#B68DB8 !important; padding:7px;"> <strong><?php echo $this->lang->line('Product Expiry Details') ?> </strong><h4>
                </div>    
                </div>

                <table id="productstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead style="background-color:#B68DB8 !important;">
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Product Name') ?></th>
                            <th><?php echo $this->lang->line('Product Code') ?></th>
                            <th><?php echo $this->lang->line('Qty') ?></th>
                            <th><?php echo $this->lang->line('Category') ?></th>
                            
                        </tr>
                    </thead>
                    <tbody id="products_list">


                        <?php if(!empty($products)) { $ii=1; foreach($products as $product){ ?>
                        <tr>
                            <td><?php echo $ii; ?></td>
                            <td><?php echo $product['product_name']; ?></td>
                            <td><?php echo $product['product_code']; ?></td>
                            <td ><a href="#"class="get_product_details" p_id="<?php echo $product['product_code']; ?>" ><?php echo (int)$product['total_qty']; ?></a></td>
                            <td><?php echo $product['title']; ?></td>
                            
                        </tr>
                        <?php $ii++; }} ?>
                    </tbody>
                </table>

            </div>
            <input type="hidden" id="dashurl" value="products/prd_stats">
        </div>

        <!-- Button to trigger modal -->
        <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            Open Modal
        </button> -->

        <!-- The Modal -->
        <div class="modal fade" id="expiry_products_modal">
    <div class="modal-dialog modal-xl"> <!-- Add the modal-xl class -->
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Product Details'); ?></h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
            <div class="row ">

            <div class="col-md-3">
                <div class="form-group">
                    <label for="employee"><?php echo $this->lang->line('Expiry By Month'); ?></label>
                    <select class="form-control" id="expiry_month_days">
                        <option value="" selected><?php echo $this->lang->line('All'); ?></option>
                        <option value="1">1 <?php echo $this->lang->line('Month'); ?></option>
                        <option value="2">2 <?php echo $this->lang->line('Months'); ?></option>
                        <option value="3">3 <?php echo $this->lang->line('Months'); ?></option>
                    </select>
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="submit">&nbsp;</label>
                    <button class="btn btn-primary form-control" style=" border-color: background-color:#B68DB8 !important; background-color:#B68DB8 !important;" id="search_variant_products">Search</button>
                </div>
            </div>

            </div>
                <!-- Table to display data -->
                <table class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%" id="expire_productstable">
                    <thead style="background-color:#B68DB8 !important;">
                        <tr>
                            <th><?php echo $this->lang->line('Product Code'); ?></th>
                            <th><?php echo $this->lang->line('Product Name'); ?></th>
                            <th><?php echo $this->lang->line('Serial No'); ?></th>
                            <th><?php echo $this->lang->line('Created Date'); ?></th>
                            <th><?php echo $this->lang->line('Expiry Date'); ?></th>
                        </tr>
                    </thead>
                    <tbody id="expiry-products-modal-body-content">
                        <!-- Data will be inserted here dynamically -->
                    </tbody>
                </table>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
            </div>
        </div>
    </div>
</div>

<input type="hidden" value="" name="s_product_code" id="s_product_code" />    
        <script type="text/javascript">
        $(document).ready(function() {

            //datatables
            table = $('#productstable').DataTable({
                responsive: true
            });

           

            $('#search').click(function() {

                var cat_id = $('#do_type').val();
                // var start_date = $('#do_start_date').val();
                // var end_date = $('#do_end_date').val();
                var product_code = $('#product_code').val();

                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '<?php echo base_url('products/get_expiry_product_variations_list') ?>',
                    data: {
                        cat_id: cat_id,
                        // start_date: start_date,
                        // end_date: end_date,
                        product_code: product_code
                    },
                    success: function(response) {

                        if (response.status == '200') {
                            $('#productstable').DataTable().destroy();
                            $('#products_list').html('');
                            $('#products_list').html(response.html);
                            $('#productstable').DataTable({
                                'responsive': true
                            });
                        } else {
                            //alert(response.message);
                        }
                        // Handle the response from the controller
                        // console.log(response);
                    },
                    error: function(error) {
                        // console.error(error);
                    }
                });
            });


            $(document).on('click', '.get_product_details', function() {
       
            var p_id = $(this).attr('p_id');
            $('#s_product_code').val(p_id);
                
            $.ajax({
                type: 'POST',        
                dataType: 'json',
                url: '<?php echo base_url('products/get_single_product_variant_details') ?>',
                data: { p_id: p_id },
                success: function (response) {
    
                    if(response.status == '200')
                    {
                      $('#expire_productstable').DataTable().destroy();
                      $('#expiry-products-modal-body-content').html('');
                      $('#expiry-products-modal-body-content').html(response.html);
                      $('#expiry_products_modal').modal('show');
                      $('#expire_productstable').DataTable({'responsive': true});
                    }else{
                        //alert(response.message);
                    }
                    // Handle the response from the controller
                    // console.log(response);
                },
                error: function (error) {
                // console.error(error);
                }
            });
        });
        $(document).on('click', '#search_variant_products', function() {
            
            var p_id = $('#s_product_code').val();
            
            var expire_month = $('#expiry_month_days').val();

            // alert(p_id);
            // alert(expire_month);
                
            $.ajax({
                type: 'POST',        
                dataType: 'json',
                url: '<?php echo base_url('products/get_single_product_variant_details') ?>',
                data: { p_id: p_id, expire_month : expire_month },
                success: function (response) {
    
                    if(response.status == '200')
                    {
                      $('#expire_productstable').DataTable().destroy();
                      $('#expiry-products-modal-body-content').html('');
                      $('#expiry-products-modal-body-content').html(response.html);
                      $('#expiry_products_modal').modal('show');
                    //   $('#expire_productstable').DataTable().columns().every(function() {
                    //     this.orderable(false);
                    // });
                    $('#expire_productstable').DataTable({'responsive': true});
                    }else{
                        //alert(response.message);
                    }
                    // Handle the response from the controller
                    // console.log(response);
                },
                error: function (error) {
                // console.error(error);
                }
            });
        });

        

        });
        </script>