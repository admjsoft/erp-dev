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
                        <label for="employee">Current Platform</label>
                        <select class="form-control" id="vendor_type">
                            <!-- <option value="">Select Vendor</option> -->
                            <?php if(!empty($vendors)){ foreach ($vendors as $vendor) { ?>
                            <option value="<?php echo $vendor['Id']; ?>"
                                vendor_name="<?php echo $vendor['VendorName']; ?>"
                                vendor_type="<?php echo $vendor['Type']; ?>"
                                <?php if($vendor['VendorName'] == 'POS'){ echo "selected"; } ?>>
                                <?php echo $vendor['VendorName']." (".$vendor['Type'].") "; ?></option>
                            <?php } } ?>


                        </select>
                    </div>
                </div>
                
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Categories</label>
                        <select class="form-control" id="category">
                            <option value="">Select Category</option>
                            <?php if(!empty($categories)){ foreach ($categories as $category) { ?>
                            <option value="<?php echo $category['id']; ?>"><?php echo $category['title']; ?></option>
                            <?php } } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="status">Sub Categories</label>
                        <select class="form-control" id="sub_category">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2" id="target_vendor_type_block">
                    <div class="form-group">
                        <label for="employee">Target Platform</label>
                        <select class="form-control" id="target_vendor_type">
                            <!-- <option value="">Select Vendor</option> -->
                            <?php if(!empty($vendors)){ foreach ($vendors as $vendor1) { if($vendor1['VendorName'] != 'POS'){ ?>
                            <option value="<?php echo $vendor1['Id']; ?>"
                                vendor_name="<?php echo $vendor1['VendorName']; ?>" vendor_type="<?php echo $vendor1['Type']; ?>">
                                <?php echo $vendor1['VendorName']." (".$vendor1['Type'].") "; ?></option>
                            <?php } } } ?>


                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="submit">&nbsp;</label>
                        <button class="btn btn-primary form-control" id="search">Search</button>
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
                <h4 class="card-title">
                <span id="form_level_card_header"><?php echo "Publish Your Products to "; //$this->lang->line('Clients') ?></span><span id="form_level_header"></span></h4>
                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a href="#" class="btn btn-info btn-sm rounded multi_assign_button" style="display:none;">
                                <span class="fa fa-envelope"></span>
                                <?php echo "Pubish Selected Products"; ?></a></li>

                    </ul>
                </div>
            </div>


            <p>&nbsp;</p>

            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                width="100%">
                <thead>

                    <tr>
                        <th></th>
                        <th>#</th>
                        <th><?php echo "Product Name"; ?></th>
                        <th><?php echo "Product Price";  ?></th>
                        <th id="tp_price"><?php echo "Online Price";  ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr>
                </thead>
                <tbody>

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
                <select name="employee" class="form-control employee emp-list">
                    <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
                </select>
                <br />
                <p>Job type</p>
                <input type="text" class="form-control" name="jobtype" value=""
                    placeholder="Like:Task, Urgent, Imidate or etc." />
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
<div id="view_model" class="modal  fade">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('View') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="view_object">
                <p></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="view-object-id" value="">
                <input type="hidden" id="view-action-url" value="products/view_over">

                <button type="button" data-dismiss="modal" class="btn"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>
</div>


<div id="bulk_publish_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo "Publish" ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="status">Categories</label>
                        <select class="form-control" id="target_category">
                            <option value="">Select Category</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="status">Sub Categories</label>
                        <select class="form-control" id="target_sub_category">
                            <option value="">Select Sub Category</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                
                <input type="button" class="btn btn-primary" id="bulk_publish_btn" value="<?php echo "Publish"; ?>" />
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

