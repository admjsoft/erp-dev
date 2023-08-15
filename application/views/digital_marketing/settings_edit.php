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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>Update Settings 
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
                                               for="name"><?php echo "Name"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder=" Name"
                                                   class="form-control margin-bottom b_input required " name="setting_name"
                                                   id="setting_name" value="<?php echo $settings_details[0]['name']; ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "API Key"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <textarea type="text"   placeholder="API Key"
                                                   class="form-control margin-bottom b_input required " name="api_key"
                                                   id="api_key" value=""><?php echo $settings_details[0]['api_key']; ?></textarea>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="" id="action-url">
                                    <input type="hidden" name="vendor_id" value="<?php echo $settings_details[0]['id']; ?>" id="setting_id">
                                    <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php //echo $this->lang->line('Add customer') ?>Update Setting"
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
       
       var setting_name = $('#setting_name').val();
       var api_key = $('#api_key').val();
       var setting_id = $('#setting_id').val();
       

        $.ajax({

        url: "<?php echo site_url('digitalmarketing/settings_save') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            setting_name: setting_name,
            api_key: api_key,
            setting_id: setting_id
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


    });
</script>    