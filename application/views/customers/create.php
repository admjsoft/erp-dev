<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Add New Customer') ?></h4>

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

                <div class="card-content"><input type="radio" value="foreign" name="chooseradio"
                        onclick="getpassportDetails('foreign');">&nbsp;<?php echo $this->lang->line('International') ?>
                    <input type="radio" value="domestic" checked name="chooseradio"
                        onclick="getpassportDetails('domestic');">&nbsp;<?php echo $this->lang->line('Domestic') ?>

                    <div id="foreign_content" style="display:none">
                        
      <form method="post"  class="form-horizontal" enctype="multipart/form-data" id="myform" 
	  action="<?php echo base_url("customers/saveInternational") ?>" onSubmit="return validateForm(event);">
                            <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Name') ?>  <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
											<span class="company_name_error"></span>

                                            <input type="text" placeholder="Company"
                                                   class="form-control margin-bottom required" name="company_name" id="company_name"  >
                                        </div>
                                    </div>
									
                                       <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php echo $this->lang->line('Company') ?>  <span style="color:red">*</span></label>

                                        <div class="col-sm-8">
									<span class="company_error"></span>

                                            <input type="text" placeholder="Company"
                                                   class="form-control margin-bottom required" name="company" id="company">
                                        </div>
                                    </div>
									
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-8">
																	<span class="address_error"></span>

                                    <input type="text" placeholder="address" class="form-control margin-bottom required"
                                        id="international_c_address" name="address">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Roc Number') ?></label>

                                <div class="col-sm-8">
									<span class="roc_error"></span>

                                    <input type="text" placeholder="Roc Number"
                                        class="form-control form-control margin-bottom required" name="roc" id="roc">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-8">
									<span class="email_error"></span>
                                    <input type="text" placeholder="Email" class="form-control form-control margin-bottom required"
                                        name="email" id="international_email_id">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Contact Number') ?></label>

                                <div class="col-sm-8">
																<span class="contact_error"></span>

                                    <input type="number"  id="contact" pattern="[0-9]*" inputmode="numeric"  placeholder="Contact" class="form-control margin-bottom required"
                                        name="contact">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Incharge Person') ?></label>

                                <div class="col-sm-8">
                                    <input type="text" placeholder="incharge" class="form-control margin-bottom b_input"
                                        name="incharge">
                                </div>
                            </div>
                            <?php     if ($this->aauth->premission(39)) {
										?>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="currency"><?php echo $this->lang->line('customer_login') ?></label>

                                <div class="col-sm-8">
                                    <select name="c_login" class="form-control b_input">

                                        <option value="1"><?php echo $this->lang->line('Yes') ?></option>
                                        <option value="0"><?php echo $this->lang->line('No') ?></option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="password_c"><?php echo $this->lang->line('New Password') ?></label>

                                <div class="col-sm-8">
                                    <input type="text" placeholder="Leave blank for auto generation"
                                        class="form-control margin-bottom b_input" name="password_c" id="password_c">
                                </div>
                            </div>
                            <?php
									}
									?>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label" for="currency">Language</label>

                                <div class="col-sm-8">
																								<span class="language_error"></span>

                                    <select name="language" id="language" class="form-control margin-bottom required">

                                        <?php

                                                echo $langs;
                                                ?>

                                    </select>
                                </div>
                            </div>
                            <div id="mybutton">
                                <input type="submit" id="submitadd" 
                                    class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                    value="<?php echo $this->lang->line('Add customer') ?>"
                                    data-loading-text="Adding...">
                            </div>
                        </form>
                    </div>
      <form method="post"  class="form-horizontal" enctype="multipart/form-data" action="<?php echo base_url("customers/addcustomer") ?>" onSubmit="return validateFormForDomestic(event);" >

                        <div class="card-body" id="card-body">

                            <ul class="nav nav-tabs" role="tablist" id="tab_list">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="base-tab1" data-toggle="tab"
                                        aria-controls="tab1" href="#tab1" role="tab"
                                        aria-selected="true"><?php echo $this->lang->line('Billing Address') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                        href="#tab2" role="tab"
                                        aria-selected="false"><?php echo $this->lang->line('Shipping Address') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                        href="#tab4" role="tab"
                                        aria-selected="false"><?php echo $this->lang->line('CustomFields') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab3"
                                        href="#tab3" role="tab"
                                        aria-selected="false"><?php echo $this->lang->line('Other') . ' ' . $this->lang->line('Settings') ?></a>
                                </li>

                            </ul>
                            <div class="tab-content px-1 pt-1" id="tab_content">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Name') ?></label>

                                        <div class="col-sm-8">
												<span class="domestic_name_error"></span>

                                            <input type="text" placeholder="Name"
                                                class="form-control margin-bottom b_input required" name="name"
                                                id="mcustomer_name">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Company') ?></label>

                                        <div class="col-sm-8">
											<span class="domestic_comapny_error"></span>
                                            <input type="text" placeholder="Company"
                                                class="form-control margin-bottom b_input" name="company" id="domestic_company">
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                        <div class="col-sm-8">
									<span class="domestic_phone_error"></span>

                                            <input type="number"  pattern="[0-9]*" inputmode="numeric"  placeholder="phone"
                                                class="form-control margin-bottom required b_input" name="phone"
                                                id="mcustomer_phone">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label" for="email">Email</label>

                                        <div class="col-sm-8">
											<span class="domestic_email_error"></span>
                                            <input type="text" placeholder="email"
                                                class="form-control margin-bottom required b_input" name="email"
                                                id="mcustomer_email">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="address"><?php echo $this->lang->line('Address') ?></label>

                                        <div class="col-sm-8">
											<span class="domestic_address_error"></span>
                                            <input type="text" placeholder="address"
                                                class="form-control margin-bottom b_input" name="address"
                                                id="mcustomer_address1">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="city"><?php echo $this->lang->line('City') ?></label>

                                        <div class="col-sm-8">
												<span class="domestic_city_error"></span>

                                            <input type="text" placeholder="city"
                                                class="form-control margin-bottom b_input" name="city"
                                                id="mcustomer_city">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="region"><?php echo $this->lang->line('Region') ?></label>

                                        <div class="col-sm-8">
																					<span class="domestic_region_error"></span>

                                            <input type="text" placeholder="Region"
                                                class="form-control margin-bottom b_input" name="region" id="region">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="country"><?php echo $this->lang->line('Country') ?></label>

                                        <div class="col-sm-8">
												<span class="domestic_country_error"></span>

                                            <input type="text" placeholder="Country"
                                                class="form-control margin-bottom b_input" name="country"
                                                id="mcustomer_country">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="PostBox"
                                                class="form-control margin-bottom b_input" name="postbox" id="postbox">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                                    <div class="form-group row">

                                        <div class="input-group mt-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="customer1"
                                                    id="copy_address">
                                                <label class="custom-control-label"
                                                    for="copy_address"><?php echo $this->lang->line('Same As Billing') ?></label>
                                            </div>

                                        </div>

                                        <div class="col-sm-10 text-info">
                                            <?php echo $this->lang->line("leave Shipping Address") ?>
                                        </div>
                                    </div>

                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="name_s"><?php echo $this->lang->line('Name') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Name"
                                                class="form-control margin-bottom b_input" name="name_s"
                                                id="mcustomer_name_s">
                                        </div>
                                    </div>


                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="phone_s"><?php echo $this->lang->line('Phone') ?></label>

                                        <div class="col-sm-8">
                                            <input type="number"  pattern="[0-9]*" inputmode="numeric"  placeholder="phone"
                                                class="form-control margin-bottom b_input" name="phone_s"
                                                id="mcustomer_phone_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label" for="email_s">Email</label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="email"
                                                class="form-control margin-bottom b_input" name="email_s"
                                                id="mcustomer_email_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="address"><?php echo $this->lang->line('Address') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="address"
                                                class="form-control margin-bottom b_input" name="address_s"
                                                id="mcustomer_address1_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="city_s"><?php echo $this->lang->line('City') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="city"
                                                class="form-control margin-bottom b_input" name="city_s"
                                                id="mcustomer_city_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="region_s"><?php echo $this->lang->line('Region') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Region"
                                                class="form-control margin-bottom b_input" name="region_s"
                                                id="region_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="country_s"><?php echo $this->lang->line('Country') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Country"
                                                class="form-control margin-bottom b_input" name="country_s"
                                                id="mcustomer_country_s">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('PostBox') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="PostBox"
                                                class="form-control margin-bottom b_input" name="postbox_s"
                                                id="postbox_s">
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab3" role="tabpanel" aria-labelledby="base-tab3">
                                    <div class="form-group row"><label class="col-sm-2 col-form-label"
                                            for="Discount"><?php echo $this->lang->line('Discount') ?> </label>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Custom Discount"
                                                class="form-control margin-bottom b_input" name="discount">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="taxid"><?php echo $this->lang->line('TAX') ?> ID</label>

                                        <div class="col-sm-6">
                                            <input type="text" placeholder="TAX ID"
                                                class="form-control margin-bottom b_input" name="taxid">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="docid"><?php echo $this->lang->line('Document') ?> ID</label>

                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Document ID"
                                                class="form-control margin-bottom b_input" name="docid">
                                        </div>
                                    </div>
                                    <div class="form-group row"><label class="col-sm-2 col-form-label"
                                            for="c_field"><?php echo $this->lang->line('Extra') ?> </label>
                                        <div class="col-sm-6">
                                            <input type="text" placeholder="Custom Field"
                                                class="form-control margin-bottom b_input" name="c_field">
                                        </div>
                                    </div>



                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="customergroup"><?php echo $this->lang->line('Customer group') ?></label>

                                        <div class="col-sm-6">
                                            <select name="customergroup" class="form-control b_input">
                                                <?php

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

                                        <label class="col-sm-2 col-form-label" for="currency">Language</label>

                                        <div class="col-sm-6">
                                            <select name="language" class="form-control b_input">

                                                <?php

                                                echo $langs;
                                                ?>

                                            </select>
                                        </div>
                                    </div>
                                    <?php     if ($this->aauth->premission(39)) {
										?>
										
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="currency"><?php echo $this->lang->line('customer_login') ?></label>

                                <div class="col-sm-8">
                                    <select name="c_login" class="form-control b_input">

                                        <option value="1"><?php echo $this->lang->line('Yes') ?></option>
                                        <option value="0"><?php echo $this->lang->line('No') ?></option>

                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="password_c"><?php echo $this->lang->line('New Password') ?></label>

                                <div class="col-sm-8">
                                    <input type="text" placeholder="Leave blank for auto generation"
                                        class="form-control margin-bottom b_input" name="password_c" id="password_c">
                                </div>
                            </div>                                </div>

                            <?php
																	
}
									?>

                                <div class="tab-pane show" id="tab4" role="tabpanel" aria-labelledby="base-tab4">

                                    <?php
                                    foreach ($custom_fields as $row) {
                                        if ($row['f_type'] == 'text') { ?>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label" for="docid"><?= $row['name'] ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="<?= $row['placeholder'] ?>"
                                                class="form-control margin-bottom  <?= $row['other'] ?>"
                                                name="custom[<?= $row['id'] ?>]">
                                        </div>
                                    </div>


                                    <?php }
                                    }
                                    ?>

                                </div>

                                <div id="mybutton">
                                    <input type="submit" id=""
                                        class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                        value="<?php echo $this->lang->line('Add customer') ?>"
                                        data-loading-text="Adding...">
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
        <input type="hidden" value="customers/addcustomer" id="action-url">
        </form>
    </div>
