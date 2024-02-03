
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Vehicles') ?> <a href="<?php echo base_url('vehicles/create') ?>"
                    class="btn btn-primary btn-sm rounded">
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
                <?php if ($this->session->flashdata("SuccessMsg")) {?>
                <div class="alert alert-success notify-alert">
                    <?php echo $this->session->flashdata("SuccessMsg") ?>
                </div>
                <?php }?>
                <?php if ($this->session->flashdata("ErrorMsg")) {?>
                <div class="alert alert-danger notify-alert">
                    <?php echo $this->session->flashdata("ErrorMsg") ?>
                </div>
                <?php }?>

                <div class="table-responsive">
                    <table id="acctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('Registration No') ?></th>
                                <th><?php echo $this->lang->line('Employee Name') ?></th>
                                <th><?php echo $this->lang->line('Make') ?></th>
                                <th><?php echo $this->lang->line('Model') ?></th>
                                <th><?php echo $this->lang->line('Vehicle No') ?></th>
                                <th><?php echo $this->lang->line('Fuel Type') ?></th>
                                <th><?php echo $this->lang->line('Manufacture Year') ?></th>
                                <th><?php echo $this->lang->line('Color') ?></th>
                                <th><?php echo $this->lang->line('Actions') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                         <?php if(!empty($vehicles)) { $ii=1; foreach($vehicles as $row){ 
                           
                            ?>
                            <tr >
                                <td><?php echo $ii; ?></td>
                                <td><?php echo $row['registration_number']; ?></td>
                                <td><?php echo $row['employee_name']; ?></td>
                                <td><?php echo $row['make']; ?></td>
                                <td><?php echo $row['model']; ?></td>                               
                                <td><?php echo $row['vin']; ?></td>
                                <td><?php echo $row['fuel_type']; ?></td> 
                                <td><?php echo $row['year_of_manufacture']; ?></td>
                                <td><?php echo $row['color']; ?></td> 
                                <td>
                                    <a href="<?php echo base_url("vehicles/view/".$row['id']); ?>"
                                        class='btn btn-success btn-sm'><i class='fa fa-eye'></i>
                                        <?php echo $this->lang->line('View'); ?></a>&nbsp;
                                    <?php // if($row['status'] == 'PENDING'){ ?>
                                    <a href="<?php echo base_url("vehicles/edit/".$row['id']); ?>"
                                        class='btn btn-warning btn-sm'><i class='fa fa-pencil'></i>
                                        <?php echo $this->lang->line('Edit'); ?></a>
                                    <?php // } ?>
                                    &nbsp;<a href='#' data-object-id="<?php echo $row['id']; ?>"
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

    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Vehicle') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('Delete Vehicle') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="vehicles/delete">
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
                        <input type="hidden" class="form-control" id="emailtype" value="contract">
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

    <input type="hidden" id="contract_share_url" name="contract_share_url"
        value="<?php // echo base_url('contract/sales/1/2345654345'); ?>">
    <input type="hidden" id="contract_id" name="contract_id"
        value="<?php // echo base_url('contract/sales/1/2345654345'); ?>">
    <input type="hidden" id="contract_client_name" name="contract_client_name" value="" />
    <input type="hidden" id="contract_pic" name="contract_pic" value="" />
    <input type="hidden" id="contract_title" name="contract_title" value="" />



    <script type="text/javascript">
    $(document).ready(function() {

        //datatables
        $('#acctable').DataTable({
            'responsive': true
        });

    });


    //datatables
    $(document).on('click', '.share-object', function() {

        //alert('sssssss');

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

                    Title : ${contract_title}

                    Company Name : ${contract_client_name}

                    Sender Company Name :  ${contract_client_name}

                    Incharge Person : ${contract_pic}

                    Link for Signing : ${pageUrl}.
                    `;


                // Encode the components for use in a URL
                var PageTitle = "E- Signing – File name ( " + contract_title + " )";
                var encodedTitle = encodeURIComponent(PageTitle);
                var encodedBody = encodeURIComponent(emailBody);

                // Construct the mailto URL
                url = `mailto:?subject=${encodedTitle}&body=${encodedBody}`;

                socialWindow(url, 1080, 780);

            }



            var contract_id = $('#contract_id').val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url('contract/change_status') ?>',
                data: {
                    contract_id: contract_id
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