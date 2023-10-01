<?php

if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
<style>
select#status,
.inphtml {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 10px;
}

#doct {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
</style>
<style>
.error_show {
    color: red;
    margin-left: 10px;
}
</style>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php


?>
<div class="content-body">
    <div id="c_body"></div>

    <div class="card card-block bg-white">
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message"> <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?></div>
        </div>


        <h5><?php echo $this->lang->line('Employee Details') ?> </h5>

        <form method="post" id="data_form" class="form-horizontal" enctype="multipart/form-data"
            style="padding-left:60px" action="<?php echo base_url("employee/updateInternational") ?>">
            <input type="hidden" name="update_id" value="<?php echo $employee->id;?>">
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Name') ?> <span
                        style="color:red">*</span></label>

                <div class="col-sm-8">
                    <span class="name_error"></span>

                    <input type="text" placeholder="Name" class="form-control margin-bottom b_input"
                        onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)"
                        value="<?php echo $employee->name;?>" name="emp_name" id="emp_name" required>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('UserName') ?></label>

                <div class="col-sm-8">
                    <span class="username_error"></span>
                    <input type="text" class="form-control margin-bottom " value="<?php echo $employee->username;?>"
                        name="user_name" id="user_name" placeholder="user_name">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Email') ?> </label>

                <div class="col-sm-8">
                    <span class="email_error"></span>

                    <input type="email" placeholder="email" class="form-control margin-bottom" name="user_email"
                        id="user_email" placeholder="email" value="<?php echo $employee->email;?>">
                </div>
            </div>

            <?php if ($this->aauth->get_user()->roleid >= 0) { ?>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('UserRole') ?> <span
                        style="color:red">*</span></label>

                <div class="col-sm-5">
                    <span class="role_error"></span>

                    <select name="roleid" class="form-control margin-bottom" id="roleid">
                        <option value="">--Select Role--</option>
                        <?php foreach($role_list as $role)
						{
							?>
                        <option value="<?php echo $role['id'];?>"
                            <?php if($role['id']==$employee->degis){ echo"selected";}?> />
                        <?php echo $role['role_name'];?></option>
                        <?php }?>
                    </select>
                </div>
            </div>


            <?php } ?>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Passport Number') ?>
                    <span style="color:red">*</span></label>

                <div class="col-sm-8">
                    <span class="passport_error"></span>

                    <input type="text" placeholder="Passport Number" class="form-control margin-bottom b_input"
                        name="passport" value="<?php echo $employee->passport;?>" id="passport" required>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Passport Expiry') ?>
                    <span style="color:red">*</span></label>

                <div class="col-sm-8">
                    <span class="passport_expiry_error"></span>

                    <input type="text" value="<?php echo date('d-m-Y',strtotime($employee->passport_expiry)); ?>"
                        class="form-control margin-bottom b_input" name="passport_expiry" id="passport_expiry" required>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Permit Number') ?> <span
                        style="color:red">*</span></label>

                <div class="col-sm-8">
                    <span class="permit_error"></span>

                    <input type="text" placeholder="Permit Number" value="<?php echo $employee->permit;?>"
                        class="form-control margin-bottom b_input" name="permit" id="permit" permitrequired>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Permit Expiry') ?><span
                        style="color:red">*</span></label>

                <div class="col-sm-8">
                    <span class="permit_expiry_error"></span>

                    <input type="text" class="form-control margin-bottom b_input"
                        value="<?php echo date('d-m-Y',strtotime($employee->permit_expiry)); ?>" name="permit_expiry"
                        id="permit_expiry" required>
                </div>
            </div>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Country') ?> <span
                        style="color:red">*</span></label>
                <div class="col-sm-8">
                    <span class="country_error"></span>
                    <select name="country" class="form-control margin-bottom b_input required" id="country">
                        <option value="">--Select Country--</option>
                        <?php foreach($country as $cntry)
												 {
?> <option value="<?php echo $cntry->id;?>" <?php if($cntry->id==$employee->country){ echo"selected";}?>>
                            <?php echo $cntry->country_name;?></option>
                        <?php }
												 ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <?php 
								
								// print_r($clients);
 
									 ?>
                <label class="col-sm-2 col-form-label" for="name"><?php echo $this->lang->line('Company') ?> <span
                        style="color:red">*</span></label>
                <div class="col-sm-8">
                    <span class="company_error"></span>
                    <select name="company" id="company" required class="form-control">

                        <?php foreach($client_list as $client)
												 {
													?>
                        <option value="<?php echo $client['id'];?>"
                            <?php if($client['id']==$employee->company){ echo"selected";}?>>
                            <?php echo $client['company'];?></option>
                        <?php													
												 }
												 ?>
                    </select>

                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                    for="name"><?php echo $this->lang->line('Upload Passport Document') ?></label>

                <div class="col-sm-8">
                    <span class="upload_error"></span>
                    <input type="file" id="file" data-val="true"
                        data-val-required="The ImageURLDetails field is required." name='passportfile'>
                    (jpg,JPEG,png,pdf)
                    <?php  if (file_exists(FCPATH . "userfiles/passport/" . $employee->passport_document)) { ?>
                        <a class="ml-3" href="../userfiles/passport/<?php echo $employee->passport_document; ?>" target="_blank" ><?php echo $this->lang->line('View')." ".$this->lang->line('Passport Document'); ?></a>

                    <?php } ?>    
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                    for="name"><?php echo $this->lang->line('Upload Visa Document') ?></label>
                <div class="col-sm-8">
                    <span class="upload_error"></span>
                    <input type="file" id="file" data-val="true" data-val-required="The field is required."
                        name='visafile'>
                    (jpg,JPEG,png,pdf)
                    <?php  
                    if (file_exists(FCPATH . "userfiles/passport/" . $employee->visa_document)) { ?>
                        <a class="ml-3" href="../userfiles/passport/<?php echo $employee->visa_document; ?>" target="_blank" ><?php echo $this->lang->line('View')." ".$this->lang->line('Visa Document'); ?></a>

                    <?php } ?> 
                </div>
            </div>


    </div>
    <div class="col-sm-4">
        <input type="submit" id="submit" class="btn btn-success margin-bottom" onclick="validate()"
            value="<?php echo $this->lang->line('Update') ?>" data-loading-text="Adding...">
    </div>
    </form>



