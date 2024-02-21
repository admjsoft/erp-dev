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

<p id="statusMsg"></p>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title p-1" style="background-color : #4DD5E7;">
                <?php echo $this->lang->line('Add New Task') ?>
            </h4>


            <!-- <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                </ul>
            </div> -->
        </div>
        <div class="card-body">
            <form method="post" class="form-horizontal" enctype="multipart/form-data"
                action="<?php echo base_url();?>/jobsheets/add_task">
                <div class="card" style="border : 1px solid #4DD5E7; ">

                    <div class="card-content">
                        <div class="card-body">
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">

                                    <div class="form-group row mt-1">
                                        <label class="col-sm-2 col-form-label"
                                            for="Location"><?php echo $this->lang->line('DO Number') ?></label>
                                        <div class="col-sm-8">


                                            <select id="priorityDropdown" class="form-control margin-bottom b_input"
                                                name="ex_do_number">
                                                <option value="">
                                                    <?php echo $this->lang->line('Please Select DO Number') ?></option>
                                                <?php if (!empty($do_orders)) {
                                                     foreach ($do_orders as $do_order) { ?>
                                                <option value="<?php echo $do_order['do_id']; ?>">
                                                    <?php echo $do_order['do_id']; ?></option>
                                                <?php }
                                                        } ?>
                                            </select>

                                            <input type="text" id="textBox"
                                                placeholder="<?php echo $this->lang->line('Please Enter DO Number') ?>"
                                                class="form-control margin-bottom b_input" style="display:none;"
                                                name="no_ex_do_number">

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="toggleCheckbox">
                                                <label class="form-check-label" for="toggleCheckbox">Select if There is
                                                    No DO Number</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row ">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Title') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" list="CloneTasksList" placeholder="Title"
                                                class="form-control margin-bottom b_input required " name="title"
                                                id="title" required
                                                value="<?php if(!empty($do_details)){ echo $do_details; } ?>">

                                            <datalist id="CloneTasksList">

                                            </datalist>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Description') ?></label>

                                        <div class="col-sm-8">
                                            <!-- <input type="text" placeholder="Description"
                                                   class="form-control margin-bottom b_input" name="description"> -->
                                            <textarea placeholder="Description"
                                                class="form-control margin-bottom b_input" name="description"
                                                required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-2"><label for="cst"
                                                class="caption"><?php echo $this->lang->line('Search Client'); ?></label>
                                        </div>
                                        <div class="col-sm-8 frmSearch">
                                            <input type="text" class="form-control" name="cst" id="customer-box"
                                                placeholder="Enter Customer Name or Mobile Number to search"
                                                autocomplete="off"
                                                value="<?php if(!empty($invoice['name'])){ echo $invoice['name']; } ?>" />
                                            <div id="customer-box-result"></div>
                                        </div>
                                        <div class="col-sm-2" id="job_sheet_add_client_btn" style="display:none;">
                                            <a href='#' class="btn btn-primary btn-sm round" data-toggle="modal"
                                                data-target="#addCustomer">
                                                <?php echo $this->lang->line('Add Client') ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="cname"><?php echo $this->lang->line('Customer') ?></label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Customer Name" id="customer_name"
                                                class="form-control margin-bottom b_input" name="cname" required>
                                            <input type="hidden" id="customer_id" class="form-control" name="cid">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="Location"><?php echo $this->lang->line('Location') ?></label>
                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Location" id="customer_address"
                                                class="form-control margin-bottom b_input" name="location" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="Location"><?php echo $this->lang->line('Priority') ?></label>
                                        <div class="col-sm-8">
                                            <select id="priorityDropdown" class="form-control margin-bottom b_input"
                                                required name="job_priority">
                                                <option value="low"><?php echo $this->lang->line('Low') ?></option>
                                                <option value="medium"><?php echo $this->lang->line('Medium') ?>
                                                </option>
                                                <option value="high"><?php echo $this->lang->line('High') ?></option>
                                                <option value="urgent"><?php echo $this->lang->line('Urgent') ?>
                                                </option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="Location"><?php echo $this->lang->line('Date') ?></label>
                                        <div class="col-sm-3">
                                            <input type="date" placeholder="date" id="date" class="form-control"
                                                min="<?php echo date("Y-m-d"); ?>" value="<?php echo date("Y-m-d"); ?>"
                                                name="date" required>
                                        </div>
                                        <label class="col-sm-2 col-form-label"
                                            for="Location"><?php echo $this->lang->line('Time') ?></label>
                                        <div class="col-sm-3">
                                            <input type="time" value="<?php echo date("H:i:s"); ?>" placeholder="time"
                                                id="time" class="form-control" name="time" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="phone"><?php echo $this->lang->line('SLA Time Frame') ?></label>
                                        <div class="col-sm-8">
                                            <ul class="sla-option">
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a2" name="timeFrame" value="2" checked>
                                                        <label for="a2"> 2hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a4" name="timeFrame" value="4">
                                                        <label for="a4"> 4hrs</label>
                                                    </li>

                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a6" name="timeFrame" value="6">
                                                        <label for="a6"> 6hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a8" name="timeFrame" value="8">
                                                        <label for="a8"> 8hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a12" name="timeFrame" value="12">
                                                        <label for="a12"> 12hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a24" name="timeFrame" value="24">
                                                        <label for="a24"> 24hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a72" name="timeFrame" value="72">
                                                        <label for="a72"> 72hrs</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a1d" name="timeFrame" value="24">
                                                        <label for="a1d"> 1 Day</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a2d" name="timeFrame" value="48">
                                                        <label for="a2d"> 2 Days</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a3d" name="timeFrame" value="72">
                                                        <label for="a3d"> 3 Days</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a1w" name="timeFrame" value="168">
                                                        <label for="a1w"> 1 Week</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a2w" name="timeFrame" value="336">
                                                        <label for="a2w"> 2 Weeks</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a3w" name="timeFrame" value="504">
                                                        <label for="a3w">3 Weeks</label>
                                                    </li>
                                                </div>
                                                <div class="col-sm-3">
                                                    <li>
                                                        <input type="radio" id="a4w" name="timeFrame" value="672">
                                                        <label for="a4w"> 4 Weeks</label>
                                                    </li>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="userfile"><?php echo $this->lang->line('Document') ?></label>
                                        <div class="col-sm-8">
                                            <?php /* ?><input id="userfile" class="form-control" type="file"
                                                name="userfile"
                                                accept="application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" />
                                            <?php */ ?>
                                            <input type="file" name="userfile" id="userfile"
                                                accept=".docx, .docs, .txt, .pdf, .xls, .xlsx, .png, .jpg, .jpeg, .gif" />

                                            (docx, docs, txt, pdf, xls, png, jpg, gif)
                                        </div>
                                    </div>
                                    <!-- <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                               for="name"><?php // echo $this->lang->line('Invoice') ?></label>
                                        <div class="col-sm-8">
                                            <label class="col-form-label">
                                            <input type="checkbox" placeholder="invoice" id="invoice"
                                                   class="margin-bottom  " name="invoice">
                                                   </label>
                                        </div>
                                    </div> -->
                                    <input type="hidden" placeholder="invoice" id="invoice" class="margin-bottom"
                                        name="invoice" value="">
                                </div>
                                <div id="mybutton" style="display: flex; justify-content: center;">
                                    <input type="hidden" value="jobsheets/add_task" id="action-url">
                                    <input type="submit"
                                        class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                        value="<?php echo $this->lang->line('Create Task') ?>"
                                        data-loading-text="Creating...">


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="addCustomer" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal">
                <!-- Modal Header -->
                <div class="modal-header bg-gradient-directional-purple white">
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Add Customer'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="alert alert-dismissible fade show " role="alert">
                        <!-- <p id="statusMsg"></p> -->
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <input type="hidden" name="mcustomer_id" id="mcustomer_id" value="0">

                    <div class="row">
                        <div class="col-sm-6">
                            <h5><?php echo $this->lang->line('Billing Address') ?></h5>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name" class="form-control margin-bottom"
                                        id="mcustomer_name" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="phone"><?php echo $this->lang->line('Phone') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone" class="form-control margin-bottom"
                                        name="phone" id="mcustomer_phone">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                    for="email"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-10">
                                    <input type="email" placeholder="Email" class="form-control margin-bottom crequired"
                                        name="email" id="mcustomer_email">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="address"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address" class="form-control margin-bottom "
                                        name="address" id="mcustomer_address1">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label" for="address"></label>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="City" class="form-control margin-bottom" name="city"
                                        id="mcustomer_city">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="Region" id="region"
                                        class="form-control margin-bottom" name="region">
                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label" for="address"></label>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="Country" class="form-control margin-bottom"
                                        name="country" id="mcustomer_country">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="PostBox" id="postbox"
                                        class="form-control margin-bottom" name="postbox">
                                </div>
                            </div>

                            <!-- <div class="form-group row">

                                <div class="col-sm-6">
                                    <input type="text" placeholder="Company"
                                           class="form-control margin-bottom" name="company">
                                </div>

                                <div class="col-sm-6">
                                    <input type="hidden" placeholder="TAX ID"
                                           class="form-control margin-bottom" name="taxid" id="mcustomer_city">
                                </div>


                            </div> -->
                            <input type="hidden" placeholder="TAX ID" class="form-control margin-bottom" name="taxid"
                                id="mcustomer_city">
                            <input type="hidden" placeholder="Company" class="form-control margin-bottom"
                                name="company">
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label  col-form-label-sm"
                                    for="customergroup"><?php echo $this->lang->line('Group') ?></label>

                                <div class="col-sm-10">
                                    <select name="customergroup" class="form-control form-control">
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


                        </div>

                        <!-- shipping -->
                        <div class="col-sm-6">
                            <h5><?php echo $this->lang->line('Shipping Address') ?></h5>
                            <div class="form-group row">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="customer1s"
                                        id="copy_address">
                                    <label class="custom-control-label"
                                        for="copy_address"><?php echo $this->lang->line('Same As Billing') ?></label>
                                </div>


                                <div class="col-sm-10">
                                    <?php echo $this->lang->line("leave Shipping Address") ?>
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="name_s"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name" class="form-control margin-bottom"
                                        id="mcustomer_name_s" name="name_s" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="phone_s"><?php echo $this->lang->line('Phone') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Phone" class="form-control margin-bottom"
                                        name="phone_s" id="mcustomer_phone_s">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="email_s"><?php echo $this->lang->line('Email') ?></label>

                                <div class="col-sm-10">
                                    <input type="email" placeholder="Email" class="form-control margin-bottom"
                                        name="email_s" id="mcustomer_email_s">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="address_s"><?php echo $this->lang->line('Address') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Address" class="form-control margin-bottom "
                                        name="address_s" id="mcustomer_address1_s">
                                </div>
                            </div>
                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label" for="address_s"></label>

                                <div class="col-sm-5">
                                    <input type="text" placeholder="City" class="form-control margin-bottom"
                                        name="city_s" id="mcustomer_city_s">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="Region" id="region_s"
                                        class="form-control margin-bottom" name="region_s">
                                </div>

                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label" for="address_s"></label>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="Country" class="form-control margin-bottom"
                                        name="country_s" id="mcustomer_country_s">
                                </div>
                                <div class="col-sm-5">
                                    <input type="text" placeholder="PostBox" id="postbox_s"
                                        class="form-control margin-bottom" name="postbox_s">
                                </div>
                            </div>


                        </div>

                    </div>
                    <?php
                                   if(is_array($custom_fields_c)){
                                    foreach ($custom_fields_c as $row) {
                                        if ($row['f_type'] == 'text') { ?>
                    <div class="form-group row">

                        <label class="col-sm-1 col-form-label" for="docid"><?= $row['name'] ?></label>

                        <div class="col-sm-5">
                            <input type="text" placeholder="<?= $row['placeholder'] ?>"
                                class="form-control margin-bottom b_input" name="custom[<?= $row['id'] ?>]">
                        </div>
                    </div>


                    <?php }
                                    }
                                   }
                                    ?>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="mclient_add" class="btn btn-primary submitBtn" value="ADD" />
                </div>
            </form>
        </div>
    </div>
