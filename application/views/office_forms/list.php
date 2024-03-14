<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Office Forms') ?> <a href="#" data-target="#office_form_popup"
                    data-toggle="modal" class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?></a></h5>
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


                <div class="table-responsive">
                    <table id="acctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('File Name') ?></th>
                                <th><?php echo $this->lang->line('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($office_forms)) { $ii=1; foreach($office_forms as $row){ 
                            
                            ?>
                            <tr>
                                <td><?php echo $ii; ?></td>
                                <td><?php echo $row['form_name']; ?></td>
                                <td>
                                    <a href="<?php echo base_url("officeforms/view/".$row['id']); ?>"
                                        class='btn btn-success btn-sm'><i class='fa fa-eye'></i>
                                        <?php echo $this->lang->line('View'); ?></a>
                                    <?php /* ?>
                                    <a href="<?php echo base_url("officeforms/edit/".$row['id']); ?>"
                                        class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i>
                                        <?php echo $this->lang->line('Edit'); ?></a>
                                    <?php */ ?>
                                    <a href="<?php echo base_url("officeforms/download_office_form/".$row['id']); ?>"
                                        class='btn btn-info btn-sm'><i class='fa fa-download'></i>
                                        <?php echo $this->lang->line('Download'); ?></a>

                                    <a href='#' data-object-id="<?php echo $row['id']; ?>"
                                        class='btn btn-danger btn-sm delete-object' title='Delete'><i
                                            class='fa fa-trash'></i> <?php echo $this->lang->line('Delete'); ?></a>


                                </td>
                            </tr>

                            <?php $ii++; }} ?>

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="dashurl" value="accounts/account_stats">
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <h5>Connect and Share Across Multiple Social Platforms</h5>

                    <div class="mt-5">
                        <ul class="share_links list-inline">
                            <!-- <li class="bg_fb"><a href="#" class="share_icon" rel="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
            <li class="bg_insta"><a href="#" class="share_icon" rel="tooltip" title="Instagram"><i class="fa fa-instagram"></i></a></li> -->
                            <li class="bg_email"><a href="#" class="share_icon 
                            " data-target="#sendEmail" data-toggle="modal" rel="tooltip" title="Email"><i
                                        class="fa fa-envelope"></i></a>
                            </li>
                            <!-- <li class="bg_email"><a href="#" class="share_icon share__link  share__link--mail"
                                    rel="tooltip" title="Email"><i class="fa fa-envelope"></i></a></li> -->
                            <li class="bg_whatsapp"><a href="#" class="share_icon share__link share__link--whatsapp"
                                    rel="tooltip" title="Whatsapp"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>

                </div>

            </div>
        </div>
    </div>
    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Office Form') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('Delete Office Form') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="officeforms/delete">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>

    <div id="sendEmail" class="modal fade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line('Email'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div id="request">
                    <div id="ballsWaveG">
                        <div id="ballsWaveG_1" class="ballsWaveG"></div>
                        <div id="ballsWaveG_2" class="ballsWaveG"></div>
                        <div id="ballsWaveG_3" class="ballsWaveG"></div>
                        <div id="ballsWaveG_4" class="ballsWaveG"></div>
                        <div id="ballsWaveG_5" class="ballsWaveG"></div>
                        <div id="ballsWaveG_6" class="ballsWaveG"></div>
                        <div id="ballsWaveG_7" class="ballsWaveG"></div>
                        <div id="ballsWaveG_8" class="ballsWaveG"></div>
                    </div>
                </div>
                <div class="modal-body" id="emailbody" style="display: none;">
                    <form id="sendbill">
                        <div class="row">
                            <div class="col">
                                <div class="input-group">
                                    <div class="input-group-addon"><span class="icon-envelope-o"
                                            aria-hidden="true"></span>
                                    </div>
                                    <input type="text" class="form-control" id="ibm_mail_id" placeholder="Email"
                                        name="mailtoc" value="">
                                </div>

                            </div>

                        </div>


                        <div class="row">
                            <div class="col mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Customer Name'); ?></label>
                                <input type="text" id="ibm_client_name" class="form-control" name="customername"
                                    value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Subject'); ?></label>
                                <input type="text" class="form-control" name="subject" id="subject">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mb-1"><label
                                    for="shortnote"><?php echo $this->lang->line('Message'); ?></label>
                                <textarea name="text" class="summernote" id="contents" title="Contents"></textarea>
                            </div>
                        </div>

                        <input type="hidden" class="form-control" id="invoiceid" name="invoiceid" value="">
                        <input type="hidden" class="form-control" id="emailtype" value="digital_signature">
                        <input type="hidden" class="form-control" name="attach" value="">


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                    <button type="button" class="btn btn-primary"
                        id="sendM"><?php echo $this->lang->line('Send'); ?></button>
                </div>
            </div>
        </div>
    </div>


    <div id="office_form_popup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
            <form id="ds_form" action="<?php echo base_url('officeforms/create'); ?>" method="post"
                        enctype="multipart/form-data">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Add A Office Form') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hiddexn="true">&times;</span></button>
                </div>

                <!-- ... -->

                <div class="modal-body">
                    


                        <!-- Uploaded Documents -->
                        <div class=" mt-2">
                            <!-- Input type file -->
                            <div class="mb-1">
                                <label for="fileInput" class="form-label">From Name:</label>
                                <input type="name" name="form_name" class="form-control" id="form_name" required>
                            </div>
                            <div class="mb-1">
                                <label for="fileInput" class="form-label">Upload Document ( Pdf ):</label>
                                <input type="file" name="userfile" class="form-control" id="userfile" required>
                            </div>
                            <input type="hidden" name="sharing_count" class="form-control" id="sharing_count" required
                                value="1">

                            <!-- Submit button -->

                        </div>
                    
                </div>


                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <input type="hidden" id="contract_share_url" name="contract_share_url"
        value="<?php // echo base_url('contract/sales/1/2345654345'); ?>">
    <input type="hidden" id="contract_id" name="contract_id"
        value="<?php // echo base_url('contract/sales/1/2345654345'); ?>">


    <script type="text/javascript">
    $(document).ready(function() {

        //datatables
        $('#acctable').DataTable({
            'responsive': true
        });

    });
    </script>


    <script>
    $(document).ready(function() {
        $('#ds_form').submit(function(e) {

            //alert($(this).attr('action'));
            e.preventDefault();
            var formData = new FormData(this);

            // Check if at least one file is selected
            var fileInput = document.getElementById('userfile');
            if (fileInput.files.length === 0) {
                $('#validation_errors').html('Please select at least one file.').show();
                return;
            }

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    if (response.success) {
                        // Redirect to the success page
                        window.location.href = response.redirect_url;
                    } else {
                        // Display validation errors
                        $('#validation_errors').html(response.validation_errors).show();
                    }
                }
            });
            // // const page = document.getElementById('file-preview');
            // // var annotateMeta = page.getAnnotations().then(function (data) {
            // // console.log(data);
            // });
        });
    });
    </script>