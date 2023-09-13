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
                <h4 class="card-title"><?php echo $this->lang->line('Add Email Campaign Details'); ?> 
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
                                               for="name"><?php echo $this->lang->line('Campaign Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Campaign Name"
                                                   class="form-control margin-bottom b_input required " name="campaign_name"
                                                   id="campaign_name" value="">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Campaign Tag'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Campaign Tag"
                                                   class="form-control margin-bottom b_input required " name="campaign_tag"
                                                   id="campaign_tag" value="">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Sender Name'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="Sender Name"
                                                   class="form-control margin-bottom b_input required " name="sender_name"
                                                   id="sender_name" value="" >
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Sender Email'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="email"   placeholder="Sender Email"
                                                   class="form-control margin-bottom b_input required " name="sender_email"
                                                   id="sender_email" value="" >
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Schedule Date'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="datetime-local"   placeholder="Consumer Key"
                                                   class="form-control margin-bottom b_input required " name="schedule_date"
                                                   id="schedule_date" value="">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Subject'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder=""
                                                   class="form-control margin-bottom b_input required " name="subject"
                                                   id="subject" value="">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Email Preview Text'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder=""
                                                   class="form-control margin-bottom b_input required " name="email_preview_text"
                                                   id="email_preview_text" value="">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Reply to'); ?></label>

                                        <div class="col-sm-8">
                                            <input type="email"   placeholder=""
                                                   class="form-control margin-bottom b_input required " name="reply_to"
                                                   id="reply_to" value="">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Template'); ?></label>

                                        <div class="col-sm-8">
                                        <select class="form-control margin-bottom b_input required " name="template"
                                                   id="template"  >
                                        <?php if(!empty($templates['templates'])) { foreach($templates['templates'] as $template) { ?>
                                        <option value='<?php echo $template['id']; ?>' ><?php echo $template['name']; ?></option>
                                        <?php } } ?>
                                        </select>
                                        <label class="col-form-label"
                                               for="name"><?php echo $this->lang->line('Once template Selected Message Content Will be Ignored, Otherwise Message Content will be Send in Campaign'); ?>
</label>
  
                                        </div>
                                        <div class="col-sm-2">
                                        <input type="button" id="template_view_btn"
                                           class="btn btn-sm btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php echo $this->lang->line('View template'); ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Message Content'); ?></label>

                                        <div class="col-sm-8">
                                            <textarea   placeholder="Message Content"
                                                   class="form-control margin-bottom b_input required " name="message_content"
                                                   id="message_content" value=""> </textarea>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Recepients Lists'); ?></label>

                                        <div class="col-sm-8">
                                        <select multiple class="form-control margin-bottom b_input required " name="Recepients[]"
                                                   id="recepients"  >
                                        <?php if(!empty($list_ids['lists'])) { foreach($list_ids['lists'] as $list) { ?>
                                        <option value='<?php echo $list['id']; ?>' ><?php echo $list['name']; ?></option>
                                        <?php } } ?>
                                        </select>
                                            
                                        </div>
                                    </div>

                                                                      
                                    
                                    
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="" id="action-url">
                                    <input type="hidden" name="campaign_id" value="" id="campaign_id">
                                    <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php echo $this->lang->line('Create Campaign'); ?>"
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
<div class="modal fade" id="template_view_modal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <!-- Modal Header -->
            <div class="modal-header">

                <h4 class="modal-title">Email Template Design</h4>

            </div>

            <!-- Modal Body -->
            <div class="modal-body" id="template_view_modal_content">






            </div>
            <div class="modal-footer">
                <button type="button" id="template_view_modal_close" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>

        </div>

    </div>
    <!-- Modal Footer -->

</div>
<script type="text/javascript">
    $(document).ready(function () {


    $(document).on('click', "#update_product_btn", function (e) {
        e.preventDefault();
       var campaign_name = $('#campaign_name').val();
       var campaign_tag = $('#campaign_tag').val();
       var sender_name = $('#sender_name').val();
       var sender_email = $('#sender_email').val();
       var email_preview_text = $('#email_preview_text').val();
       var reply_to = $('#reply_to').val();
       var subject = $('#subject').val();
       var schedule_date = $('#schedule_date').val();
       var message_content = $('#message_content').val();
       var receipents = $('#recepients').val();
       var campaign_id = $('#campaign_id').val();
       var template = $('#template').val();
        
       if(campaign_name!= '' && sender_name!= '' && schedule_date!= '' && receipents!= '' && campaign_tag!= '' && sender_email!= '' && email_preview_text!= '' && reply_to!= '' && subject!= '')
       {

        if(template != '' || message_content != '')
        {

        
        $.ajax({

        url: "<?php echo site_url('digitalmarketing/email_campaign_save') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            campaign_name: campaign_name,
            campaign_tag: campaign_tag,
            sender_name: sender_name,
            sender_email: sender_email,
            email_preview_text: email_preview_text,
            reply_to: reply_to,
            subject: subject,
            schedule_date: schedule_date,
            message_content: message_content,
            receipents: receipents,
            campaign_id: campaign_id,
            template: template
        },
        success: function (data) {
            alert(data.message);
            if(data.status == '200')
            {
                setTimeout(function() {
            window.location.href = "<?php echo site_url('digitalmarketing/email_marketing_campaigns') ?>";
            }, 2000); // 5000 milliseconds (5 seconds)
            }
            
        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
        }


        });

    }else{
        alert('Please Select Message Content or Template');
    }
    }else{
        alert('Please Enter All Fields');
    }

    
});

$(document).on('click', "#template_view_modal_close", function (e) {
    $('#template_view_modal_content').html('');
});

$(document).on('click', "#template_view_btn", function (e) {

    var template_id = $('#template').val();

    $.ajax({

        url: "<?php echo site_url('digitalmarketing/get_email_template_details') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            
            template_id: template_id
        },
        success: function (data) {
            //alert(data.message);
            if(data.status == '200')
            {

                $('#template_view_modal').modal('show');
                $('#template_view_modal_content').html(data.html);
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