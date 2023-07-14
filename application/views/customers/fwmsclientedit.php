	<?php
		
		?>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Edit Fwms Customer') ?></h4>

            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-body">
	
		  <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
		
                <div class="card">

                    <div class="card-content">
					

					  <form method="post" id="data_form" class="form-horizontal" action="<?php echo base_url();?>/customers/updateInternational"   onSubmit="return validateForm(event);">
                        <div class="card-body" id="card-body">
                             <input type="hidden" value="<?php echo $client->id;?>" name="update_id">
                            <div class="tab-content px-1 pt-1" id="tab_content">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                    <div class="form-group row mt-1">
                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Name') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
																				<span class="company_name_error"></span>
		
                                            <input type="text" placeholder="Company"
                                                   class="form-control margin-bottom b_input required" name="company_name" id="company_name" 
					 onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32)"

												   value="<?php echo $client->name;?>"
												   
												   >
                                        </div>
                                    </div>
									
									 <div class="form-group row">

                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Company') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
											<span class="company_error"></span>
                                            <input type="text" 
                                                   class="form-control margin-bottom b_input" name="company" id="company"  value="<?php echo $client->company;?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Address') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
										<span class="address_error"></span>
                                            <input type="text" placeholder="address"
                                                   class="form-control margin-bottom b_input" name="address" id="address"  value="<?php echo $client->address;?>" >
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                      <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Roc Number') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
																				<span class="roc_error"></span>

                                            <input type="text" placeholder="Roc Number"
                             class="form-control margin-bottom b_input" name="roc" id="roc" value="<?php echo $client->roc;?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Email') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
																				<span class="email_error"></span>

                                            <input type="text" placeholder="Email" id="email"
                                                   class="form-control margin-bottom b_input" value="<?php echo $client->email;?>" name="email" >
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                         <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Contact Number') ?><span style="color:red">*</span></label>

                                        <div class="col-sm-8">
										<span class="contact_error"></span>

                                            <input type="number"  pattern="[0-9]*" inputmode="numeric" placeholder="Contact"
                                                   class="form-control margin-bottom b_input" id="contact" name="contact" value="<?php echo $client->phone;?>" >
                                        </div>
                                    </div>
                                    <div class="form-group row">
 <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Incharge Person') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="incharge"
                                                   class="form-control margin-bottom b_input" name="incharge"  value="<?php echo $client->incharge;?>" >
                                        </div>
                                    </div>
                                 
                       								
                                <div id="mybutton">
                                    <input type="submit" id=""
                                           class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                           value="<?php echo $this->lang->line('Update') ?>"
                                           data-loading-text="Adding...">
                                </div>
                            </div>
							</div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
 function getpassportDetails(val)
{
	if(val=="foreign")
	{
		$("#foreign_content").show();
		//$("#card_body").hide();
$("#tab_content").hide();
$("#tab_list").hide();

	}
	else{
		$("#foreign_content").hide();
		//$("#card_body").hide();
$("#tab_content").show();
$("#tab_list").show();
	}
	//alert(val);
}
  function  validateForm(e){
        var company_name = document.getElementById('company_name').value;
		 var company = document.getElementById('company').value;
		 $("#company_name").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".company_name_error").text("this field is required");
					
					        e.preventDefault();

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
				
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#address").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".address_error").text("this field is required");
				
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#roc").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".roc_error").text("this field is required");
			
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#email").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".email_error").text("this field is required");
				
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#contact").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".contact_error").text("this field is required");
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");




	   }


</script>