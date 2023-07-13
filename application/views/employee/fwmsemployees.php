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
		<h5 class="title">
                <?php echo $this->lang->line('Employee') ?> 
										<?php if ($this->aauth->get_user()->roleid!= 2) {
?>
				
				<a href="<?php echo base_url('employee/add') ?>"
                                                               class="btn btn-primary btn-sm rounded ml-2">
                    <?php echo $this->lang->line('Add new') ?>
										</a><?php }?>
            </h5>
            <h5><?php echo $this->lang->line('Foreign Employees') ?></h5>
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


            <!-- <hr> -->
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
				   <input type="hidden" value="ffff" name="frg" id="frg">
				   <input type="hidden" name="active" value="<?php if(isset($_GET['list'])){echo $_GET['list'];}?>" id="active">
				  <input type="hidden" name="permit_active" value="<?php if(isset($_GET['permitlist'])){echo $_GET['permitlist'];}?>" id="permit_active">
				  <input type="hidden" name="passport_expiry" value="<?php if(isset($_GET['passport'])){echo $_GET['passport'];}?>" id="passport_expiry">
				  <input type="hidden" name="permit_expiry" value="<?php if(isset($_GET['permit'])){echo $_GET['permit'];}?>" id="permit_expiry">

                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						<th><?php echo $this->lang->line('Company') ?></th>
                        <th><?php echo $this->lang->line('Passport') ?></th>
						 <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					     <th><?php echo $this->lang->line('Permit') ?></th>
			            <th><?php echo $this->lang->line('Permit Expiry') ?></th>
			            <th><?php echo $this->lang->line('Status')?></th>

					  <th><?php echo $this->lang->line('Actions') ?></th>

                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <?php /* ?>
                     <tr>
                       <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						<th><?php echo $this->lang->line('Company') ?></th>
                        <th><?php echo $this->lang->line('Passport') ?></th>
				 <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					     <th><?php echo $this->lang->line('Permit') ?></th>
							            <th><?php echo $this->lang->line('Permit Expiry') ?></th>
			            <th><?php echo $this->lang->line('Status')?></th>

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
                <p><?php echo $this->lang->line('delete this Employee') ?><?php echo $this->lang->line('This Will Make The Following Employee Inactive?') ?>
				
				</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="employee/deleteFwmsEmployee">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Continue') ?></button>
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
	var activeval=$("#active").val();
	var permit_active=$("#permit_active").val();
	var passport_expiry=$("#passport_expiry").val();
	var permit_expiry=$("#permit_expiry").val();

      if(activeval=="")
	  {
		  var activeval="";
		  
	  }
	  else{
		  activeval=activeval;
	  }
	   if(permit_active=="")
	  {
		  var permit_active="";
		  
	  }
	  else{
		  permit_active=permit_active;
	  }
	  if(passport_expiry=="")
	  {
		  var passport_expiry="";
		  
	  }
	  else{
		  passport_expiry=passport_expiry;
	  }
	  
	   if(permit_expiry=="")
	  {
		  var permit_expiry="";
		  
	  }
	  else{
		  permit_expiry=permit_expiry;
	  }
	  
	  
        $('#trans_table').removeAttr('width').DataTable( {
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('employee/getfwmsEmployees')?>",
                "type": "POST",
                'data': {'active':activeval,'permit_active':permit_active,'passport_expiry':passport_expiry,'permit_expiry':permit_expiry,'<?=$this->security->get_csrf_token_name()?>': crsf_hash <?php  echo ",'fdms':true" ?> }
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],
           
        });



    });
	
	 function viewEmployee(val)
		{
//$('#bd-example-modal-lg').modal('show'); 
 $.ajax({
                "url": "<?php echo site_url('employee/getfwmsEmployeesforView') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':val
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                   //$("#employee").html(data);
					//$('#bd-example-modal-lg').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
    
/*
        $(document).on('click', ".view-object", function (e) {
            e.preventDefault();
            $('#object-id').val($(this).attr('data-object-id'));

            $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
            $('#view_model').modal({backdrop: 'static', keyboard: false});

        });*/
</script>
