<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">

                <?php echo $this->lang->line('Documents') ?> <a
                    href="<?php echo base_url('employee/adddocument?id=' . $id) ?>"
                    class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?>
                </a>

            </h4>
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


                <div class="row">




                    <table id="doctable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th><?php echo $this->lang->line('Title') ?></th>
                                <th><?php echo $this->lang->line('Added') ?></th>
                                <th><?php echo $this->lang->line('Action') ?></th>


                            </tr>
                        </thead>
                        <tbody>

                        </tbody>

                    </table>

                </div>


            </div>
        </div>


        <div id="delete_model" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <p><?php echo $this->lang->line('delete this document') ?></p>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="object-id" value="">
                        <input type="hidden" id="action-url" value="employee/delete_document">
                        <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                        <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
        $(document).ready(function() {

            $('#doctable').DataTable({

                "processing": true,
                "serverSide": true,
                responsive: true,
                <?php datatable_lang();?> "ajax": {
                    "url": "<?php echo site_url('employee/document_load_list')?>",
                    "type": "POST",
                    'data': {
                        'cid': <?=$id ?>,
                        '<?=$this->security->get_csrf_token_name()?>': crsf_hash
                    }
                },
                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                }, ],

            });

        });
        </script>

        <script type="text/javascript">
        $(function() {
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
        });
        </script>