</form>
<input type="hidden" id="selected_product_ids" value="" />
<script type="text/javascript">
$(document).ready(function() {


    var selectedProducts = []; 

    $('body').on("change", "input[type=checkbox][name=pos_product_ids]", function() {
        //event.preventDefault();
        // alert('sss');
        // var fetchId = $(this).attr("fetchId");
        // var vendor_pr_id = $(this).attr("vendor_pr_id");
        
        // if (!products_ids.includes(fetchId)) {
        //     products_ids.push(fetchId);

        // } else {
        //     var index = products_ids.indexOf(fetchId);
        //     if (index >= 0) {
        //         products_ids.splice(index, 1);
        //     }
        // }
        var fetchId = $(this).attr("fetchId");
        var vendor_pr_id = $(this).attr("vendor_pr_id");

        var selectedItem = { fetchId: fetchId, vendor_pr_id: vendor_pr_id };

        // Check if the item is already in the array
        var index = selectedProducts.findIndex(item => item.fetchId === fetchId && item.vendor_pr_id === vendor_pr_id);

        if (index === -1) {
            selectedProducts.push(selectedItem);
        } else {
            selectedProducts.splice(index, 1);
        }

        //console.log(selectedProducts);
        //alert(messaging_team_ids);
        if (selectedProducts.length > 0) {
            $('.multi_assign_button').show();
        } else {
            $('.multi_assign_button').hide();
        }

        var selectedProductsJson = JSON.stringify(selectedProducts);

        $('#selected_product_ids').val(selectedProductsJson);

        //  return;
    });



    var vendor = $('#vendor_type').val();
    var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
    $('#table_header_vendor_name').html($("#vendor_type option:selected").text() + ' Price');
    $('#table_header_vendor_product_name').html($("#vendor_type option:selected").text() + ' Name');
    var target_vendor = $('#target_vendor_type').val();
    $('#form_level_header').html($("#target_vendor_type option:selected").attr('vendor_name')+" "+$("#target_vendor_type option:selected").attr('vendor_type'))

    //alert(vendor_name);
    draw_data(vendor, vendor_name, category = '', sub_category = '', target_vendor);

    function draw_data(vendor = '', vendor_name = '', category = '', sub_category = '', target_vendor = '') {


        // alert(status);
        // alert(employee);
        // alert(start_date);
        // alert(end_date);
        if ($.fn.DataTable.isDataTable('#doctable')) {
                $('#doctable').DataTable().destroy();
                }
        $('#doctable').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: false,
            <?php datatable_lang();?> "ajax": {
                "url": "<?php if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                } else {
                    $filter = '';
                }    
                echo site_url('ecommerce/get_products_list')?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    vendor: vendor,
                    vendor_name: vendor_name,
                    category: category,
                    sub_category: sub_category,
                    target_vendor: target_vendor
                }
            },
            "columnDefs": [{
                "targets": [0],
                "orderable": false,
            }, ],
            "columns": [
                // Assuming the first column is at index 0
                {
                    "data": 0
                },
                {
                    "data": 1
                }, // Assuming the first column is at index 0
                {
                    "data": 2
                },
                {
                    "data": 3
                },
                {
                    "data": 4
                },
                {
                    "data": 5
                }

            ],
            dom: 'Blfrtip',
            buttons: [{
                extend: 'excelHtml5',
                footer: true,
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5]
                }
            }],
            "order": [
                [2, "desc"]
            ]

        });
    };

    // $('#task_status').click(function () {
    //     var status = $('#task_status').val();

    //     if (status != '') {
    //         $('#doctable').DataTable().destroy();
    //     // alert(status);
    //         draw_data(status);
    //     } else {
    //         //alert("Date range is Required");
    //     }
    // });

    // $('#task_employee').change(function () {
    //     var employee = $('#task_employee').val();

    //     if (employee != '') {
    //         $('#doctable').DataTable().destroy();
    //     // alert(status);
    //         draw_data(status,employee);
    //     } else {
    //         //alert("Date range is Required");
    //     }
    // });

    $('#search').click(function() {
        var vendor = $('#vendor_type').val();
        var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
        var category = $('#category').val();
        var sub_category = $('#sub_category').val();
        //var target_vendor_type = $('#target_vendor_type').val();
        
        var target_vendor_type = document.getElementById('target_vendor_type');
        var target_vendor_type_value = null;

        if (target_vendor_type) {
            target_vendor_type_value = target_vendor_type.value;
        } else {
            // Handle the case when the element is not available
            target_vendor_type_value = '';
        }

        if(vendor_name == 'POS')
        {
            $('#tp_price').html('Online Price');
        }else{
            $('#tp_price').html('Sale Price');
        }

        if (vendor != '' && category != '') {

            //if (start_date != '' && end_date != '') {
            //$('#doctable').DataTable().destroy();
            draw_data(vendor, vendor_name, category, sub_category, target_vendor_type_value);
            // $('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
            // $('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');

            // } else {
            //     alert("Date range is Required");
            // }
        } else {
            alert('Please Select Category');
        }

    });

    // miniDash();


    // $.ajax({

    // url: "<?php // echo site_url('employee/employee_list') ?>",
    // type: 'POST',
    // success: function (data) {
    //     $('.emp-list').append(data);
    // },
    // error: function(data) {
    // //console.log(data);
    //     console.log("Error not get emp list")
    // }

    // });
});



$(document).on('change', "#category", function(e) {

    var vendor = $('#vendor_type').val();
    var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
    var category = $('#category').val();

    $.ajax({

        url: "<?php echo site_url('ecommerce/get_sub_categories_list') ?>",
        type: 'POST',
        data: {
            vendor: vendor,
            vendor_name: vendor_name,
            category: category
        },
        success: function(data) {
            $('#sub_category').html('');
            $('#sub_category').html(data);
        },
        error: function(data) {
            //console.log(data);
            console.log("Error not get emp list")
        }


    });

});

$(document).on('change', "#target_category", function(e) {

var vendor = $('#target_vendor_type').val();
var vendor_name = $("#target_vendor_type option:selected").attr('vendor_name');
var category = $('#target_category').val();

$.ajax({

    url: "<?php echo site_url('ecommerce/get_sub_categories_list') ?>",
    type: 'POST',
    data: {
        vendor: vendor,
        vendor_name: vendor_name,
        category: category
    },
    success: function(data) {
        $('#target_sub_category').html('');
        $('#target_sub_category').html(data);
    },
    error: function(data) {
        //console.log(data);
        console.log("Error not get emp list")
    }


});

});