</div>
</div>

<script>
function getpassportDetails(val) {
    if (val == "foreign") {
        $("#foreign_content").show();
        //$("#card_body").hide();
        $("#tab_content").hide();
        $("#tab_list").hide();

    } else {
        $("#foreign_content").hide();
        //$("#card_body").hide();
        $("#tab_content").show();
        $("#tab_list").show();
    }
    //alert(val);
}
</script>


<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAMWSr2YSC6925JdAvbRyfjaiRsF8rPxA4&libraries=places"></script>

<script>
var input = document.getElementById('mcustomer_address1');
var autocomplete = new google.maps.places.Autocomplete(input);
google.maps.event.addListener(autocomplete, 'place_changed', function() {
    var place = autocomplete.getPlace();
    // Access the address components
    var addressComponents = place.address_components;

    // Initialize variables to store the address details
    var city, region, country, postalCode = '';

    // Iterate over the address components to extract desired parameters
    for (var i = 0; i < addressComponents.length; i++) {
        var component = addressComponents[i];
        var componentType = component.types[0];

        // Check for the desired parameters (city, region, country, postbox)
        if (componentType === 'locality') {
            city = component.long_name;
        }
        if (componentType === 'administrative_area_level_1') {
            region = component.long_name;
        }
        if (componentType === 'country') {
            country = component.long_name;
        }
        if (componentType === 'postal_code' || componentType === 'postal_code_prefix' || componentType ===
            'postal_code_suffix') {
            postalCode = component.long_name;
        }
    }

    if (city != '' && city != 'undefined') {
        $('#mcustomer_city').val(city)
    }

    if (region != '' && region != 'undefined') {
        $('#region').val(region)
    }
    if (country != '' && country != 'undefined') {
        $('#mcustomer_country').val(country)
    }
    if (postalCode != '' && postalCode != 'undefined') {
        $('#postbox').val(postalCode)
    }


});
</script>

