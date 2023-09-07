<style>
.error_show{
	color: red;
	margin-left: 10px;
}
</style>

<div class="content-body">
<div id="c_body"></div>
    <div class="card">
	<div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Employee Details') ?>
				<?php if($this->aauth->premission(43))
											{
?>
				<a href="<?php echo base_url('employee/addExcel') ?>"
                                                               class="btn btn-primary btn-sm rounded ml-2">
                    <?php echo $this->lang->line('Import Employee') ?>
											</a><?php }?>
            </h5>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
    <div class="card card-block bg-white">
	<?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
        <div id="notify" class="alert alert-success" style="display:none;">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">			   </div>
        </div>


		
      <form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("employee/saveInternational") ?>" >

            <hr>    
         <div id="radio-button" style="Padding-left:28px">
				<input type="radio" value="foreign" name="chooseradio"
 onclick="getpassportDetails('foreign');">&nbsp;<?php echo $this->lang->line('Foreign Worker') ?>
		<input type="radio" value="domestic" name="chooseradio" checked onclick="getpassportDetails('domestic');">&nbsp;<?php echo $this->lang->line('Domestic') ?>
      </div>
			<div id="foreign_content" style="display: none;padding:30px;">

                                      <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Name') ?> <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
															<span class="name_error"></span>

                                            <input type="text" placeholder="Name"
                                                   class="form-control margin-bottom b_input" name="emp_name" id="emp_name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                                        </div>
                                    </div>
									       <?php     if ($this->aauth->premission(38)) {
											   ?>

									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('UserName') ?></label>

                                        <div class="col-sm-8">
															<span class="username_error"></span>								
                                             <input type="text"
                           class="form-control margin-bottom " name="user_name" id="user_name"
                           placeholder="user_name">
                                        </div>
                                    </div>
									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Email') ?></label>

                                        <div class="col-sm-8">
														<span class="email_error"></span>

                                          <input type="email" placeholder="email"
                           class="form-control margin-bottom" name="user_email" id="user_email"
                           placeholder="email">
                                        </div>
                                    </div>
									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Password') ?></label>

                                        <div class="col-sm-8">
														<span class="pswd_error"></span>

                                          <input type="text" placeholder="Password" id="user_password"
                           class="form-control margin-bottom" name="user_password"
                           placeholder="password">                    <small class="error">(Use Only a-z0-9)</small>

                                        </div>
                                    </div>
										   <?php }?>
									 <?php if ($this->aauth->get_user()->roleid >= 0) { ?>
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"
                           for="name"><?php echo $this->lang->line('UserRole') ?> <span style="color:red">*</span></label>

                    <div class="col-sm-8">
						<span class="role_error"></span>

                             <select name="roleid" id="roleid" class="form-control margin-bottom">
							 <option value="">--Select Role--</option>
                           <?php foreach($role_list as $role)
						{
							?>
                            <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
						<?php }?>
                        </select>
                    </div>
                </div>


            <?php } ?>
									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Passport Number') ?> <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
										<span class="passport_error"></span>

                                            <input type="text" placeholder="Passport Number"
                                                   class="form-control margin-bottom b_input" name="passport" id="passport" required>
                                        </div>
                                    </div>
									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Passport Expiry Date') ?> <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
						<span class="passport_expiry_error"></span>
		
                                            <input type="date" 
                                                   class="form-control margin-bottom b_input" name="passport_expiry" id="passport_expiry" required>
                                        </div>
                                    </div>
<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Permit Number') ?> <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
												<span class="permit_error"></span>
	
                                            <input type="text" placeholder="Permit Number"
                                                   class="form-control margin-bottom b_input" name="permit" id="permit" required>
                                        </div>
                                    </div><div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Permit Expiry Date') ?> <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
														<span class="permit_expiry_error"></span>

                                            <input type="date"
                                                   class="form-control margin-bottom b_input" name="permit_expiry" id="permit_expiry" required>
                                        </div>
                                    </div>
									                               
