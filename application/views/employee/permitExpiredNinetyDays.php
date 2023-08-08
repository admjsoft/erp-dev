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
<div id="c_body"></div>
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
			
                <thead>
                    <tr>
                   <th><?php echo $this->lang->line('No') ?></th>
					  <th><?php echo $this->lang->line('Name') ?></th>
						<th><?php echo $this->lang->line('Company') ?></th>
                        <th><?php echo $this->lang->line('Permit') ?></th>
						 <th><?php echo $this->lang->line('Permit Expiry') ?></th>
			            <th><?php echo $this->lang->line('Permit Status')?></th>
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


<script type="text/javascript">
    $(document).ready(function () {
	var permit_ninety_expiry="ninety";
        $('#trans_table').removeAttr('width').DataTable( {
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
			  'order': [],
            "ajax": {
                "url": "<?php echo site_url('employee/PermitExpiredInNinetyDays')?>",
                "type": "POST",
                'data': {'permit_ninety_expiry':permit_ninety_expiry,'<?=$this->security->get_csrf_token_name()?>': crsf_hash }
            },
          
           
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
