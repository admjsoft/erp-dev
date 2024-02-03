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
                        <label for="employee"><?php echo $this->lang->line('Purchase Order')." / ".$this->lang->line('DO No'); ?></label>
                        <input type="text" id="search_invoice_id" list="datalistOptions" name="autocomplete"
                            class="form-control">
                        <datalist id="datalistOptions">
                            <!-- Replace these options with your actual autocomplete options -->
                            <?php if(!empty($invoice_ids)) { foreach( $invoice_ids as $inv_id){ ?>
                            <option value="<?php echo $inv_id['tid']; ?>">
                                <?php }} ?>
                                <!-- Add more options as needed -->
                        </datalist>
                    </div>
                </div>

                <?php /* ?>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="employee">Type</label>
                        <select class="form-control" id="do_type">
                            <option value="all" selected>All</option>
                            <!--<option value="po">Purchase Order DO</option> -->
                            <option value="invoice">Invoice DO</option>
                            <option value="do">Only Delivery Order</option>
                        </select>
                    </div>
                </div>
                <?php */ ?>


                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status"><?php echo $this->lang->line('Status'); ?></label>
                        <select class="form-control" id="do_status">
                            <option value=""><?php echo $this->lang->line('Select Status'); ?></option>
                            <option value="due"><?php echo $this->lang->line('Due'); ?></option>
                            <option value="partial"><?php echo $this->lang->line('Partial'); ?></option>
                            <option value="completed"><?php echo $this->lang->line('Completed'); ?></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="startDate"><?php echo $this->lang->line('Start Date'); ?></label>
                        <input type="date" class="form-control" id="do_start_date">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="endDate"><?php echo $this->lang->line('End Date'); ?></label>
                        <input type="date" class="form-control" id="do_end_date">
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
            <div class="row">
                <div class="col-8">
                    <h4 class="card-title"><?php echo $this->lang->line('Delivery Orders From Suppliers') ?></h4>
                </div>
                <div class="col-4 text-right">
                    <!-- Small Button -->
                    <a href="<?php echo base_url('purchase/create'); ?>"> <button type="button" class="btn btn-sm btn-primary"><?php echo $this->lang->line('Create Purchase Order'); ?></button></a>
                </div>
            </div>
            </div>
            <div class="header-block">
                <h3 class="title">
                    <?php //echo $this->lang->line('Support Tickets') ?>
                </h3>
            </div>


            <p>&nbsp;</p>

            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Delivery Order ID') ?></th>
                        
                        <th><?php echo $this->lang->line('Purchase Order No') ?></th>
                        <th><?php echo $this->lang->line('Total Items') ?></th>
                        <th><?php echo $this->lang->line('Delivered Items') ?></th>
                        <th><?php echo $this->lang->line('Balance Items') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>

                        <th><?php echo $this->lang->line('Total DO') ?></th>
                        <th><?php echo $this->lang->line('Created Date') ?></th>
                        <th><?php echo $this->lang->line('Options') ?></th>
                    </tr>
                </thead>
                <tbody id="do_orders_list">
                    <?php if(!empty($do_orders)) { $ii=1; foreach($do_orders as $do_order){ ?>
                    <tr>
                        <td><?php echo $ii; ?></td>
                                                <td><a href="#" class="do_details_display" do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"> <?php echo $do_order['do_id']; ?></a></td>
                                <td><a target="_blank" href="<?php echo base_url('purchase/view?id='.$do_order['po_id']); ?>"
                                class=""><?php echo $do_order['display_invoice_id']; ?></a></td>

                                <td><?php echo $do_order['items']; ?></td>
                        <td
                            style="background-color:<?php if($do_order['status'] == 'partial' || $do_order['status'] == 'due'){ echo "#E68C70"; }else{echo "#39DAA9";}  ?>">
                            <?php echo ($do_order['total_qty'] - $do_order['return_qty']); ?></td>
                        <td><?php echo $do_order['balance_qty']; ?></td>
                        <td style="background-color:<?php if($do_order['status'] == 'partial' || $do_order['status'] == 'due'){ echo "#E68C70"; }else{echo "#39DAA9";}  ?>"><?php echo $do_order['status']; ?></td>
                        <td><?php echo $do_order['do_count']; ?></td>
                        <td><?php echo date('d-m-Y',strtotime($do_order['cr_date'])); ?></td>
                        <td>
                            <?php if($do_order['do_type'] == 'po'){ ?>
                            <a href="<?php echo base_url('deliveryorder/create_purchase_delivery_order?id='.$do_order['po_id']); ?>"
                                class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"><i class="fa fa-edit"></i>
                                <?php echo $this->lang->line('edit') ?></a> &nbsp;
                            <?php }else if($do_order['do_type'] == 'invoice'){ ?>
                            <a href="<?php echo base_url('deliveryorder/create_invoice_delivery_order?id='.$do_order['invoice_id']); ?>"
                                class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"><i class="fa fa-edit"></i>
                                <?php echo $this->lang->line('edit') ?></a> &nbsp;
                            <?php  }else if($do_order['do_type'] == 'do'){ ?>
                            <a href="<?php echo base_url('deliveryorder/create_purchase_delivery_order?id='.$do_order['po_id']); ?>"
                                class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"><i class="fa fa-edit"></i>
                                <?php echo $this->lang->line('edit') ?></a> &nbsp;
                            <?php } ?>
                            &nbsp;
                            <a href="#" class="btn btn-warning btn-sm do_retrun_modal"
                                do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"><i class="fa fa-reply"></i>
                                <?php echo $this->lang->line('return') ?></a> &nbsp;
                            <?php if($do_order['status'] != 'completed'){ ?>
                               
                            <a href="#" class="btn btn-danger btn-sm do_cancel_modal"
                                do_type="<?php echo $do_order['do_type']; ?>"
                                do_id="<?php echo $do_order['do_id']; ?>"><i class="fa fa-trash"></i>
                                <?php echo $this->lang->line('cancel') ?></a>
                            <?php } ?> 
                            
                        </td>
                    </tr>
                    <?php $ii++; }} ?>
                </tbody>

            </table>
        </div>
    </div>
    <input type="hidden" id="dashurl" value="tickets/ticket_stats">
