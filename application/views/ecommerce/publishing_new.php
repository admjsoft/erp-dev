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
              <label for="employee">Vendor</label>
              <select class="form-control" id="vendor_type">
                <!-- <option value="">Select Vendor</option> -->
                <?php if(!empty($vendors)){ foreach ($vendors as $vendor) { ?>
                    <option value="<?php echo $vendor['Id']; ?>" vendor_name="<?php echo $vendor['VendorName']; ?>" <?php if($vendor['VendorName'] == 'POS'){ echo "selected"; } ?>><?php echo $vendor['VendorName']." (".$vendor['Type'].") "; ?></option>
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
                    <option value="<?php echo $category['id']; ?>" ><?php echo $category['title']; ?></option>
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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>View Products </div>
            <div class="header-block">
                <h3 class="title">
                    <?php //echo $this->lang->line('Support Tickets') ?>
                </h3></div>


            <p>&nbsp;</p>

            <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                
                <tr >
                    <th>#</th>
                    <th><?php echo "Product Name"; //$this->lang->line('Subject') ?></th>
                    <th><?php echo "Product Price"; //$this->lang->line('Added') ?></th>
                    <th id="table_header_vendor_product_name"></th>
                    <th id="table_header_vendor_name" ><?php // echo "Product Name"; //$this->lang->line('Status') ?></th>
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
        <select name="employee" class="form-control employee emp-list" >
            <option>-- <?php echo $this->lang->line('Select Employee') ?> --</option>
        </select>
        <br />
        <p>Job type</p>
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

                        <button type="button" data-dismiss="modal"
                                class="btn"><?php echo $this->lang->line('Close') ?></button>
                    </div>
                </div>
            </div>
        </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {

        var vendor = $('#vendor_type').val();
        var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
        $('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
        $('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');
        
    
        //alert(vendor_name);
        draw_data(vendor,vendor_name);

        function draw_data(vendor = '',vendor_name='',category='',sub_category='') {

            
            // alert(status);
            // alert(employee);
            // alert(start_date);
            // alert(end_date);

            $('#doctable').DataTable({
            "processing": true,
            "serverSide": true,
            responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php if (isset($_GET['filter'])) {
                    $filter = $_GET['filter'];
                } else {
                    $filter = '';
                }    
                echo site_url('ecommerce/get_products_list')?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                        vendor: vendor,
                        vendor_name: vendor_name,
                        category: category,
                        sub_category: sub_category
                    }
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
            ], 
            "columns": [
                 // Assuming the first column is at index 0
                { "data": 0 },
                { "data": 1 }, // Assuming the first column is at index 0
                { "data": 2 },
                { "data": 3 },
                { "data": 4 },
                { "data": 5 }
                
            ],
            dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        footer: true,
                        exportOptions: {
                            columns: [0,1,2,3,4,5]
                        }
                    }
                ],
            "order": [[2, "desc"]]

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

        $('#search').click(function () {
            var vendor = $('#vendor_type').val();
            var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
            var category = $('#category').val();
            var sub_category = $('#sub_category').val();

            //if (start_date != '' && end_date != '') {
                $('#doctable').DataTable().destroy();
                draw_data(vendor,vendor_name,category, sub_category);
                $('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
                $('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');
     
            // } else {
            //     alert("Date range is Required");
            // }
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



$(document).on('change', "#category", function (e) {
   
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
    success: function (data) {
        $('#sub_category').html('');
        $('#sub_category').html(data);
    },
    error: function(data) {
    //console.log(data);
        console.log("Error not get emp list")
    }


    });

});


$(document).on('change', "#vendor_type", function (e) {
   
   var vendor = $('#vendor_type').val();
   var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
   //$('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
   //$('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');

   $('#category').html('');
   $('#sub_category').html('');
   $.ajax({

   url: "<?php echo site_url('ecommerce/get_categories_list') ?>",
   type: 'POST',
   data: {
       vendor: vendor,
       vendor_name: vendor_name
   },
   success: function (data) {
       $('#category').html('');
       $('#category').html(data);
   },
   error: function(data) {
   //console.log(data);
       console.log("Error not get emp list")
   }

   });

   });

   $(document).on('click', ".view-object", function (e) {
        e.preventDefault();
        $('#view-object-id').val($(this).attr('data-object-id'));

        $('#view_model').modal({backdrop: 'static', keyboard: false});

        var actionurl = $('#view-action-url').val();
        $.ajax({
            url: baseurl + actionurl,
            data: 'id=' + $('#view-object-id').val() + '&' + crsf_token + '=' + crsf_hash,
            type: 'POST',
            dataType: 'html',
            success: function (data) {
                $('#view_object').html(data);

            }

        });

    });

    $(document).on('click', ".share_product_to_third_party", function (e) {
        e.preventDefault();
        product_id = $(this).attr('product_id');
        vendor_id = $(this).attr('vendor_id');
        vendor_pricing_id = $(this).attr('vendor_pricing_id');

        $.ajax({

        url: "<?php echo site_url('ecommerce/share_product_to_third_party') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            product_id: product_id,
            vendor_id: vendor_id,
            vendor_pricing_id: vendor_pricing_id
        },
        success: function (data) {
            alert(data.message);
        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
        }


    });

    
});


    
</script>
