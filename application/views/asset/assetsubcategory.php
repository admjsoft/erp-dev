<style>
select#status,
.inphtml {
    width: 100%;
    border: 1px solid #ccc;
    border-radius: 3px;
    padding: 10px;
}

#doct {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.modal {
    position: absolute;
    top: 0%;
    left: 20%;
    width: 60%;
    height: 70%;
}
</style>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Asset Sub Category') ?></h5>
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

            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>

            <h3 class="title">
                <a href='#' class="btn btn-primary btn-sm rounded" data-toggle="modal" data-target="#addSubCategory">
                    <?php echo $this->lang->line('Add Sub Category') ?>
                </a>
            </h3>

            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                width="100%">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Asset Category') ?></th>

                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Description') ?></th>
                        <th><?php echo $this->lang->line('Created Date') ?></th>
                        <th><?php echo $this->lang->line('Actions') ?></th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Asset Category') ?></th>

                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Description') ?></th>
                        <th><?php echo $this->lang->line('Created Date') ?></th>
                        <th><?php echo $this->lang->line('Actions') ?></th>

                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<form>
    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('delete this asset') ?><?php echo $this->lang->line('no Are you sure you want to delete this asset?'); ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="asset/deleteCategory">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
</form>


<div class="modal fade" id="addSubCategory" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal"
                action="<?php echo base_url("asset/save_asset_sub_category") ?>" onSubmit="return validateForm(event);">
                <!-- Modal Header -->

                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Add Asset Sub Category') ?></h4>

                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Asset Category') ?><span
                                        style="color:red">*</span></label>

                                <div class="col-sm-10">
                                    <span class="category_error"></span>

                                    <select id="Category" class="form-control" style="width:100%;" data-val="true"
                                        data-val-required="The Category field is required." name="Category">
                                        <option value="">--- SELECT ---</option>
                                        <?php foreach($subcat as $value)
                                        {
?>
                                        <option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
                                        <?php 
}
?>
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                    for="name"><?php echo $this->lang->line('Name') ?><span
                                        style="color:red">*</span></label>

                                <div class="col-sm-10">
                                    <span class="name_error"></span>

                                    <input type="text" placeholder="Name" class="form-control margin-bottom" id="name"
                                        name="name">
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                    for="phone"><?php echo $this->lang->line('Description') ?><span
                                        style="color:red">*</span></label>

                                <div class="col-sm-10">
                                    <span class="desc_error"></span>

                                    <input type="text" placeholder="Description" class="form-control margin-bottom"
                                        name="description" id="description">
                                </div>
                            </div>


                        </div>





                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                        data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="submit" class="btn btn-primary submitBtn" value="ADD" />
                </div>
        </div>
        <!-- Modal Footer -->

        </form>
    </div>
</div>
</div>
<?php // print_r($this->aauth->get_user()->username); ?>

<script type="text/javascript">
function validateForm(e) {

    $("#Category").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".category_error").text("this field is required");
            //	$('input:radio[name=chooseradio]').val(['foreign']);
            //$("#foreign_content").css("display", "block");
            e.preventDefault();

        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');


        }
    }).trigger("focusout");
    $("#name").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".name_error").text("this field is required");
            //	$('input:radio[name=chooseradio]').val(['foreign']);
            //$("#foreign_content").css("display", "block");
            e.preventDefault();

        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');


        }
    }).trigger("focusout");
    $("#description").focusout(function() {
        if ($(this).val() == '') {
            $(this).css('border', 'solid 2px red');
            $(".desc_error").text("this field is required");
            //	$('input:radio[name=chooseradio]').val(['foreign']);
            //$("#foreign_content").css("display", "block");
            e.preventDefault();

        } else {

            // If it is not blank.
            $(this).css('border', 'solid 2px green');


        }
    }).trigger("focusout");
}



$(document).ready(function() {
    $('#trans_table').removeAttr('width').DataTable({
        fixedColumns: true,
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        responsive: true,
        <?php datatable_lang(); ?> 'order': [],
        "ajax": {
            "url": "<?php echo site_url('asset/getassetsubcategories')?>",
            "type": "POST",
            'data': {
                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
            }
        },
        "columnDefs": [{
            "targets": [0],
            "orderable": true,
        }, ],

    });



});




$(document).on('click', ".update-object", function(e) {
    e.preventDefault();
    var id = $(this).attr('data-object-id');
    $.ajax({
        "url": "<?php echo site_url('expenses/employeeExpense')?>",
        "type": "POST",
        'data': {
            '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
            'id': id
        },
        success: function(result) {
            var data = JSON.parse(result);
            var file = baseurl + "userfiles/documents/" + data.doc;
            console.log(file);
            // $("#div1").html(result);
            if (data.status >= 0) {

                $('.object-id').val(id);
                $('#doc').attr('href', file);
                $('#status').val(data.status);
                $('#remarks').html(data.remarks);
                if (data.status == 1) {
                    $('#submit-update').css('display', "none");
                    $('#statusg').css('display', "none");
                    $('#remarksg').css('display', "none");
                } else {
                    $('#submit-update').css('display', "block");
                    $('#statusg').css('display', "block");
                    $('#remarksg').css('display', "block");

                }
                $('#doc').html(data.doc);
                $('#date').val(data.created_at);
                $('#name').val(data.name);
                $('#title').val(data.title);
                $('#category').val(data.category);
                $('#receipt_no').val(data.receipt_no);
                $('#receipt_date').val(data.receipt_date);
                $('#amount').val(data.receipt_amount);
                $('#tax').val(data.tax_amount);
                $('#reason').html(data.reason);
                $(this).closest('tr').attr('id', id);
                $('#update_model').modal({
                    backdrop: 'static',
                    keyboard: false
                });
            }
        }
    });


});
/*
        $(document).on('click', ".view-object", function (e) {
            e.preventDefault();
            $('#object-id').val($(this).attr('data-object-id'));

            $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
            $('#view_model').modal({backdrop: 'static', keyboard: false});

        });*/
</script>