</article>



<!-- Extra Large Modal -->
<div class="modal fade" id="extraLargeModal" tabindex="-1" role="dialog" aria-labelledby="extraLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="extraLargeModalLabel"><?php echo $this->lang->line('Delivery Order Detailed View'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="do_order_deatils">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="do_return_details_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo $this->lang->line('Do Details'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" id="do_return_details_content">
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                <button type="button" class="btn btn-primary" id="update_return_items"><?php echo $this->lang->line('Save Changes'); ?></button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#doctable').DataTable({
        'responsive': true
    });
});


$('.do_details_display').click(function() {

    var p_do_id = $(this).val();
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_delivery_orders_details') ?>',
        data: {
            do_type: do_type
        },
        success: function(response) {

            if (response.status == '200') {
                // $('#doctable').DataTable().destroy();
                // $('#do_orders_list').html('');
                // $('#do_orders_list').html(response.html);
                // $('#doctable').DataTable();
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


$('#search').click(function() {

    var do_type = $('#do_type').val();
    var do_status = $('#do_status').val();
    var do_start_date = $('#do_start_date').val();
    var do_end_date = $('#do_end_date').val();
    var search_invoice_id = $('#search_invoice_id').val();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_delivery_orders_recieved_list') ?>',
        data: {
            do_type: do_type,
            do_status: do_status,
            do_start_date: do_start_date,
            do_end_date: do_end_date,
            search_invoice_id: search_invoice_id
        },
        success: function(response) {

            if (response.status == '200') {
                $('#doctable').DataTable().destroy();
                $('#do_orders_list').html('');
                $('#do_orders_list').html(response.html);
                $('#doctable').DataTable({
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



$(document).on('click', '.do_details_display', function() {
    //alert($(this).attr('do_id'));
    var do_id = $(this).attr('do_id');
    var do_type = $(this).attr('do_type');
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_delivery_orders_details') ?>',
        data: {
            do_id: do_id,
            do_type: do_type,
            do_option: ''
        },
        success: function(response) {

            if (response.status == '200') {
                // $('#doctable').DataTable().destroy();
                $('#do_order_deatils').html('');
                $('#do_order_deatils').html(response.html);
                $('#extraLargeModal').modal('show');
                // $('#doctable').DataTable();
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



$(document).on('click', '.do_retrun_modal', function() {
    //alert($(this).attr('do_id'));
    var do_id = $(this).attr('do_id');
    var do_type = $(this).attr('do_type');
    //var do_option = $(this).attr('do_type');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_delivery_orders_details') ?>',
        data: {
            do_id: do_id,
            do_type: do_type,
            do_option: 'return'
        },
        success: function(response) {

            if (response.status == '200') {
                // $('#doctable').DataTable().destroy();
                $('#do_order_deatils').html('');
                $('#do_order_deatils').html(response.html);
                $('#extraLargeModal').modal('show');
                // $('#doctable').DataTable();
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


$(document).on('click', '.do_cancel_modal', function() {
    //alert($(this).attr('do_id'));
    var do_id = $(this).attr('do_id');
    var do_type = $(this).attr('do_type');
    //var do_option = $(this).attr('do_type');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_delivery_orders_details') ?>',
        data: {
            do_id: do_id,
            do_type: do_type,
            do_option: 'cancel'
        },
        success: function(response) {

            if (response.status == '200') {
                // $('#doctable').DataTable().destroy();
                $('#do_order_deatils').html('');
                $('#do_order_deatils').html(response.html);
                $('#extraLargeModal').modal('show');
                // $('#doctable').DataTable();
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


$(document).on('click', '.get_do_return_details', function() {
    //alert($(this).attr('do_id'));
    var do_id = $(this).attr('do_id');
    var do_type = $(this).attr('do_type');
    var p_do_id = $(this).attr('p_do_id');

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '<?php echo base_url('deliveryorder/get_single_do_details') ?>',
        data: {
            do_id: do_id,
            do_type: do_type,
            p_do_id: p_do_id
        },
        success: function(response) {

            if (response.status == '200') {
                // $('#doctable').DataTable().destroy();
                $('#do_return_details_content').html('');
                $('#do_return_details_content').html(response.html);
                $('#do_return_details_modal').modal('show');
                // $('#doctable').DataTable();
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


$(document).ready(function() {
    // Event handler when a button or action triggers the data retrieval
    $('#update_return_items').click(function() {
        // Array to store data for each row
        var rowData = [];

        // Iterate through each row in the table
        $('#do_return_items_table tr:gt(0)').each(function() {
            // Extract data from the current row
            var row = {};

            row.qty = $(this).find('input[type="number"]').val();
            row.desc = $(this).find('input[type="text"]').val();
            row.p_id = $(this).find('input[type="number"]').attr('p_id');
            row.do_id = $(this).find('input[type="number"]').attr('do_id');
            row.parent_do_id = $(this).find('input[type="number"]').attr('parent_do_id');
            row.id = $(this).find('input[type="number"]').attr('row_id');
            // Add the row data to the array             

            if (row.qty !== "" && row.desc !== "") {
                // Add the values to the row object

                rowData.push(row);
            } else {
                // Display an alert if values are not valid
                //alert("Please fill in both quantity and description for each row.");
                Swal.fire({
                    icon: "error",
                    title: "Please fill in both quantity and description for each row.",
                    showConfirmButton: false,
                    timer: 1500
                });
                return;
                // You might want to consider stopping the iteration or handle the error appropriately
            }

        });


        if (rowData.length !== 0) {
            // Send the data to the controller via AJAX
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url('deliveryorder/update_do_return_items_details') ?>',
                data: {
                    rowData: JSON.stringify(rowData)
                },
                success: function(response) {
                    // Handle the response from the controller
                    if (response.status == '200') {
                        // $('#doctable').DataTable().destroy();
                        //alert(response.message);
                        Swal.fire({
                            icon: "success",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                        });
                        // $('#doctable').DataTable();
                    } else {
                        //alert(response.message);
                    }
                    location.reload();
                },
                error: function(error) {
                    console.error(error);
                }
            });
        }
    });
});

$(document).on('click', '.get_do_cancel_details', function() {


    do_id = $(this).attr('do_id');
    p_do_id = $(this).attr('p_do_id');

    Swal.fire({
                icon: "error",
                title: "Cancellation Not Allowed Once Items are Delivered.",
                showConfirmButton: false,
                timer: 1500
            });


    // Ask the user for cancellation description
    // var cancelDescription = prompt("Please enter cancellation description:");

    // Check if the user provided a description
    // if (cancelDescription !== null) {
    // Array to store data for each row

    //const { value: text } = await 
    // Swal.fire({
    //     input: "textarea",
    //     inputLabel: "Message",
    //     inputPlaceholder: "Please Enter Cancellation Description...",
    //     inputAttributes: {
    //         "aria-label": "Please Enter Cancellation Description"
    //     },
    //     showCancelButton: true
    // });
    // if (text) {

    //     var cancelDescription = text;

    //     // Send the data to the controller via AJAX
    //     $.ajax({
    //         type: 'POST',
    //         dataType: 'json',
    //         url: '<?php echo base_url('deliveryorder/update_do_cancel_details') ?>',
    //         data: {
    //             cancelDescription: cancelDescription,
    //             do_id: do_id,
    //             p_do_id: p_do_id

    //         },
    //         success: function(response) {
    //             // Handle the response from the controller
    //             if (response.status == '200') {
    //                 //alert(response.message);
    //                 Swal.fire({
    //                     icon: "error",
    //                     title: response.message,
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 });
    //             } else {
    //                 //alert(response.message);
    //                 Swal.fire({
    //                     icon: "error",
    //                     title: response.message,
    //                     showConfirmButton: false,
    //                     timer: 1500
    //                 });
    //             }
    //             location.reload();
    //         },
    //         error: function(error) {
    //             console.error(error);
    //         }
    //     });

    // } else {
    //     // User canceled the prompt
    //     //alert("Cancellation description not provided.");
    //     Swal.fire({
    //         icon: "error",
    //         title: "Cancellation description not provided",
    //         showConfirmButton: false,
    //         timer: 1500
    //     });
    // }
});
</script>