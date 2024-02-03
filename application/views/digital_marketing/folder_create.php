<div class="content-body">
    <div id="c_body"></div>
    <style>
    .sla-option {
        list-style-type: none;
        padding: 0;
        display: flex;
        flex-wrap: wrap;
    }

    .sla-option label {
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
            <h4 class="card-title"><?php echo $this->lang->line('Create Folder Details'); ?>
            </h4>


            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" enctype="multipart/form-data"
                action="<?php echo base_url();?>/jobsheets/edit_task">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Folder Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="folder Name"
                                                class="form-control margin-bottom b_input required " name="folder_name"
                                                id="folder_name" value="">

                                        </div>
                                    </div>


                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="" id="action-url">
                                    <input type="hidden" name="folder_id" value="" id="folder_id">
                                    <input type="button" id="update_product_btn"
                                        class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                        value="<?php echo $this->lang->line('Create Folder'); ?>"
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
$(document).ready(function() {


    $(document).on('click', "#update_product_btn", function(e) {
        e.preventDefault();
        var folder_name = $('#folder_name').val();
        var folder_id = $('#folder_id').val();


        $.ajax({

            url: "<?php echo site_url('digitalmarketing/folder_save') ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                folder_name: folder_name,
                folder_id: folder_id
            },
            success: function(data) {
                alert(data.message);
                if (data.status == '200') {
                    setTimeout(function() {
                        window.location.href =
                            "<?php echo site_url('digitalmarketing/folders') ?>";
                    }, 2000); // 5000 milliseconds (5 seconds)
                }
            },
            error: function(data) {
                //console.log(data);
                alert(data.message);
            }


        });


    });


});
</script>