<script>
var input1 = document.getElementById('mcustomer_address1_s');
var autocomplete1 = new google.maps.places.Autocomplete(input1);
google.maps.event.addListener(autocomplete1, 'place_changed', function() {
    var place1 = autocomplete1.getPlace();
    // Access the address components
    var addressComponents1 = place1.address_components;

    // Initialize variables to store the address details
    var city1, region1, country1, postalCode1 = '';

    // Iterate over the address components to extract desired parameters
    for (var i = 0; i < addressComponents1.length; i++) {
        var component1 = addressComponents1[i];
        var componentType1 = component1.types[0];

        // Check for the desired parameters (city, region, country, postbox)
        if (componentType1 === 'locality') {
            city1 = component1.long_name;
        }
        if (componentType1 === 'administrative_area_level_1') {
            region1 = component1.long_name;
        }
        if (componentType1 === 'country') {
            country1 = component1.long_name;
        }
        if (componentType1 === 'postal_code' || componentType1 === 'postal_code_prefix' || componentType1 ===
            'postal_code_suffix') {
            postalCode1 = component1.long_name;
        }
    }

    if (city1 != '' && city1 != 'undefined') {
        $('#mcustomer_city_s').val(city1)
    }

    if (region1 != '' && region1 != 'undefined') {
        $('#region_s').val(region1)
    }
    if (country1 != '' && country1 != 'undefined') {
        $('#mcustomer_country_s').val(country1)
    }
    if (postalCode1 != '' && postalCode1 != 'undefined') {
        $('#postbox_s').val(postalCode1)
    }


});