</div>

</div>

<script type="text/javascript">
$("#profile_add").click(function(e) {
    e.preventDefault();
    var actionurl = baseurl + 'user/submit_user';
    actionProduct1(actionurl);
});
</script>
<script>
$(document).ready(function() {
    $("#passport_expiry").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

    $("#permit_expiry").datepicker({
        dateFormat: "dd-mm-yy",
        changeMonth: true,
        changeYear: true
    });

});
</script>
<script>
function actionProduct1(actionurl) {

    $.ajax({

        url: actionurl,
        type: 'POST',
        data: $("#product_action").serialize(),
        dataType: 'json',
        success: function(data) {
            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
            $("#notify").removeClass("alert-warning").addClass("alert-success").fadeIn();


            $("html, body").animate({
                scrollTop: $('html, body').offset().top
            }, 200);
            $("#product_action").remove();
        },
        error: function(data) {
            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("html, body").animate({
                scrollTop: $('#notify').offset().top
            }, 1000);

        }

    });


}
</script>

<script>
function getpassportDetails(val) {
    if (val == "foreign") {
        $("#foreign_content").show();
        //$("#card_body").hide();
        $("#domestic").hide();

    } else {
        $("#foreign_content").hide();
        //$("#card_body").hide();
        $("#domestic").show();

    }
    //alert(val);
}



function validate() {
    $("#emp_name").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".name_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");
    // 	$("#user_name").focusout(function() { 
    //                 if($(this).val()=='') { 
    //                     $(this).css('border', 'solid 2px red'); 
    // 					$(".username_error").text("this field is required");
    // 					return false;
    //                 }
    //                 else {

    //                     // If it is not blank.
    //                     $(this).css('border', 'solid 2px green');    
    //                 }    
    //             }) .trigger("focusout");	

    // $("#user_email").focusout(function() { 
    //                 if($(this).val()=='') { 
    //                     $(this).css('border', 'solid 2px red'); 
    // 					$(".email_error").text("this field is required");
    // 					return false;
    //                 }
    //                 else {

    //                     // If it is not blank.
    //                     $(this).css('border', 'solid 2px green');    
    //                 }    
    //             }) .trigger("focusout");	

    $("#role").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".role_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");


    // $("#password").focusout(function() { 
    //                 if($(this).val()=='') { 
    //                     $(this).css('border', 'solid 2px red'); 
    // 					$(".pswd_error").text("this field is required");
    // 					return false;
    //                 }
    //                 else {

    //                     // If it is not blank.
    //                     $(this).css('border', 'solid 2px green');    
    //                 }    
    //             }) .trigger("focusout");	

    $("#passport").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".passport_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");

    $("#passport_expiry").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".passport_expiry_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");

    $("#permit").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".permit_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");

    $("#permit_expiry").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".permit_expiry_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");
    $("#country").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".country_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");
    $("#company").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".company_error").text("this field is required");
            return false;
        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');
        }
    }).trigger("focusout");




}
</script>