$(document).on('change', "#vendor_type", function(e) {

    var vendor = $('#vendor_type').val();
    var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
    //$('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
    //$('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');
    form_level_header

    if (vendor_name != 'POS') {
        $('#target_vendor_type_block').hide();
        $('#form_level_card_header').html("All Products from "+ $("#vendor_type option:selected").attr('vendor_name')+" "+$("#vendor_type option:selected").attr('vendor_type'));
        $('#form_level_header').hide();
       
        
    } else {
        $('#target_vendor_type_block').show();
        $('#form_level_card_header').html("Publish Your Products to ");
        $('#form_level_header').html($("#target_vendor_type option:selected").attr('vendor_name')+" "+$("#target_vendor_type option:selected").attr('vendor_type'));
        $('#form_level_header').show();

    }

    $('#category').html('');
    $('#sub_category').html('');
    $.ajax({

        url: "<?php echo site_url('ecommerce/get_categories_list') ?>",
        type: 'POST',
        data: {
            vendor: vendor,
            vendor_name: vendor_name
        },
        success: function(data) {
            $('#category').html('');
            $('#category').html(data);
        },
        error: function(data) {
            //console.log(data);
            console.log("Error not get emp list")
        }

    });

});

$(document).on('click', ".view-object", function(e) {
    e.preventDefault();
    $('#view-object-id').val($(this).attr('data-object-id'));

    $('#view_model').modal({
        backdrop: 'static',
        keyboard: false
    });

    var actionurl = $('#view-action-url').val();
    $.ajax({
        url: baseurl + actionurl,
        data: 'id=' + $('#view-object-id').val() + '&' + crsf_token + '=' + crsf_hash,
        type: 'POST',
        dataType: 'html',
        success: function(data) {
            $('#view_object').html(data);

        }

    });

});

$(document).on('click', ".share_product_to_third_party", function(e) {
    e.preventDefault();
    product_id = $(this).attr('product_id');
    vendor_id = $(this).attr('vendor_id');
    vendor_pricing_id = $(this).attr('vendor_pricing_id');
    category = $('#category').val();
    sub_category = $('#sub_category').val();


    $.ajax({

        url: "<?php echo site_url('ecommerce/share_product_to_third_party') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            product_id: product_id,
            vendor_id: vendor_id,
            vendor_pricing_id: vendor_pricing_id,
            category: category,
            sub_category: sub_category
        },
        success: function(data) {

            if(data.status == '200')
            {
                alert(data.message);
                $('#search').click();

            }else{
                alert(data.message);
            }
        },
        error: function(data) {
            //console.log(data);
            alert(data.message);
        }


    });
});

$('.multi_assign_button').click(function() {
    var product_ids = $('#selected_product_ids').val();

    if (product_ids.length >= 1) {

   

    var vendor = $('#target_vendor_type').val();
    var vendor_name = $("#target_vendor_type option:selected").attr('vendor_name');
    //$('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
    //$('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');
    $.ajax({

        url: "<?php echo site_url('ecommerce/get_categories_list') ?>",
        type: 'POST',
        data: {
            vendor: vendor,
            vendor_name: vendor_name
        },
        success: function(data) {

            $('#bulk_publish_model').modal('show');
            $('#target_category').html('');
            $('#target_category').html(data);
        },
        error: function(data) {
            //console.log(data);
            console.log("Error not get emp list")
        }

    });
}
    

$('#bulk_publish_btn').click(function() {
    var product_ids = $('#selected_product_ids').val();
    if (product_ids) {

    var button = document.getElementById('bulk_publish_btn');
    button.disabled = true;
    
    vendor_id = $('#target_vendor_type').val();
    category = $('#target_category').val();
    sub_category = $('#target_sub_category').val();
    if(category != '' && sub_category != '')
    {
    //alert(product_ids);
    $.ajax({

        url: "<?php echo site_url('ecommerce/share_bulk_products_to_third_party') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            product_ids: product_ids,
            vendor_id: vendor_id,
            category: category,
            sub_category: sub_category
        },
        success: function(data) {
            if(data.status == '200')
            {
                alert(data.message);
                //$('#search').click();
                location.reload();

            }else{
                alert(data.message);
                button.disabled = false;
            }
                    },
        error: function(data) {
            //console.log(data);
            alert(data.message);
            button.disabled = false;
        }


    });
}else{
    alert('Please Select Category & Sub Category');
        button.disabled = false;
}

}
});

$(document).on('change', "#target_vendor_type", function(e) {
$('#form_level_header').html($("#target_vendor_type option:selected").attr('vendor_name')+" "+$("#target_vendor_type option:selected").attr('vendor_type'))
});

});


</script>