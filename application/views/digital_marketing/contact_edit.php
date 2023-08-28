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
                <h4 class="card-title"><?php //echo $this->lang->line('Add New Task') ?>Edit Contact Details 
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
                                               for="name"><?php echo "First Name"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="first Name"
                                                   class="form-control margin-bottom b_input required " name="first_name"
                                                   id="first_name" value="<?php if(isset($contact_details['attributes']['FIRSTNAME'])){ echo $contact_details['attributes']['FIRSTNAME']; }  ?>">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Last Name"; // $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text"   placeholder="last Name"
                                                   class="form-control margin-bottom b_input required " name="last_name"
                                                   id="last_name" value="<?php if(isset($contact_details['attributes']['LASTNAME'])){  echo $contact_details['attributes']['LASTNAME']; } ?>">
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                    <label class="col-sm-2 col-form-label"
                                        for="name"><?php echo "Email Id"; // $this->lang->line('Title') ?></label>

                                    <div class="col-sm-8">
                                        <input type="text"  readonly  placeholder="email id"
                                            class="form-control margin-bottom b_input required " name="email_id"
                                            id="email_id" value="<?php echo $contact_details['email']; ?>">
                                        
                                    </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                    <label class="col-sm-2 col-form-label"
                                        for="name"><?php echo "SMS Phone No"; // $this->lang->line('Title') ?></label>

                                    <div class="col-sm-8">
                                        <input type="text"   placeholder="sms phone No with country code"
                                            class="form-control margin-bottom b_input required " name="sms_no"
                                            id="sms_no" value="<?php if(isset($contact_details['attributes']['SMS'])){  echo $contact_details['attributes']['SMS']; } ?>">
                                        
                                    </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                    <label class="col-sm-2 col-form-label"
                                        for="name"><?php echo "whatsapp Phone no"; // $this->lang->line('Title') ?></label>

                                    <div class="col-sm-8">
                                        <input type="text"   placeholder="whatsapp phone No with country code"
                                            class="form-control margin-bottom b_input required " name="whatsapp_no"
                                            id="whatsapp_no" value="<?php if(isset($contact_details['attributes']['WHATSAPP'])){ echo $contact_details['attributes']['WHATSAPP']; } ?>">
                                        
                                    </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Email Black Listed"; // $this->lang->line('Title') ?></label>
                                        
                                        <div class="col-sm-8">
                                        <select  class="form-control margin-bottom b_input required " name="email_blacklist"
                                                   id="email_blacklist"  >
                                        
                                        <option value='true' <?php if($contact_details['emailBlacklisted'] == true){ echo "selected"; }?>>yes</option>
                                        <option value='false' <?php if($contact_details['emailBlacklisted'] == false){ echo "selected"; }?>>no</option>
                                        
                                        </select>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Sms Black Listed"; // $this->lang->line('Title') ?></label>
                                        
                                        <div class="col-sm-8">
                                        <select  class="form-control margin-bottom b_input required " name="sms_blacklist"
                                                   id="sms_blacklist"  >
                                        
                                        <option value='true' <?php if($contact_details['smsBlacklisted'] == true){ echo "selected"; }?>>yes</option>
                                        <option value='false' <?php if($contact_details['smsBlacklisted'] == false){ echo "selected"; }?>>no</option>
                                      
                                        
                                        </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo "Recepients Lists"; // $this->lang->line('Title') ?></label>
                                        
                                        <div class="col-sm-8">
                                        <select multiple class="form-control margin-bottom b_input required " name="Recepients[]"
                                                   id="recepients"  >
                                        <?php if(!empty($list_ids['lists'])) { foreach($list_ids['lists'] as $list) { ?>
                                        <option value='<?php echo $list['id']; ?>' <?php if(in_array($list['id'],$contact_details['listIds'])){ echo "selected"; } ?>><?php echo $list['name']; ?></option>
                                        <?php } } ?>
                                        </select>
                                            
                                        </div>
                                    </div>

                                                                      
                                    
                                    
                                    
                                </div>
                                <div id="mybutton">
                                    <input type="hidden" value="" id="action-url">
                                    <input type="hidden" name="contact_id" value="<?php echo $contact_details['id']; ?>" id="contact_id">
                                    <input type="button" id="update_product_btn"
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php //echo $this->lang->line('Add customer') ?>Update Contact"
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
       var first_name = $('#first_name').val();
       var last_name = $('#last_name').val();
       var email_id = $('#email_id').val();
       var sms_no = $('#sms_no').val();
       var whatsapp_no = $('#whatsapp_no').val();
       var receipents = $('#recepients').val();
       var contact_id = $('#contact_id').val();
       

        $.ajax({

        url: "<?php echo site_url('digitalmarketing/contact_save') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            first_name: first_name,
            last_name: last_name,
            email_id: email_id,
            sms_no: sms_no,
            receipents: receipents,
            whatsapp_no: whatsapp_no,
            receipents: receipents,
            contact_id: contact_id
        },
        success: function (data) {
            alert(data.message);
            if(data.status == '200')
            {
                setTimeout(function() {
                window.location.href = "<?php echo site_url('digitalmarketing/contacts') ?>";
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