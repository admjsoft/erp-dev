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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>Create SubCategory Details 
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
                                    
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Sub Category Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="category_name"
                                                   id="category_name" value="">
                                            
                                        </div>
                                    </div>
                                    <?php /* ?>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Sub Category Slug"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="category_slug"
                                                   id="category_slug" value="<?php echo $sub_category_details['slug']; ?>">
                                            
                                        </div>
                                    </div>
                                    <?php */ ?>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Category"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <select class="form-control" id="category_id" name="category_id">
                                                <option value="">Select Category</option>
                                                <?php if(!empty($categories)){ foreach ($categories as $category) { ?>
                                                    <option value="<?php echo $category['id']; ?>" ><?php echo $category['name']; ?></option>
                                                <?php } } ?>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Sub Category Description"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <textarea type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="category_description"
                                                   id="category_description" value="">
                                            </textarea>
                                            
                                        </div>
                                    </div>

                                    
                                    
                                    
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="jobsheets/edit_task" id="action-url">
                                    <input type="hidden" name="sub_category_id" value="" id="sub_category_id">
                                    <input type="hidden" name="vendor_id" value="<?php echo $vendor_details[0]['Id']; ?>" id="vendor_id">
                                    <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php echo $this->lang->line('Update Sub Category'); ?>"
                                           data-loading-text="updating...">
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
       var category_name = $('#category_name').val();
       var category_slug = $('#category_slug').val();
       var category_description = $('#category_description').val();
       var category_id = $('#category_id').val();
       var sub_category_id = $('#sub_category_id').val();
       var vendor_id = $('#vendor_id').val();
       

        $.ajax({

        url: "<?php echo site_url('ecommerce/sub_category_save') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            category_name: category_name,
            category_slug: category_slug,
            category_description: category_description,
            category_id: category_id,
            vendor_id: vendor_id,
            sub_category_id: sub_category_id
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


    });
</script>    