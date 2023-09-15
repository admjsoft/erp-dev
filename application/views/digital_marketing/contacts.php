<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Contacts<?php // echo $this->lang->line('Peppol Invoices') ?><a
                    href="<?php echo base_url('digitalmarketing/contact_create'); ?>"
                    class="btn btn-primary btn-sm rounded ml-2">
                    <?php echo $this->lang->line('Add New Contact'); ?></a></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li> <a href="#save_to_contacts" data-toggle="modal" data-remote="false"
                            class="btn btn-info btn-sm rounded multi_assign_button" style="display:none;"
                            data-lang="<?php echo $this->lang->line('Save To List') ?>"> <span
                                class="fa fa-save"></span>
                            <?php echo $this->lang->line('Save To List') ?></a></li>
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

                <table id="th_vendors" class="table table-striped table-bordered zero-configuration ">
                    <thead>
                        <tr>
                            <th><?php echo "#";//$this->lang->line('No') ?></th>
                            <th><?php echo $this->lang->line('First Name'); ?></th>
                            <th><?php echo $this->lang->line('Last Name'); ?></th>
                            <th><?php echo $this->lang->line('Email'); ?></th>
                            <th><?php echo $this->lang->line('Sms'); ?></th>
                            <th><?php echo $this->lang->line('Whatsapp'); ?></th>
                            <th class="no-sort"><?php echo $this->lang->line('Settings') ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php if(!empty($contacts)){ $c=1; foreach($contacts as $contact){ ?>
                        <tr>
                            <td><?php // echo $c;  ?> <input type="checkbox" name="cust" class="checkbox"
                                    fetchId="<?php echo $contact['id']; ?>"
                                    value="<?php echo $contact['first_name']; ?>"> </td>
                            <td><?php echo $contact['first_name']; ?></td>
                            <td><?php echo $contact['last_name']; ?></td>
                            <td><?php echo $contact['email']; ?></td>
                            <td><?php echo $contact['sms'];  ?></td>
                            <td><?php echo $contact['whatsapp'];  ?></td>
                            <td class="no-sort">
                                <?php // if($campaign['status'] != 'draft') { ?>
                                <a href="<?php echo base_url('digitalmarketing/contact_edit/?' . http_build_query(array('id' => $contact['id']))); ?>"
                                    style="display: inline-block; padding:6px; margin-left:1px;"
                                    class="btn btn-success btn-xs"><i class="fa fa-edit"></i></a>
                                <a href="<?php echo base_url('digitalmarketing/contact_view/?' . http_build_query(array('id' => $contact['id']))); ?>"
                                    style="display: inline-block; padding:6px; margin-left:1px;"
                                    class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
                                <?php // } ?>
                                <a contact_id="<?php echo $contact['id']; ?>"
                                    style="display: inline-block; padding:6px; margin-left:1px;"
                                    class="btn btn-danger btn-xs vendor_delete"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php $c++; }} ?>

                    </tbody>
                    <tfoot>

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

                <h4 class="modal-title"><?php echo $this->lang->line('Delete Invoice') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <p><?php echo $this->lang->line('delete this invoice') ?> ?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="invoices/delete_i">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                    id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                    class="btn"><?php echo $this->lang->line('Cancel') ?></button>
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
                        <label for="shortnote">Please Select List</label>
                        <select class="form-control margin-bottom b_input required " name="Recepients"
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

    $('#th_vendors').DataTable();


    $(document).on('click', ".vendor_delete", function(e) {
        e.preventDefault();
        var contact_id = $(this).attr('contact_id');


        $.ajax({

            url: "<?php echo site_url('digitalmarketing/delete_contact') ?>",
            type: 'POST',
            dataType: 'json',
            data: {
                contact_id: contact_id
            },
            success: function(data) {
                alert(data.message);
                location.reload();
            },
            error: function(data) {
                //console.log(data);
                alert(data.message);
            }


        });


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

       
        $('#ContactAddIds').val(messaging_team_ids);

        //  return;
    });


    
    $('#save_to_contacts').on('click', '#save_to_contacts_selected', function(e) {
        e.preventDefault();

        if ($("#notify").length == 0) {
            $("#c_body").html(
                '<div id="notify" class="alert" style="display:none;"><a href="#" class="close" data-dismiss="alert">&times;</a><div class="message"></div></div>'
                );
        }
        jQuery.ajax({
            url: "<?php echo site_url('digitalmarketing/saveContactsToListSelected')?>",
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

/*
 draw_data();

    function draw_data(start_date = '', end_date = '') {
        $('#invoices').DataTable({
            'processing': true,
            'serverSide': true,
            'stateSave': true,
            <?php datatable_lang();?>
            responsive: true,
            'order': [],
            'ajax': {
                'url': "<?php echo site_url('invoices/peppol_invoices_ajax_list')?>",
                'type': 'POST',
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    start_date: start_date,
                    end_date: end_date
                }
            },
            'columnDefs': [
                {
                    'targets': [0],
                    'orderable': false,
                },
            ],
            dom: 'Blfrtip',
            buttons: [
                {
                    extend: 'excelHtml5',
                    footer: true,
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    }
                }
            ],
        });
    };

*/
</script>