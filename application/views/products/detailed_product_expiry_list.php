<article class="content-body">
<div class="row">
<div class="col-12">
<?php if(isset($_SESSION['status'])){
 echo '<div id="notify" class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
</div>
</div>
    
    <div class="card">
      <div class="card-body">
        <!-- <h5 class="card-title">Employee Details</h5> -->
        <div class="row justify-content-center">
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
          <div class="col-md-2">
            <div class="form-group">
              <label for="startDate"><?php echo $this->lang->line('Expiry Start Date'); ?></label>
              <input type="date" class="form-control" id="start_date">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="endDate"><?php echo $this->lang->line('Expiry End Date'); ?></label>
              <input type="date" class="form-control" id="end_date">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="submit">&nbsp;</label>
              <button class="btn btn-primary form-control" id="search"><?php echo $this->lang->line('Search'); ?></button>
            </div>
          </div>
        </div>
        
      </div>
    
    </div>
    <div class="card card-block">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"></div>
        </div>
        <div class="card-body">
            <div class="card-header">
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?><?php echo $this->lang->line('Detailed product Expiry List'); ?> </div>
            <div class="header-block">
                <h3 class="title">
                    <?php //echo $this->lang->line('Support Tickets') ?>
                </h3></div>


            <p>&nbsp;</p>
            <table class="table table-striped table-bordered zero-configuration"
                            cellspacing="0" width="100%" id="expire_productstable_sales">
                <thead >
                         <tr>
                            <th><?php echo $this->lang->line('Product Code'); ?></th>                            
                            <th><?php echo $this->lang->line('Product Category'); ?></th>
                            <th><?php echo $this->lang->line('Product Name'); ?></th>
                            <th><?php echo $this->lang->line('DO Date'); ?></th>
                            <th><?php echo $this->lang->line('Expiry Date'); ?></th>
                        </tr>
                </thead>
                <tbody id="expiry-products-modal-body-content-with-sales">
                <?php if(!empty($products)) { $ii=1; foreach($products as $product){ 
    if(((int)$product['delivered_qty'] - (int)$product['return_qty']) > (int)$product['total_used_qty']){ ?>
                    <tr >                    
                    <td><?php echo $product['product_code']; ?></td>
                    <td><?php echo $product['title']; ?></td>
                    <td><?php echo $product['product_name']; ?></td>
                    <td><?php echo date('d-m-Y',strtotime($product['do_created_date'])); ?></td>
                    <td><?php if(!empty($product['do_expire_date'])){ echo date('d-m-Y',strtotime($product['do_expire_date'])); }else{ echo "---"; }  ?></td>
                    </tr>
                    <?php } $ii++; }} ?>
                </tbody>
            </table>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="tickets/ticket_stats">
</article>
<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this job') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="jobsheets/delete_ticket">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
<?php echo form_open('jobsheets/assign');
 ?>
<div id="assign_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Assign') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('Employee') ?></p>
        <select name="employee" class="form-control employee emp-list" >
            <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
        </select>
        <br />
        <p><?php echo $this->lang->line('Job type'); ?></p>
        <input type="text" class="form-control" name="jobtype" value="" placeholder="Like:Task, Urgent, Imidate or etc." />
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" class="jobid" name="jobid" value="">
                <input type="submit" class="btn btn-primary" value="<?php  echo $this->lang->line('Assign') ?>" />
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>
<div class="modal fade" id="do_sale_invoices_modal">
            <div class="modal-dialog modal-xl">
                <!-- Add the modal-xl class -->
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header" style="background-color:#B68DB8; width=100%">
                        <h4 class="modal-title"><?php echo $this->lang->line('Detailed Stock Balance') ?></h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal Body -->
                    <div class="modal-body">
                        <!-- Table to display data -->
                        <table class="table table-striped table-bordered zero-configuration"
                            cellspacing="0" width="100%" id="do_sale_invoices">
                            <thead style="background-color:#B68DB8 !important;">
                                <tr>
                                    <th><?php echo $this->lang->line('Invoice ID'); ?></th>
                                    <th><?php echo $this->lang->line('Customer Name'); ?></th>
                                    <th><?php echo $this->lang->line('Invoice Date'); ?></th>
                                </tr>
                            </thead>
                            <tbody id="do_sale_invoices_content">
                                <!-- Data will be inserted here dynamically -->
                            </tbody>
                        </table>
                    </div>

                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
<script type="text/javascript">
    $(document).ready(function () {
        $('#expire_productstable_sales').DataTable({  'responsive': true});

        // $(document).on('click', '.get_delivery_order_sale_invoices', function() {
            
        //     var do_id = $(this).attr('do_id');
                
        //     $.ajax({
        //         type: 'POST',        
        //         dataType: 'json',
        //         url: '<?php echo base_url('products/get_do_sale_invoices_details') ?>',
        //         data: { do_id: do_id },
        //         success: function (response) {
    
        //             if(response.status == '200')
        //             {
        //               $('#do_sale_invoices').DataTable().destroy();
        //               $('#do_sale_invoices_content').html('');
        //               $('#do_sale_invoices_content').html(response.html);
        //               $('#do_sale_invoices_modal').modal('show');
        //               $('#do_sale_invoices').DataTable();
        //             }else{
        //                 //alert(response.message);
        //             }
        //             // Handle the response from the controller
        //             // console.log(response);
        //         },
        //         error: function (error) {
        //         // console.error(error);
        //         }
        //     });
        // });

        $('#search').click(function() {

        var cat_id = $('#do_type').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var product_code = $('#product_code').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '<?php echo base_url('products/get_detailed_product_expiry_list') ?>',
            data: {
                cat_id: cat_id,
                start_date: start_date,
                end_date: end_date,
                product_code: product_code
            },
            success: function(response) {

                if (response.status == '200') {
                    $('#expire_productstable_sales').DataTable().destroy();
                    $('#expiry-products-modal-body-content-with-sales').html('');
                    $('#expiry-products-modal-body-content-with-sales').html(response.html);
                    $('#expire_productstable_sales').DataTable({
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


    });

    
</script>
