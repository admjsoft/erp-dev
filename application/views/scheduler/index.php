<?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
<style>
    select#status, .inphtml{width: 100%; border: 1px   solid #ccc; border-radius:3px;padding: 10px;}
    #doct{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    }
</style>
<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Schedule List') ?></h5>
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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>

            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
						<th><?php echo $this->lang->line('Module') ?></th>
                        <th><?php echo $this->lang->line('Scheduler For') ?></th>
						   <th><?php echo $this->lang->line('Days') ?></th>
					    <th><?php echo $this->lang->line('Created At') ?></th>
					  <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
                <tfoot>
                    <?php /* ?>
                    <tr>
						<th><?php echo $this->lang->line('Module') ?></th>
                        <th><?php echo $this->lang->line('Scheduler For') ?></th>
						    <th><?php echo $this->lang->line('Days') ?></th>
					    <th><?php echo $this->lang->line('Created At') ?></th>
					<th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                    <?php */ ?>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<?php // print_r($this->aauth->get_user()->username); ?>
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
                <p><?php echo $this->lang->line('delete this expense') ?>Are you sure you want to delete this Payslip?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="payroll/deletePayslip">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>

<form method="post" id="update_form" action="<?php base_url('expenses/update_i'); ?>">
    <div id="update_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php echo $this->lang->line('Update Status') ?>no Update Status</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body container-fluid">
                    <div class="row">
                        <div class="form-group col-sm-6">
                            <label for="date"><?php echo $this->lang->line('Date') ?></label>
                            <input type="text" class="form-control" placeholder="date" id="date" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="name"><?php echo $this->lang->line('Employee') ?></label>
                            <input type="text" class="form-control" placeholder="name" id="name" disabled>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="title"><?php echo $this->lang->line('Title') ?></label>
                            <input type="text" class="form-control" placeholder="title" id="title" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="category"><?php echo $this->lang->line('Category') ?></label>
                            <input type="text" class="form-control" placeholder="category" id="category" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="receipt_no"><?php echo $this->lang->line('Receipt No') ?></label>
                            <input type="text" class="form-control" placeholder="Receipt No" id="receipt_no" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="receipt_date"><?php echo $this->lang->line('Receipt Date') ?></label>
                            <input type="text" class="form-control" placeholder="Receipt Date" id="receipt_date" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="amount"><?php echo $this->lang->line('Amount') ?></label>
                            <input type="text" class="form-control" placeholder="Amount" id="amount" disabled>
                        </div>
                        <div class="form-group col-sm-6">
                            <label for="tax"><?php echo $this->lang->line('Tax') ?></label>
                            <input type="text" class="form-control" placeholder="Tax" id="tax" disabled>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="reason"><?php echo $this->lang->line('Reason') ?></label>
                            <div id="reason" class="inphtml">
                            </div>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="doc"><?php echo $this->lang->line('Supporting Document') ?></label>
                            <a href="#"  class=" btn btn-blue form-control" target="_blank" id="doc"><span id="doct"><?php echo $this->lang->line('View Supporting Document') ?></span></a>
                        </div>
                        <div class="form-group col-sm-12">
                            <label for="remarks"><?php echo $this->lang->line('Remarks') ?></label>
                            <div id="remarks" class="inphtml">
                            </div>
                        </div>
                        <?php if($this->aauth->premission(22)){ ?>
                        <div class="form-group col-sm-12" id="remarksg">
                            <label for="remarks"><?php echo $this->lang->line('Remarks') ?></label>
                            <textarea placeholder="Remarks"  name="remarks" class="form-control"></textarea>
                        </div>
                        <div class="form-group col-sm-12" id="statusg">
                            <label for="status"><?php echo $this->lang->line('Status') ?></label>
                            <select name="status" id="status" form="form-control">
                                <option value="0"><?php echo $this->lang->line('Pending') ?></option>
                                <option value="2"><?php echo $this->lang->line('On Hold') ?></option>
                                <option value="1"><?php echo $this->lang->line('Approved') ?></option>
                            </select>
                        </div>
                        <?php }?>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php if($this->aauth->premission(22)){ ?>
                    <input type="hidden" id="object-id" class="object-id" name="id" value="">
                   <input type="hidden" id="update-url" value="expenses/update_i">

                    <button type="submit" data-dismiss="modal" class="btn btn-primary"
                            id="submit-update"><?php echo $this->lang->line('Update') ?></button>
                            <?php } ?>
                    <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
        $('#trans_table').removeAttr('width').DataTable( {
            
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('scheduler/getSchedulelist')?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name()?>': crsf_hash}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],
           
        });



    });
     $(document).on('click', ".update-object", function (e) {
            e.preventDefault();
            var id = $(this).attr('data-object-id');
            $.ajax({
                "url": "<?php echo site_url('expenses/employeeExpense')?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
                    'id':id
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       var file=baseurl+"userfiles/documents/"+data.doc;
                       console.log(file);
                    // $("#div1").html(result);
                    if(data.status>=0){

                        $('.object-id').val(id);
                        $('#doc').attr('href',file);
                        $('#status').val(data.status);
                        $('#remarks').html(data.remarks);
                        if(data.status==1){
                            $('#submit-update').css('display',"none");
                            $('#statusg').css('display',"none");
                            $('#remarksg').css('display',"none");
                        }else{
                            $('#submit-update').css('display',"block");
                            $('#statusg').css('display',"block");
                            $('#remarksg').css('display',"block");

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
                        $('#update_model').modal({backdrop: 'static', keyboard: false});
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
