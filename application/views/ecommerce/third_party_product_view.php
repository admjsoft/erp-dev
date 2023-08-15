<div class="content-body">
<div id="c_body"></div>
<style>
.sla-option {
    list-style-type: none;
    padding: 0;
    display: flex;
    flex-wrap: wrap;
}

.sla-option label{
    margin-right: 30px;
}
</style>

<?php

$task =$this->session->flashdata('task');
//var_dump($task);

if(isset($_SESSION['status'])){
    echo '<div id="notify" class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
    unset($_SESSION['status']);unset($_SESSION['message']);
    } ?>

    <div class="card">
        <div class="card-header">
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>View Product Details 
            </h4>
            

                <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
                <div class="heading-elements">
                    <ul class="list-inline mb-0">
                        <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                </div>
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url();?>/jobsheets/edit_task">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                    
                                    <div class="form-group row"><label
                                            class="col-sm-2 col-form-label"><?php echo "Product Image"; ?></label>
                                        <div class="col-sm-6">
                                            <!-- <div id="progress" class="progress">
                                                <div class="progress-bar progress-bar-success"></div>
                                            </div> -->
                                            <!-- The container for the uploaded files -->
                                            <table id="files" class="files">
                                            <tr><td><img style="max-height:150px; max-width:150px;" src="<?php echo $product_details['images'][0]['src']; ?>">
                                            </td></tr>
                                            </table>
                                            <?php /* ?><br>
                                            <span class="btn btn-success fileinput-button" style="width:100%">
                                                <i class="glyphicon glyphicon-plus"></i>
                                                <span>Select files...</span>
                                                <!-- The file input field used as target for the file upload widget -->
                                                <input id="fileupload" type="file" name="files[]">
                                            </span>
                                            <br>
                                            <pre>Allowed: gif, jpeg, png (Use light small weight images for fast loading - 200x200)</pre>
                                            <br><?php */ ?>
                                            <!-- The global progress bar -->

                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Product Name"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="title"
                                                   id="name" value="<?php  echo $product_details['name']; ?>">
                                            
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Categories"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                        <select class="form-control" id="category">
                                            <option value="">Select Category</option>
                                            <?php // if(!empty($categories)){ foreach ($categories as $category) { ?>
                                                <option value="<?php echo $category['id']; ?>" ><?php echo $category['name']; ?></option>
                                            <?php // } }  ?>
                                        </select>  
                                        </div>
                                    </div>


                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Sub Categories"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                        <select class="form-control" id="sub_category">
                                            <option value="">Select Sub Category</option>
                                        </select>
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                    <label class="col-sm-2 col-form-label"
                                        for="name"><?php echo "Product Regular Price"; // $this->lang->line('Title') ?></label>

                                    <div class="col-sm-8">
                                        <input type="text" placeholder="Title"
                                            class="form-control margin-bottom b_input required " name="title"
                                            id="regular_price" value="<?php  echo $product_details['regular_price']; ?>">
                                        
                                    </div>
                                    </div>


                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Product Sale Price"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="title"
                                                   id="sale_price" value="<?php  echo $product_details['sale_price']; ?>">
                                             
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Product Quantity"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="quantity"
                                                   id="quantity" min="1" value="<?php echo (int)$product_details['stock_quantity']; ?>">
                                             
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Product Description"; // $this->lang->line('Description') ?></label>

                                        <div class="col-sm-8">
                                            <!-- <input type="text" placeholder="Description"
                                                   class="form-control margin-bottom b_input" name="description"> -->
                                            <textarea  placeholder="Description"
                                                   class="form-control margin-bottom b_input" id="description" name="description"><?php  echo $product_details['description']; ?></textarea>        
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="jobsheets/edit_task" id="action-url">
                                    <input type="hidden" name="product_id" value="<?php  echo $product_details['id']; ?>" id="product_id">
                                    <input type="hidden" name="vendor_id" value="<?php  echo $vendor_id; ?>" id="vendor_id">
                                    <input type="hidden" name="vendor_pricing_id" value="<?php echo $vendor_pricing_id; ?>" id="vendor_pricing_id">
                                    <input type="hidden" name="vendor_type" value="<?php  echo $vendor_id; ?>" id="vendor_type">
                                    <input type="hidden" name="vendor_name" value="<?php  echo $vendor_details[0]['VendorName']; ?>" id="vendor_name">
                                    <input type="hidden" name="image_url" value="<?php // echo base_url('userfiles/product/').$product_details['image']; ?>" id="image_url">
                                    <!-- <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php //echo $this->lang->line('Add customer') ?>Publish Product"
                                           data-loading-text="updating..."> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function () {


    $(document).on('click', "#update_product_btn", function (e) {
        e.preventDefault();
       var product_id = $('#product_id').val();
       var vendor_id = $('#vendor_id').val();
       var name = $('#name').val();
       var regular_price = $('#regular_price').val();
       var sale_price = $('#sale_price').val();
       var description = $('#description').val();
       var vendor_pricing_id = $('#vendor_pricing_id').val();
       var quantity = $('#quantity').val();
       var category = $('#sub_category').val();
       var sub_category = $('#sub_category').val();
       var image_url = $('#image_url').val();

        $.ajax({

        url: "<?php echo site_url('ecommerce/publish_product_to_third_party') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            product_id: product_id,
            vendor_id: vendor_id,
            vendor_pricing_id: vendor_pricing_id,
            product_name: name,
            regular_price: regular_price,
            sale_price: sale_price,
            quantity: quantity,
            category: category,
            sub_category: sub_category,
            product_description: description,
            image_url: image_url
        },
        success: function (data) {
            alert(data.message);
            location.reload();
        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
        }


        });
    });

    $(document).on('change', "#category", function (e) {
   
        var vendor = $('#vendor_type').val();
        var vendor_name = $('#vendor_name').val();
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

    
});


</script>    