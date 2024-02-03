<style>
.share_btn {
    font-size: 36px;
    cursor: pointer;
}

.share_links {
    list-style: none;
}

.share_links li {
    display: inline-block;
    background-color: black;
    margin: 15px;
    border-radius: 50%;
    background: #000;
}

.share_icon {
    color: white;
    display: table-cell;
    vertical-align: middle;
    text-align: center;
    text-decoration: none;
    font-size: 32px;
    height: 80px;
    width: 80px;

}

.share_links .bg_fb:hover {
    color: #fff;
    background: #3b5998;
}

.share_links .bg_insta:hover {
    color: #fff;
    background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);
}

.share_links .bg_whatsapp:hover {
    color: #fff;
    background: #25D366;
}

.share_links .bg_email:hover {
    color: #fff;
    background: radial-gradient(circle at 30% 107%, #4285F4 0%, #4285F4 5%, #34A853 45%, #FBBC05 60%, #EA4335 90%);

}

.share_links li:hover .share_icon {
    color: #fff;
}

/* Custom style for the highlight effect */
.sign__mode__item.active {
    border: 2px solid #ffc107;
    box-shadow: 0 0 10px rgba(255, 193, 7, 0.5);
    background-color: rgba(0, 0, 0, 0.05);
    /* Darker overlay */
}

.sign__mode__item img {
    height: 120px;
    /* Adjust the height as needed */
}

.share_links .
 {
    color: #fff;
    background: #4390a4 !important;
    border-radius:50px;

}

.share__link--whatsapp{
    color: #fff;
    background: #25D366 !important;
    border-radius:50px;
}
</style>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Digital Signature') ?> <a href="#" data-target="#signature_popup"
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
                                <th><?php echo $this->lang->line('Remaining Signatories') ?></th>
                                <th><?php echo $this->lang->line('Share') ?></th>
                                <th><?php echo $this->lang->line('Status') ?></th>
                                <th><?php echo $this->lang->line('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($digital_signatures)) { $ii=1; foreach($digital_signatures as $row){ 
                            $contract_id = $row['id'];
                            $share_link = $row['share_link'];
                            
                            ?>
                            <tr>
                                <td><?php echo $ii; ?></td>
                                <td><?php echo $row['file_name']; ?></td>
                                <td><?php echo ($row['sharing_count'] - $row['signings_count']); ?></td>
                                <td>
                                    <a href='<?php if($row['status'] != 'COMPLETED'){  echo $share_link; }else{ echo "javascript:void(0)";} ?>'
                                        contract_client_name=' '
                                        contract_title ='<?php echo $row['name']; ?>'
                                        contract_pic='<?php echo $row['pic']; ?>'
                                        contract_email_id='<?php echo $row['email']; ?>'
                                        contract_id='<?php echo $row['id']; ?>'
                                        class="btn btn-danger btn-sm <?php if($row['status'] != 'COMPLETED'){ echo "share-object"; } ?>"
                                        data-toggle="<?php if($row['status'] != 'COMPLETED'){ echo "modal"; } ?>"
                                        data-target="<?php if($row['status'] != 'COMPLETED'){ echo "#myModal"; } ?>"
                                        title='Share' <?php if($row['status'] != 'COMPLETED'){ echo "disbled"; }  ?>><i
                                            class='fa fa-share-alt'></i></a>
                                </td>
                                <td><?php echo $row['status']; ?></td>
                                <td>
                                    <a href="<?php echo base_url("digitalsignature/view/".$contract_id); ?>"
                                        class='btn btn-success btn-sm'><i class='fa fa-eye'></i>
                                        <?php echo $this->lang->line('View'); ?></a>&nbsp;
                                    <?php // if($row['status'] == 'PENDING'){ ?>
                                    <a href="<?php echo base_url("digitalsignature/edit/".$contract_id); ?>"
                                        class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i>
                                        <?php echo $this->lang->line('Edit'); ?></a>
                                    <?php // } ?>
                                    &nbsp;<a href='#' data-object-id="<?php echo $contract_id; ?>"
                                        class='btn btn-danger btn-sm delete-object' title='Delete'><i
                                            class='fa fa-trash'></i></a>


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
                            " data-target="#sendEmail"
                                    data-toggle="modal" rel="tooltip" title="Email"><i class="fa fa-envelope"></i></a>
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

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Digital Signature') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('Delete Digital Signature') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="digitalsignature/delete">
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


    <div id="signature_popup" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Add A Digital Signature') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hiddexn="true">&times;</span></button>
                </div>

                <!-- ... -->

                <div class="modal-body">
                    <form id="ds_form" action="digitalsignature/create" method="post" enctype="multipart/form-data">
                        <div class="row">
                            <!-- Single Signing -->
                            <div class="col-md-6">
                                <div class="sign__mode__item text-center border p-3 active" id="singleMode"
                                    data-action="singleMode" onclick="selectOption('singleMode', this)">
                                    <img src="<?php echo base_url('userfiles/company/'); ?>single.svg" class="img-fluid"
                                        alt="Single Signing">
                                    <button class="btn btn-primary mt-2"><?php echo $this->lang->line('Only me') ?></button>
                                    <small class="d-block"><?php echo $this->lang->line('Sign this document') ?></small>
                                </div>
                            </div>

                            <!-- Multiple Signings -->
                            <div class="col-md-6">
                                <div class="sign__mode__item text-center border p-3" id="multipleMode"
                                    data-action="multiMode" onclick="selectOption('multiMode', this)">
                                    <img src="<?php echo base_url('userfiles/company/'); ?>multiple.svg"
                                        class="img-fluid" alt="Multiple Signings">
                                    <button class="btn btn-success mt-2"><?php echo $this->lang->line('Several people') ?></button>
                                    <small class="d-block"><?php echo $this->lang->line('Invite others to sign') ?></small>
                                </div>
                            </div>
                        </div>

                        <!-- Uploaded Documents -->
                        <div class="text-center mt-3">
                            <!-- Input type file -->
                            <div class="mb-3">
                                <label for="fileInput" class="form-label"><?php echo $this->lang->line('Upload Document') ?> :</label>
                                <input type="file" name="userfile" class="form-control" id="userfile" required>
                            </div>
                            <input type="hidden" name="sharing_count" class="form-control" id="sharing_count" required
                                value="1">

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary"><?php echo $this->lang->line('Submit') ?></button>
                        </div>
                    </form>
                </div>

 
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
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


    //datatables
    $('.share-object').click(function() {
        
        var c_url = $(this).attr("href");
        var contract_id = $(this).attr("contract_id");
        var contract_client_name = $(this).attr("contract_client_name");
        var contract_pic = $(this).attr("contract_pic");
        var contract_title = $(this).attr("contract_title");
        var contract_email_id = $(this).attr("contract_email_id");


        $('#contract_share_url').val(c_url);
        $('#contract_id').val(contract_id);
        $('#contract_client_name').val(contract_client_name);
        $('#contract_pic').val(contract_pic);
        $('#contract_title').val(contract_title);

        $('#invoiceid').val(contract_id);
        $('#ibm_email_id').val(contract_email_id);
        $('#ibm_client_name').val(contract_client_name);


    });
    </script>
    <script>
    window.onload = setShareLinks;

    function setShareLinks() {
        //alert($('#contract_share_url').val());
        // var c_url = $(this).attr("href");
        // $('#contract_share_url').val(c_url);
        // var pageUrl = encodeURIComponent($('#contract_share_url').val());
        // var pageTitle = encodeURIComponent('Contract Document Share');
        // // var pageUrl = encodeURIComponent(document.URL);
        // var pageTitle = encodeURIComponent(document.title);    

        document.addEventListener('click', function(event) {
            let url = null;


            var pageUrl = encodeURIComponent($('#contract_share_url').val());
            var pageTitle = encodeURIComponent('Contract Document Share');

            if (event.target.classList.contains('share__link--facebook')) {
                url = "https://www.facebook.com/sharer.php?u=" + pageUrl;
                socialWindow(url, 570, 570);
            }

            if (event.target.classList.contains('share__link--twitter')) {
                url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + pageTitle;
                socialWindow(url, 570, 300);
            }

            if (event.target.classList.contains('share__link--linkedin')) {
                url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl;
                socialWindow(url, 570, 570);
            }

            if (event.target.classList.contains('share__link--whatsapp')) {
                url = "whatsapp://send?text=" + pageTitle + "%20" + pageUrl;
                socialWindow(url, 570, 450);
            }

            if (event.target.classList.contains('share__link--mail')) {
                // url = "mailto:?subject=%22" + pageTitle + "%22&body=Read%20the%20article%20%22" + pageTitle +
                //     "%22%20on%20" + pageUrl;
                // socialWindow(url, 570, 450);
                var pageUrl = decodeURIComponent($('#contract_share_url').val());
                var contract_title = $('#contract_title').val();
                var contract_client_name = $('#contract_client_name').val();
                var contract_pic = $('#contract_pic').val();

                var emailBody = `
                    Contents
                    
                    Link for Signing : ${pageUrl}.
                    `;


                // Encode the components for use in a URL
                var PageTitle = "Digital Signature - Signing ";
                var encodedTitle = encodeURIComponent(PageTitle);
                var encodedBody = encodeURIComponent(emailBody);

                // Construct the mailto URL
                url = `mailto:?subject=${encodedTitle}&body=${encodedBody}`;

                socialWindow(url, 1080, 780);

            }



            var ds_id = $('#contract_id').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url('digitalsignature/change_status') ?>',
                data: {
                    ds_id: ds_id
                },
                success: function(response) {

                    if (response.status == '200') {

                        // alert(response.message);
                        // location.reload();
                        // $('#doctable').DataTable().destroy();
                        //   $('#do_return_details_content').html('');
                        //   $('#do_return_details_content').html(response.html);
                        //   $('#do_return_details_modal').modal('show');
                        // $('#doctable').DataTable();
                    } else {
                        //alert(response.message);
                        //alert(response.message);
                    }
                    // Handle the response from the controller
                    // console.log(response);
                },
                error: function(error) {
                    // console.error(error);
                }
            });

            $('#myModal').modal('hide');

        }, false);
    }

    function socialWindow(url, width, height) {
        var left = (screen.width - width) / 2;
        var top = (screen.height - height) / 2;
        var params = "menubar=no,toolbar=no,status=no,width=" + width + ",height=" + height + ",top=" + top + ",left=" +
            left;
        window.open(url, "", params);
    }
    </script>


    <script type="text/javascript">
    $(function() {
        $('.summernote').summernote({
            height: 150,
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

        $('#sendM').on('click', function(e) {
            e.preventDefault();

            sendBill($('.summernote').summernote('code'));

        });


    });
    </script>


    <script>
    function selectOption(optionId, element) {
        // Remove active class from all items
        document.querySelectorAll('.sign__mode__item').forEach(item => item.classList.remove('active'));

        // Add active class to the clicked item
        element.classList.add('active');

        var c_ele_id = element.id; // Use id directly, no need for .attr()
        if (c_ele_id == 'singleMode') {
            $('#sharing_count').val('1');
        } else {
            $('#sharing_count').val('4');
        }

        // Handle your logic here based on the selected option (optionId)
    }
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