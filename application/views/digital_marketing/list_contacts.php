<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">List Contacts<?php // echo $this->lang->line('Peppol Invoices') ?></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
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
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('First Name'); ?></th>
                        <th><?php echo $this->lang->line('Last Name'); ?></th>
                        <th><?php echo $this->lang->line('Email'); ?></th>
                        <th><?php echo $this->lang->line('Sms'); ?></th>
                        <th><?php echo $this->lang->line('Whatsapp'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        
                        <?php if(!empty($contacts)){ $c=1; foreach($contacts as $contact){ ?>
                            <tr>
                            <td><?php echo $c;  ?></td>
                            <td><?php echo $contact['first_name']; ?></td>
                            <td><?php echo $contact['last_name']; ?></td>
                            <td><?php echo $contact['email']; ?></td>
                            <td><?php echo $contact['sms'];  ?></td>
                            <td><?php echo $contact['whatsapp'];  ?></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        
        $('#th_vendors').DataTable();

        
        $(document).on('click', ".vendor_delete", function (e) {
        e.preventDefault();
       var contact_id = $(this).attr('contact_id');
       

        $.ajax({

        url: "<?php echo site_url('digitalmarketing/delete_contact') ?>",
        type: 'POST',
        dataType: 'json',
        data: {
            contact_id: contact_id
        },
        success: function (data) {
            alert(data.message);
            location.reload();
        },
        error: function(data) {
        //console.log(data);
        alert(data.message);
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