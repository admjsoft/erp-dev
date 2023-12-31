<?php
$due = false;
if ($this->input->get('due')) {
    $due = true;
} ?>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><a href="<?php echo base_url('customers') ?>" class="mr-5">
            <?php echo $this->lang->line('Customers'); ?></a></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li> <a href="#sendMail" data-toggle="modal" data-remote="false"
                            class="btn btn-info btn-sm rounded multi_assign_button" style="display:none;"
                            data-lang="<?php echo $this->lang->line('Email Selected') ?>"> <span
                                class="fa fa-envelope"></span>
                            <?php echo $this->lang->line('Email Selected') ?></a></li>
                    <li> <a href="#sendSmsS" data-toggle="modal" data-remote="false"
                            class="btn btn-success btn-sm rounded multi_assign_button" style="display:none;"
                            data-lang="<?php echo $this->lang->line('SMS Selected') ?>"> <span
                                class="fa fa-mobile"></span>
                            <?php echo $this->lang->line('SMS Selected') ?></a></li>
                    <li><a href="#sendWhatsApp" data-toggle="modal" data-remote="false"
                            class="btn btn-danger btn-sm rounded multi_assign_button" style="display:none;"
                            data-lang="<?php echo "WhatsApp Selected"; //  $this->lang->line('Delete Selected') ?>">
                            <span class="fa fa-mobile"></span>
                            <?php echo  "WhatsApp Selected";  //$this->lang->line('Delete Selected') ?></a></li>
                    <li><a href="#save_to_contacts" data-toggle="modal" data-remote="false"
                    class="btn btn-primary btn-sm rounded multi_assign_button" style="display:none;"
                    data-lang="<?php echo "Save to Contacts"; //  $this->lang->line('Delete Selected') ?>">
                    <span class="fa fa-save"></span>
                    <?php echo  "Save to Contacts";  //$this->lang->line('Delete Selected') ?></a></li>

                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">

                <table id="clientstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Name') ?></th>
                            <th><?php echo $this->lang->line('Email') ?></th>
                            <th><?php echo $this->lang->line('Phone') ?></th>
                            <th><?php echo $this->lang->line('Address') ?></th>
                            <th><?php echo $this->lang->line('Client Type') ?></th>


                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>

<div id="delete_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Delete Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('are_you_sure_delete_customer') ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" class="form-control" id="object-id" name="deleteid" value="0">
                <input type="hidden" id="action-url" value="customers/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                    id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="sendMail" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Email Selected') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="sendmail_form"><input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">



                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Subject') ?></label>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="text" class="summernote" id="contents" title="Contents"></textarea>
                        </div>
                    </div>
                    <input type="hidden" id="EmailMultipleTaskAssignIds" name="EmailMultipleTaskAssignIds" value="" />



                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"
                    id="sendNowSelected"><?php echo $this->lang->line('Send') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="sendSmsS" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('SMS Selected') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="sendsms_form"><input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">



                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="message" class="form-control" rows="3" cols="60"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="SmsMultipleTaskAssignIds" name="SmsMultipleTaskAssignIds" value="" />

                    <input type="hidden" id="action-url" value="communication/send_general">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"
                    id="sendSmsSelected"><?php echo $this->lang->line('Send') ?></button>
            </div>
        </div>
    </div>

</div>

<div id="sendWhatsApp" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo "WhatsApp Selected"; // $this->lang->line('SMS Selected') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="sendwhatsapp_form"><input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">



                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="message" class="form-control" rows="3" cols="60"></textarea>
                        </div>
                    </div>

                    <input type="hidden" id="WhatsAppMultipleTaskAssignIds" name="WhatsAppMultipleTaskAssignIds"
                        value="" />

                    <input type="hidden" id="action-url" value="communication/send_general">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"
                    id="sendWhatsAppSelected"><?php echo $this->lang->line('Send') ?></button>
            </div>
        </div>
    </div>

</div>


<div id="save_to_contacts" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo "Save to Contacts"; // $this->lang->line('SMS Selected') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="save_to_contacts_form"><input type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">



                    <div class="row">
                        <div class="col mb-1">
                        <label for="shortnote">Please Select List for Contacts</label>
                        <select multiple class="form-control margin-bottom b_input required " name="Recepients[]"
                                                   id="recepients"  >
                        <?php if(!empty($list_ids['lists'])) { foreach($list_ids['lists'] as $list) { ?>
                        <option value='<?php echo $list['id']; ?>' ><?php echo $list['name']; ?></option>
                        <?php } } ?>
                        </select>
                        </div>
                    </div>

                    <input type="hidden" id="ContactAddIds" name="ContactAddIds"
                        value="" />

                    <input type="hidden" id="action-url" value="communication/send_general">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"
                    id="save_to_contacts_selected"><?php echo $this->lang->line('Send') ?></button>
            </div>
        </div>
    </div>

</div>



<div id="save_to_contacts_response" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo "Save to Contacts "; // $this->lang->line('SMS Selected') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body" id="save_to_contacts_response_body">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
            </div>
        </div>
    </div>

</div>


