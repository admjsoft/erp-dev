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
           <!-- <div class="col-md-2">
            <div class="form-group">
              <label for="submit">&nbsp;</label>
              <button class="btn btn-primary form-control" id="search">Search</button>
            </div>
          </div> -->
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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>View Categories </div>
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
                    <th><?php echo "Category Name"; //$this->lang->line('Subject') ?></th>
                    <th><?php echo $this->lang->line('Action') ?></th>
                </tr>
                </thead>
                <tbody id="category_table_body">
                    <?php if(!empty($categories)) { $c_no=1; foreach($categories as $category){ ?>
                        <tr>
                        <td><?php echo $c_no; ?></td>
                        <td><?php echo $category['title']; ?></td>
                        <td><a href="<?php echo base_url('productcategory/edit/?' . http_build_query(array('id' => $category['id'])));  ?>" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                        <a  data-object-id="<?php echo $category['id']; ?>" category_id="<?php echo $category['id']; ?>" style="display: inline-block; padding:6px; margin-left:1px;" class="btn btn-danger btn-xs delete-object"><i class="fa fa-trash"></i></a></td>
                        </tr>
                    <?php $c_no++; } } ?>
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
                <input type="hidden" id="action-url-old" value="jobsheets/delete_ticket">
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

<div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('delete this product category') ?></strong></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="productcategory/delete_i">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
    $(document).ready(function () {

        $('#doctable').DataTable();

       
    });




$(document).on('change', "#vendor_type", function (e) {
   
   var vendor = $('#vendor_type').val();
   var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
   //$('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
   //$('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');

   $('#category').html('');
   $('#sub_category').html('');
   $.ajax({

   url: "<?php echo site_url('ecommerce/get_categories_table_list') ?>",
   type: 'POST',
   data: {
       vendor: vendor,
       vendor_name: vendor_name
   },
   success: function (data) {
       $('#category_table_body').html('');
       $('#category_table_body').html(data);
       //$('#doctable').DataTable().destroy();
       $('#doctable').DataTable();
   },
   error: function(data) {
   //console.log(data);
       console.log("Error not get emp list")
   }

   });

   });

   

   
    
    $(document).on('click', ".delete_category", function (e) {
        e.preventDefault();
        category_id = $(this).attr('category_id');
        vendor_id = $(this).attr('vendor_id');        
        
        $.ajax({

        url: "<?php echo site_url('ecommerce/delete_category') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            category_id: category_id,
            vendor_id: vendor_id
        },
        success: function (data) {
            alert(data.message);
            $('#tv_cat_id_'+category_id).remove();
            var vendor = $('#vendor_type').val();
            var vendor_name = $("#vendor_type option:selected").attr('vendor_name');
            //$('#table_header_vendor_name').html($("#vendor_type option:selected").text()+' Price');
            //$('#table_header_vendor_product_name').html($("#vendor_type option:selected").text()+' Name');

            $('#category').html('');
            $('#sub_category').html('');
            $.ajax({

            url: "<?php echo site_url('ecommerce/get_categories_table_list') ?>",
            type: 'POST',
            data: {
                vendor: vendor,
                vendor_name: vendor_name
            },
            success: function (data) {
                $('#category_table_body').html('');
                $('#category_table_body').html(data);
            },
            error: function(data) {
            //console.log(data);
                console.log("Error not get emp list")
            }

            });

        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
        }


    });

    });


    
</script>
