<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Edit Customer Details') ?></h5>

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
            <form method="post" id="data_form" class="form-horizontal" >
                <div class="row">

                    <div class="col-md-6">
                        <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                        <input type="hidden" name="id" value="<?php echo $customer['id'] ?>">


                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="product_name"><?php echo $this->lang->line('Name') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
								<span class="domestic_name_error"></span>

                                <input type="text" placeholder="Name"
                                       class="form-control margin-bottom required" name="name"
                                       value="<?php echo $customer['name'] ?>" id="mcustomer_name">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="product_name"><?php echo $this->lang->line('Company') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
														<span class="domestic_comapny_error"></span>

                                <input type="text" placeholder="Company"
                                       class="form-control margin-bottom" name="company" id="domestic_company"
                                       value="<?php echo $customer['company'] ?>">
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="phone"><?php echo $this->lang->line('Phone') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
								<span class="domestic_phone_error"></span>

                                <input type="text" placeholder="phone"
                                       class="form-control margin-bottom  required" name="phone"
                                       value="<?php echo $customer['phone'] ?>" id="mcustomer_phone">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label" for="email">Email <span style="color:red">*</span></label>

                            <div class="col-sm-9">
                       <span class="domestic_email_error"></span>
							  <input type="text" placeholder="email"
                                       class="form-control margin-bottom required" name="email"
                                       value="<?php echo $customer['email'] ?>" id="mcustomer_email">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="product_name"><?php echo $this->lang->line('Address') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
					                       <span class="domestic_address_error"></span>

                                <input type="text" placeholder="address"
                                       class="form-control margin-bottom" name="address"
                                       value="<?php echo $customer['address'] ?>" id="mcustomer_address1">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="city"><?php echo $this->lang->line('City') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
									 <span class="domestic_city_error"></span>

                                <input type="text" placeholder="city"
                                       class="form-control margin-bottom" name="city"
                                       value="<?php echo $customer['city'] ?>" id="mcustomer_city">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="region"><?php echo $this->lang->line('Region') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
																 <span class="domestic_region_error"></span>

                                <input type="text" placeholder="region"
                                       class="form-control margin-bottom" name="region"
                                       value="<?php echo $customer['region'] ?>" id="region">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="country"><?php echo $this->lang->line('Country') ?> <span style="color:red">*</span></label>

                            <div class="col-sm-9">
						 <span class="domestic_country_error"></span>

                                <input type="text" placeholder="Country"
                                       class="form-control margin-bottom" name="country"
                                       value="<?php echo $customer['country'] ?>" id="mcustomer_country">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="region"
                                       class="form-control margin-bottom" name="postbox"
                                       value="<?php echo $customer['postbox'] ?>" id="postbox">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="postbox"><?php echo $this->lang->line('Tax') ?> ID</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="TAX ID"
                                       class="form-control margin-bottom" name="taxid"
                                       value="<?php echo $customer['taxid'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="postbox"><?php echo $this->lang->line('Document') ?> ID</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Document ID"
                                       class="form-control margin-bottom b_input" name="docid"
                                       value="<?php echo $customer['docid'] ?>">
                            </div>
                        </div>
                        <div class="form-group row"><label class="col-sm-3 col-form-label"
                                                           for="postbox"><?php echo $this->lang->line('Extra') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Custom Field"
                                       class="form-control margin-bottom b_input" name="c_field"
                                       value="<?php echo $customer['custom1'] ?>">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="customergroup"><?php echo $this->lang->line('Customer group') ?></label>

                            <div class="col-sm-9">
                                <select name="customergroup" class="form-control">
                                    <?php
                                    echo '<option value="' . $customergroup['id'] . '">' . $customergroup['title'] . ' (S)</option>';
                                    foreach ($customergrouplist as $row) {
                                        $cid = $row['id'];
                                        $title = $row['title'];
                                        echo "<option value='$cid'>$title</option>";
                                    }
                                    ?>
                                </select>


                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="customergroup">Language</label>
                            <div class="col-sm-9">
                                <select name="language" class="form-control b_input">
                                    <?php
                                    echo '<option value="' . $customer['lang'] . '">-' . ucfirst($customer['lang']) . '-</option>';
                                    echo $langs;
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row"><label class="col-sm-3 col-form-label"
                                                           for="Discount"><?php echo $this->lang->line('Discount') ?> </label>
                            <div class="col-sm-9">
                                <input type="text" placeholder="Custom Discount"
                                       class="form-control margin-bottom b_input" name="discount"
                                       value="<?php echo $customer['discount_c'] ?>">
                            </div>
                        </div>

                        <?php foreach ($custom_fields as $row) {
                            if ($row['f_type'] == 'text') { ?>
                                <div class="form-group row">

                                    <label class="col-sm-3 col-form-label"
                                           for="docid"><?= $row['name'] ?></label>

                                    <div class="col-sm-8">
                                        <input type="text" placeholder="<?= $row['placeholder'] ?>"
                                               class="form-control margin-bottom b_input"
                                               name="custom[<?= $row['id'] ?>]"
                                               value="<?= $row['data'] ?>">
                                    </div>
                                </div>


                            <?php }


                        }
                        ?>
                    </div>

                    <div class="col-md-6">
                        <h5><?php echo $this->lang->line('Shipping Address') ?></h5>
                        <div class="form-group row">

                            <div class="input-group mt-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="customer1"
                                           id="copy_address">
                                    <label class="custom-control-label"
                                           for="copy_address"><?php echo $this->lang->line('Same As Billing') ?></label>
                                </div>

                            </div>

                            <div class="col-sm-9">
                                <?php echo $this->lang->line("leave Shipping Address") ?>
                            </div>
                        </div>

                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="product_name"><?php echo $this->lang->line('Name') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Name"
                                       class="form-control margin-bottom" name="name_s"
                                       value="<?php echo $customer['name_s'] ?>" id="mcustomer_name_s">
                            </div>
                        </div>


                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="phone"><?php echo $this->lang->line('Phone') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="phone"
                                       class="form-control margin-bottom" name="phone_s"
                                       value="<?php echo $customer['phone_s'] ?>" id="mcustomer_phone_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label" for="email">Email</label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="email"
                                       class="form-control margin-bottom" name="email_s"
                                       value="<?php echo $customer['email_s'] ?>" id="mcustomer_email_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="product_name"><?php echo $this->lang->line('Address') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="address"
                                       class="form-control margin-bottom" name="address_s"
                                       value="<?php echo $customer['address_s'] ?>" id="mcustomer_address1_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="city"><?php echo $this->lang->line('City') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="city"
                                       class="form-control margin-bottom" name="city_s"
                                       value="<?php echo $customer['city_s'] ?>" id="mcustomer_city_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="region"><?php echo $this->lang->line('Region') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="region"
                                       class="form-control margin-bottom" name="region_s"
                                       value="<?php echo $customer['region_s'] ?>" id="region_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="country"><?php echo $this->lang->line('Country') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="Country"
                                       class="form-control margin-bottom" name="country_s"
                                       value="<?php echo $customer['country_s'] ?>" id="mcustomer_country_s">
                            </div>
                        </div>
                        <div class="form-group row">

                            <label class="col-sm-3 col-form-label"
                                   for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                            <div class="col-sm-9">
                                <input type="text" placeholder="region"
                                       class="form-control margin-bottom" name="postbox_s"
                                       value="<?php echo $customer['postbox_s'] ?>" id="postbox_s">
                            </div>
                        </div>


                    </div>

                </div>
                <div class="form-group row">

                    <label class="col-sm-3 col-form-label"></label>

                    <div class="col-sm-3">
                        <input type="submit" id="submit-data-update" class="btn btn-success margin-bottom"
                               value="Update customer" data-loading-text="Updating...">
                        <input type="hidden" value="customers/editcustomer" id="action-url">

                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
 $("#submit-data-update").on("click", function (e) {
//validateFormForDomestic(e);
        e.preventDefault();
        var o_data = $("#data_form").serialize();
        var action_url = $('#action-url').val();
        jQuery.ajax({

            url: '<?php echo base_url() ?>' + action_url,
            type: 'POST',
            data: o_data + '&<?=$this->security->get_csrf_token_name(); ?>=<?=$this->security->get_csrf_hash(); ?>',
            dataType: 'json',
            success: function (data) {
                if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();
setTimeout(function() {
    location.reload();
}, 1000);

                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();
					setTimeout(function() {
    location.reload();
}, 1000);
                }

            },
            error: function (data) {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
                $("html, body").scrollTop($("body").offset().top);

            }
        });
    });

 function  validateFormForDomestic(e){
        var company_name = document.getElementById('company_name').value;
		 var company = document.getElementById('company').value;
		 $("#mcustomer_name").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_name_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
		 $("#domestic_company").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_comapny_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
$("#mcustomer_phone").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_phone_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
$("#mcustomer_email").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_email_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#mcustomer_address1").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_address_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#mcustomer_city").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_city_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
			
$("#region").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_region_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
			
			
$("#mcustomer_country").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".domestic_country_error").text("this field is required");
				//	$('input:radio[name=chooseradio]').val(['foreign']);
//$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");
			
			
			
			
			


	   }
		

</script>

