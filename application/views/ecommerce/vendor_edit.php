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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>Edit Online Platform Details 
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
                                               for="name"><?php echo "Online Platform Name"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="vendor_name"
                                                   id="vendor_name" value="<?php echo $vendor_details[0]['VendorName']; ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "WebSite url"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Title"
                                                   class="form-control margin-bottom b_input required " name="website_url"
                                                   id="website_url" value="<?php echo $vendor_details[0]['WebSiteUrl']; ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Consumer Key"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Consumer Key"
                                                   class="form-control margin-bottom b_input required " name="consumer_key"
                                                   id="consumer_key" value="<?php echo $vendor_details[0]['ConsumerKey']; ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Consumer Secret"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Consumer Secret"
                                                   class="form-control margin-bottom b_input required " name="consumer_secret"
                                                   id="consumer_secret" value="<?php echo $vendor_details[0]['ConsumerSecret']; ?>">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                    <label class="col-sm-2 col-form-label"
                                        for="name"><?php echo "Platform Type"; // $this->lang->line('Title') ?></label>

                                    <div class="col-sm-8">
                                    <select class="form-control margin-bottom b_input required " name="platform_type"
                                            id="platform_type"  >
                                    <option value='0' <?php if($vendor_details[0]['PlatformType'] == '0'){ echo "selected"; } ?>>Single Platform</option>
                                    <option value='1' <?php if($vendor_details[0]['PlatformType'] == '1'){ echo "selected"; } ?>>Multiple Platform</option>
                                    </select>
                                    <?php if($vendor_details[0]['PlatformType'] == '0'){ ?>
                                        <label class="" id="single_platform_text" for="name">Single Platform Option Allows to Edit/Delete Categories & Sub Categories  </label>
                                        <label class="" style="display:none"; id="multiple_platform_text" for="name">Multiple Platform Option Don't Allows to Edit/Delete Categories & Sub Categories  </label>

                                    <?php }else{ ?>
                                        <label class="" style="display:none"; id="single_platform_text" for="name">Single Platform Option Allows to Edit/Delete Categories & Sub Categories  </label>
                                        <label class=""  id="multiple_platform_text" for="name">Multiple Platform Option Don't Allows to Edit/Delete Categories & Sub Categories  </label>

                                    <?php } ?>
                                    
                                    </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Sale Type"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                        <select class="form-control margin-bottom b_input required " name="sale_type"
                                                   id="sale_type"  >
                                        <option value='Offline' <?php if($vendor_details[0]['Type'] == 'Offline'){ echo "selected"; } ?>>Offline</option>
                                        <option value='Online' <?php if($vendor_details[0]['Type'] == 'Online'){ echo "selected"; } ?>>Online</option>
                                        </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "WebSite Type"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                        <select class="form-control margin-bottom b_input required " name="website_type"
                                                   id="website_type"  >
                                        <option value='wordpress' <?php if($vendor_details[0]['WebSiteType'] == 'wordpress'){ echo "selected"; } ?>>WordPress</option>
                                        </select>
                                            
                                        </div>
                                    </div>

                                    
                                    
                                    
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="jobsheets/edit_task" id="action-url">
                                    <input type="hidden" name="vendor_id" value="<?php echo $vendor_details[0]['Id']; ?>" id="vendor_id">
                                    <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php //echo $this->lang->line('Add customer') ?>Update Online Platform"
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

    $(document).on('change', "#platform_type", function (e) {
    var p_type = $('#platform_type').val();
    if(p_type == 1)
    {
        $('#single_platform_text').hide();
        $('#multiple_platform_text').show();
    }else{
        $('#multiple_platform_text').hide();
        $('#single_platform_text').show();
    }
    });
    $(document).on('click', "#update_product_btn", function (e) {
        e.preventDefault();
       var vendor_name = $('#vendor_name').val();
       var website_url = $('#website_url').val();
       var consumer_key = $('#consumer_key').val();
       var consumer_secret = $('#consumer_secret').val();
       var website_type = $('#website_type').val();
       var sale_type = $('#sale_type').val();
       var platform_type = $('#platform_type').val();
       var vendor_id = $('#vendor_id').val();
       

        $.ajax({

        url: "<?php echo site_url('ecommerce/vendor_save') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            vendor_name: vendor_name,
            website_url: website_url,
            consumer_key: consumer_key,
            consumer_secret: consumer_secret,
            website_type: website_type,
            sale_type: sale_type,
            platform_type: platform_type,
            vendor_id: vendor_id
        },
        success: function (data) {
            alert(data.message);
            setTimeout(function() {
            window.location.href = "<?php echo site_url('ecommerce/online_platforms') ?>";
            }, 2000); // 5000 milliseconds (5 seconds)
        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
        }


    });

    
});


    });
</script>    