</div>
<script>
(function($) {
    $.fn.serializeFiles = function() {
        var form = $(this),
            formData = new FormData(),
            formParams = form.serializeArray();

        $.each(form.find('input[type="file"]'), function(i, tag) {
            $.each($(tag)[0].files, function(i, file) {
                formData.append(tag.name, file);
            });
        });

        $.each(formParams, function(i, val) {
            formData.append(val.name, val.value);
        });

        return formData;
    };
})(jQuery);


$("body").on("keyup", "#title", function() {


    var key = $(this).val();

    var fetchurl = "<?php echo site_url('jobsheets/GetTaskListDetails'); ?>";
    var formData = {
        "key": key
    };

    $.ajax({
        type: "POST",
        dataType: "json",
        url: fetchurl,
        data: formData,
        // async: false,
        cache: false,
        success: function(data) {
            if (data.status) {
                $("#CloneTasksList").html('');
                $("#CloneTasksList").html(data.html);

            } else {


            }

        }
    });

});

$(document).ready(function() {
    // Trigger keyup event


    // Check if the value is not empty
    if ($('#customer-box').val() !== '') {
        var input = $('#customer-box');

        // Set focus on the input
        input.focus();

        // Set the cursor position to the end of the input
        var valueLength = input.val().length;
        input[0].setSelectionRange(valueLength, valueLength);

        $.ajax({
            type: "GET",
            url: baseurl + 'search_products/csearch',
            data: 'keyword=' + $('#customer-box').val() + '&' + crsf_token + '=' + crsf_hash,
            beforeSend: function() {
                $("#customer-box").css("background", "#FFF url(" + baseurl +
                    "assets/custom/load-ring.gif) no-repeat 165px");
            },
            success: function(data) {

                if (data) {

                    // Parse the server response
                    var parsedResponse = $.parseHTML(data);

                    // Check if there is an <li> tag inside <ol> tag
                    if ($(parsedResponse).find('li').length > 0) {
                        $("#customer-box-result").show();
                        $("#customer-box-result").html(data);
                        $("#customer-box").css("background", "none");
                        $('#job_sheet_add_client_btn').hide();
                    } else {
                        $("#customer-box").css("background", "none");
                        $("#customer-box-result").hide();
                        $('#job_sheet_add_client_btn').show();

                    }

                } else {
                    $("#customer-box").css("background", "none");
                    $("#customer-box-result").hide();
                    $('#job_sheet_add_client_btn').show();
                }


            }
        });

    }
});
</script>
<script>
document.getElementById('toggleCheckbox').addEventListener('change', function() {
    var selectBox = document.getElementById('priorityDropdown');
    var textBox = document.getElementById('textBox');

    if (this.checked) {
        // Checkbox is checked, hide select box, show text box
        selectBox.style.display = 'none';
        textBox.style.display = 'block';
    } else {
        // Checkbox is unchecked, show select box, hide text box
        selectBox.style.display = 'block';
        textBox.style.display = 'none';
    }
});
</script>