<script type="text/javascript">
$(document).ready(function() {
    $('.summernote').summernote({
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['fullscreen', ['fullscreen']],
            ['codeview', ['codeview']]
        ]
    });

    $('#clientstable').DataTable({
        'processing': true,
        'serverSide': true,
        <?php datatable_lang();?>
        responsive: true,
        'order': [],
        'ajax': {
            'url': "<?php echo site_url('digitalmarketing/load_list')?>",
            'type': 'POST'
        },
        'columnDefs': [{
            'targets': [0],
            'orderable': false,
        }, ],
        dom: 'Blfrtip',
        buttons: [{
            extend: 'excelHtml5',
            footer: true,
            exportOptions: {
                columns: [1, 2, 3, 4, 5]
            }
        }],
    });



    var messaging_team_ids = new Array();

    $("body").on("change", "input[type=checkbox][name=cust]", function() {
        event.preventDefault();

        var fetchId = $(this).attr("fetchId");

        if (!messaging_team_ids.includes(fetchId)) {
            messaging_team_ids.push(fetchId);

        } else {
            var index = messaging_team_ids.indexOf(fetchId);
            if (index >= 0) {
                messaging_team_ids.splice(index, 1);
            }
        }
        //alert(messaging_team_ids);
        if (messaging_team_ids.length > 0) {
            $('.multi_assign_button').show();
        } else {
            $('.multi_assign_button').hide();
        }

        $('#EmailMultipleTaskAssignIds').val(messaging_team_ids);
        $('#SmsMultipleTaskAssignIds').val(messaging_team_ids);
        $('#WhatsAppMultipleTaskAssignIds').val(messaging_team_ids);
        $('#ContactAddIds').val(messaging_team_ids);

        //  return;
    });


    //uni sender
    $('#sendMail').on('click', '#sendNowSelected', function(e) {
        e.preventDefault();
        $("#sendMail").modal('hide');
        if ($("#notify").length == 0) {
            $("#c_body").html(
                '<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>'
                );
        }
        jQuery.ajax({
            url: "<?php echo site_url('digitalmarketing/sendSelected')?>",
            type: 'POST',
            data: $("input[name='cust[]']:checked").serialize() + '&' + $("#sendmail_form")
                .serialize(),
            dataType: 'json',
            success: function(data) {
                $("#sendMail").modal('hide');
                var form = document.getElementById("sendmail_form");
                // Reset the form
                form.reset();
                messaging_team_ids.splice(0);
                const checkboxes = document.querySelectorAll(
                    'input[type="checkbox"][name="cust"]');
                // Loop through each checkbox and set checked to false
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data
                    .message);
                $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                $("html, body").animate({
                    scrollTop: $('#notify').offset().top
                }, 1000);
            }
        });
    });

    $('#sendSmsS').on('click', '#sendSmsSelected', function(e) {
        e.preventDefault();

        if ($("#notify").length == 0) {
            $("#c_body").html(
                '<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>'
                );
        }

        if (messaging_team_ids.length == 1) {
            jQuery.ajax({
                url: "<?php echo site_url('digitalmarketing/sendSmsSelected')?>",
                type: 'POST',
                data: $("input[name='cust[]']:checked").serialize() + '&' + $("#sendsms_form")
                    .serialize(),
                dataType: 'json',
                success: function(data) {
                    $("#sendSmsS").modal('hide');
                    var form = document.getElementById("sendsms_form");
                    // Reset the form
                    form.reset();
                    messaging_team_ids.splice(0);
                    const checkboxes = document.querySelectorAll(
                        'input[type="checkbox"][name="cust"]');
                    // Loop through each checkbox and set checked to false
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = false;
                    });
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " +
                        data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success")
                        .fadeIn();
                    $("html, body").animate({
                        scrollTop: $('#notify').offset().top
                    }, 1000);
                }
            });
        } else {
            alert('Please Select Only One Contact');
        }

    });



    $('#sendWhatsApp').on('click', '#sendWhatsAppSelected', function(e) {
        e.preventDefault();

        if ($("#notify").length == 0) {
            $("#c_body").html(
                '<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>'
                );
        }
        jQuery.ajax({
            url: "<?php echo site_url('digitalmarketing/sendWhatsappSelected')?>",
            type: 'POST',
            data: $("input[name='cust[]']:checked").serialize() + '&' + $("#sendwhatsapp_form")
                .serialize(),
            dataType: 'json',
            success: function(data) {
                $("#sendWhatsApp").modal('hide');
                var form = document.getElementById("sendwhatsapp_form");
                // Reset the form
                form.reset();
                messaging_team_ids.splice(0);
                const checkboxes = document.querySelectorAll(
                    'input[type="checkbox"][name="cust"]');
                // Loop through each checkbox and set checked to false
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data
                    .message);
                $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                $("html, body").animate({
                    scrollTop: $('#notify').offset().top
                }, 1000);
            }
        });
    });



    $('#save_to_contacts').on('click', '#save_to_contacts_selected', function(e) {
        e.preventDefault();

        if ($("#notify").length == 0) {
            $("#c_body").html(
                '<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>'
                );
        }
        jQuery.ajax({
            url: "<?php echo site_url('digitalmarketing/saveContactsSelected')?>",
            type: 'POST',
            data: $("input[name='cust[]']:checked").serialize() + '&' + $("#save_to_contacts_form")
                .serialize(),
            dataType: 'json',
            success: function(data) {
                $("#save_to_contacts").modal('hide');
                var form = document.getElementById("save_to_contacts_form");
                // Reset the form
                form.reset();
                messaging_team_ids.splice(0);
                const checkboxes = document.querySelectorAll(
                    'input[type="checkbox"][name="cust"]');
                // Loop through each checkbox and set checked to false
                checkboxes.forEach(checkbox => {
                    checkbox.checked = false;
                });
                $('#save_to_contacts_response_body').html(data.message);
                $('#save_to_contacts_response').modal('show');
                
                // $("#notify .message").html("<strong>" + data.status + "</strong>: " + data
                //     .message);
                // $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                // $("html, body").animate({
                //     scrollTop: $('#notify').offset().top
                // }, 1000);
            }
        });
    });



});
</script>