<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Country') ?> <span style="color:red">*</span></label>
                                        <div class="col-sm-8">
										<span class="country_error"></span>
												 <select name="country" class="form-control margin-bottom b_input" id="country">
                                              <option value="">--Select Country--</option>												 
												 <?php foreach($country as $cntry)
												 {
?>												 <option value="<?php echo $cntry->id;?>"><?php echo $cntry->country_name;?></option>
												 <?php }
												 ?></select>
                                        </div>
                                    </div>
									<div class="form-group row">
                                     <?php 
								
								// print_r($clients);
 
									 ?>
                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Company') ?> <span style="color:red">*</span></label>
                                        <div class="col-sm-8">
												<span class="company_error"></span>
                                               <select name="company" id="company" required class="form-control">
											    <option value="">--Select--</option>
										         <?php foreach($client_list as $client)
												 {
													?>
													<option value="<?php echo $client['id'];?>"><?php echo $client['company'];?></option>
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
                                    <input type="file"
 id="file" data-val="true" data-val-required="The ImageURLDetails field is required."  name='passportfile' >
   (jpg,JPEG,png,pdf)
                                        </div>
                                    </div>
									<div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Upload Visa Document') ?></label>
                                        <div class="col-sm-8">
												<span class="upload_error"></span>
                                    <input type="file"
 id="file" data-val="true" data-val-required="The field is required."  name='visafile' >
(jpg,JPEG,png,pdf)
                                        </div>
                                    </div>
									  <div class="col-sm-4">
                            <input type="submit" id="submit" class="btn btn-success margin-bottom" onclick="validate()"
                           value="<?php echo $this->lang->line('Add') ?>"
                           data-loading-text="Adding...">
                </div>
       </div>
	   
	   </form>
	   
                   <form method="post" id="data_form" class="card-body">
			
	   <div id="domestic">
<?php     if ($this->aauth->premission(38)) {
				
				?>
				      <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('UserName') ?>
                    <small class="error">(Use Only a-z0-9)</small></label>

                <div class="col-sm-10">
                          <input type="text"
                           class="form-control margin-bottom" name="username"
                           placeholder="username">
                </div>
            </div>
		   <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('Email') ?></label>
                <div class="col-sm-10">
                           <input type="email" placeholder="email"
                           class="form-control margin-bottom" name="email"
                           placeholder="email">
                </div>
            </div>
<div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('Password') ?>
					   <small>(min length 6|max length 20|a-zA-Z0-9@$)</small>
</label>
                <div class="col-sm-10">
                           <input type="text" placeholder="Password"
                           class="form-control margin-bottom" name="password"
                           placeholder="password">
                </div>
            </div>
         
<?php }?>
      


            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('Name') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                    <input type="text" placeholder="Name"
                           class="form-control margin-bottom required" name="name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)"
                           placeholder="Full name">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="address"><?php echo $this->lang->line('Address') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                    <input type="text" placeholder="address"
                           class="form-control margin-bottom required" name="address">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="city"><?php echo $this->lang->line('City') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                    <input type="text" placeholder="City"
                           class="form-control margin-bottom required" name="city" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="city"><?php echo $this->lang->line('Region') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                    <input type="text" placeholder="Region"
                           class="form-control margin-bottom required" name="region" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="country"><?php echo $this->lang->line('Country') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                   <select name="country" class="form-control margin-bottom b_input required" id="country">  
				   <option value="">--Select Country--</option>												 

						 <?php foreach($country as $cntry)
												 {
?>												 <option value="<?php echo $cntry->id;?>"><?php echo $cntry->country_name;?></option>
												 <?php }
												 ?></select>
                </div>
            </div>
      <?php if ($this->aauth->get_user()->roleid >= 0) { ?>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"
                           for="name"><?php echo $this->lang->line('UserRole') ?> <span style="color:red">*</span></label>

                    <div class="col-sm-5">
                        <select name="roleid" class="form-control margin-bottom required">
						<option value="">--Select Role--</option>
                           <?php foreach($role_list as $role)
						{
							?>
                            <option value="<?php echo $role['id'];?>"><?php echo $role['role_name'];?></option>
						<?php }?>
                        </select>
                    </div>
                </div>


            <?php } ?>

            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('Business Location') ?></label>

                <div class="col-sm-5">
                    <select name="location" class="form-control margin-bottom">
                        <option value="0"><?php echo $this->lang->line('Default') ?></option>
                        <?php $loc = locations();

                        foreach ($loc as $row) {
                            echo ' <option value="' . $row['id'] . '"> ' . $row['cname'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="postbox"><?php echo $this->lang->line('Postbox') ?></label>

                <div class="col-sm-10">
                    <input type="text" placeholder="Postbox"
                           class="form-control margin-bottom" name="postbox">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="phone"><?php echo $this->lang->line('Phone') ?> <span style="color:red">*</span></label>

                <div class="col-sm-10">
                    <input type="number"  pattern="[0-9]*" inputmode="numeric"  placeholder="phone" placeholder="phone"
                           class="form-control margin-bottom required" name="phone">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="phone"><?php echo $this->lang->line('Salary') ?></label>

                <div class="col-sm-5">
                    <input type="text" placeholder="Salary" onkeypress="return isNumber(event)"
                           class="form-control margin-bottom" name="salary"
                           value="0">
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="city"><?php echo $this->lang->line('Commission') ?>
                    %</label>

                <div class="col-sm-2">
                    <input type="number" placeholder="Commission %" value="0"
                           class="form-control margin-bottom" name="commission">
                </div>
                <small class="col">It will based on each invoice amount - inclusive all
                    taxes,shipping,discounts
                </small>

            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"
                       for="name"><?php echo $this->lang->line('Department') ?> <span style="color:red">*</span></label>

                <div class="col-sm-5">
                    <select name="department" class="form-control margin-bottom required">

                        <option value="0"><?php echo $this->lang->line('Default') . ' - ' . $this->lang->line('No') ?></option>
                        <?php

                        foreach ($dept as $row) {
                            echo ' <option value="' . $row['id'] . '"> ' . $row['val1'] . '</option>';
                        }

                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group row">

                <label class="col-sm-2 col-form-label"></label>

                <div class="col-sm-4">
                    <input type="submit" id="submit-data" class="btn btn-success margin-bottom"
                           value="<?php echo $this->lang->line('Add') ?>"
                           data-loading-text="Adding...">
                    <input type="hidden" value="employee/submit_user" id="action-url">
                </div>
            </div>


        </form></div>

    </div>

</div>
</div>
<script type="text/javascript">
    $("#profile_add").click(function (e) {
        e.preventDefault();
        var actionurl = baseurl + 'user/submit_user';
        actionProduct1(actionurl);
    });
</script>

<script>

    function actionProduct1(actionurl) {

        $.ajax({

            url: actionurl,
            type: 'POST',
            data: $("#product_action").serialize(),
            dataType: 'json',
            success: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-warning").addClass("alert-success").fadeIn();


                $("html, body").animate({scrollTop: $('html, body').offset().top}, 200);
                $("#product_action").remove();
            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").animate({scrollTop: $('#notify').offset().top}, 1000);

            }

        });


    }
</script>

<script>
 function getpassportDetails(val)
{
	if(val=="foreign")
	{
		$("#foreign_content").show();
		//$("#card_body").hide();
$("#domestic").hide();

	}
	else{
		$("#foreign_content").hide();
		//$("#card_body").hide();
$("#domestic").show();

	}
	//alert(val);
}



function validate()
{
	$("#emp_name").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".name_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
$("#roleid").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".role_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
				
$("#passport").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".passport_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
				
		$("#passport_expiry").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".passport_expiry_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
			
		$("#permit").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".permit_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");				
	
		$("#permit_expiry").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".permit_expiry_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");	
		$("#country").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".country_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
				$("#company").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".company_error").text("this field is required");
					return false;
                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
                }    
            }) .trigger("focusout");
			
		
		
}

</script>
