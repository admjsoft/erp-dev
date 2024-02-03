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
            <h4 class="card-title"><?php echo $this->lang->line('Edit WhatsApp Campaign Details'); ?>
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
                                            for="name"><?php echo $this->lang->line('Campaign Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Campaign Name"
                                                class="form-control margin-bottom b_input required "
                                                name="campaign_name" id="campaign_name"
                                                value="<?php echo $campaign_details['campaignName']; ?>">

                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Schedule Date'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="datetime-local" placeholder="Schedule Date"
                                                class="form-control margin-bottom b_input required "
                                                name="schedule_date" id="schedule_date"
                                                value="<?php echo $campaign_details['scheduledAt']; ?>">

                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Templates'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" readonly placeholder="Template"
                                                class="form-control margin-bottom b_input required " name="template"
                                                id="schedule_date"
                                                value="<?php echo $campaign_details['template']['name']; ?>">


                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Campaign Status') ?></label>

                                        <div class="col-sm-8">
                                            <select class="form-control margin-bottom b_input required "
                                                name="campaign_status" id="campaign_status">

                                                <option value='scheduled' selected><?php echo $this->lang->line('Scheduled'); ?></option>
                                                <option value='suspended'><?php echo $this->lang->line('Suspended'); ?></option>

                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Recepients Lists'); ?></label>
                                        <?php $includedListsArray = $campaign_details['recipients']['includedLists']; ?>
                                        <div class="col-sm-8">
                                            <select multiple class="form-control margin-bottom b_input required "
                                                name="Recepients[]" id="recepients">
                                                <?php if(!empty($list_ids['lists'])) { foreach($list_ids['lists'] as $list) { ?>
                                                <option value='<?php echo $list['id']; ?>'
                                                    <?php if(in_array($list['id'],$includedListsArray)){ echo "selected"; } ?>>
                                                    <?php echo $list['name']; ?></option>
                                                <?php } } ?>
                                            </select>

                                        </div>
                                    </div>





                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="" id="action-url">
                                    <input type="hidden" name="campaign_id"
                                        value="<?php echo $campaign_details['id']; ?>" id="campaign_id">
                                    <input type="button" id="update_product_btn"
                                        class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                        value="<?php echo $this->lang->line('Update Campaign') ?>"
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
        var campaign_name = $('#campaign_name').val();
        var schedule_date = $('#schedule_date').val();
        var receipents = $('#recepients').val();
        var campaign_id = $('#campaign_id').val();
        var campaign_status = $('#campaign_status').val();


        $.ajax({

            url: "<?php echo site_url('digitalmarketing/whatsapp_campaign_save') ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                campaign_name: campaign_name,
                schedule_date: schedule_date,
                receipents: receipents,
                campaign_id: campaign_id,
                campaign_status: campaign_status
            },
            success: function(data) {
                alert(data.message);
                if (data.status == '200') {
                    setTimeout(function() {
                        window.location.href =
                            "<?php echo site_url('digitalmarketing/whatsapp_marketing_campaigns') ?>";
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