var input2 = document.getElementById('international_c_address');
var autocomplete2 = new google.maps.places.Autocomplete(input2);
</script>

<script>
$("body").on("change", "#mcustomer_email", function(e) {
    e.preventDefault();

    var email_id = $(this).val();
    if (email_id) {
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email_id))) {
            $(this).parent().addClass("has-error");
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("#notify .message").html("<strong>Error</strong>: Please Enter Valid Email Id...!!!");
            $("html, body").scrollTop($("body").offset().top);
            $(this).focus();
        } else {
            $(this).parent().removeClass("has-error");
            $("#notify").fadeOut();
            $("#notify .message").html("");

        }

    }

});

$("body").on("change", "#mcustomer_email_s", function(e) {
    e.preventDefault();

    var email_id = $(this).val();
    if (email_id) {
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email_id))) {
            $(this).parent().addClass("has-error");
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("#notify .message").html("<strong>Error</strong>: Please Enter Valid Email Id...!!!");
            $("html, body").scrollTop($("body").offset().top);
            $(this).focus();
        } else {
            $(this).parent().removeClass("has-error");
            $("#notify").fadeOut();
            $("#notify .message").html("");

        }


    }

});


$("body").on("change", "#international_email_id", function(e) {
    e.preventDefault();

    var email_id = $(this).val();
    if (email_id) {
        if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email_id))) {
            $(this).parent().addClass("has-error");
            $("#c_body").html('<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>');
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("#notify .message").html("<strong>Error</strong>: Please Enter Valid Email Id...!!!");
            $("html, body").scrollTop($("body").offset().top);
            $(this).focus();
        } else {
            $(this).parent().removeClass("has-error");
            $("#notify").fadeOut();
            $("#notify .message").html("");

        }


    }

});

   // $('#submitadd').click(function() {
	   function  validateForm(e){
        var company_name = document.getElementById('company_name').value;
		 var company = document.getElementById('company').value;
		 $("#company_name").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".company_name_error").text("this field is required");
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
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
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#international_c_address").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".address_error").text("this field is required");
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#international_c_address").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".address_error").text("this field is required");
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
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
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
					        e.preventDefault();

                }
                else {
                      
                    // If it is not blank.
                    $(this).css('border', 'solid 2px green');    
								

                }    
            }) .trigger("focusout");

$("#international_email_id").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".email_error").text("this field is required");
					$('input:radio[name=chooseradio]').val(['foreign']);
$("#foreign_content").css("display", "block");
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

$("#language").focusout(function() { 
                if($(this).val()=='') { 
                    $(this).css('border', 'solid 2px red'); 
					$(".language_error").text("this field is required");
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