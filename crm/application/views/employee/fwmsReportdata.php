<style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</style>
<style>
.form-check {
    position: relative;
    display: block;
    padding-left: 1.25rem;
}
</style>
<?php
if(empty($expiry))
{
	$expiry=0;
}
if(empty($employee))
{
	$employee=0;
}
?>
<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
<div id="c_body"></div>
            <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
            <div class="card card-block">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $this->lang->line('Payments') ?></h3>
                    <p><br></p>
                    <table id="invoices" class="cell-border example1 table table-striped table1 delSelTable">
                        <thead>
                         <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						<th><?php echo $this->lang->line('Address') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
                    </tr>
                        </thead>
                        <tbody>
                        </tbody>

                        <tfoot>
                       <tr>
                         <th><?php echo $this->lang->line('No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
						<th><?php echo $this->lang->line('Address') ?></th>
                        <th><?php echo $this->lang->line('Country') ?></th>
					     <th><?php echo $this->lang->line('Passport Number') ?></th>
					   <th><?php echo $this->lang->line('Passport Expiry') ?></th>
					    <th><?php echo $this->lang->line('Permit') ?></th>
                        <th><?php echo $this->lang->line('Permit Expiry') ?></th>
						
                    </tr>
                    </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
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
                <p><?php echo $this->lang->line('delete this Employee') ?>Are you sure you want to delete this Employee?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="employee/deleteFwmsEmployee">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>
 <script>
  $(document).ready(function () {
	  

        $('#invoices').removeAttr('width').DataTable( {
        
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            "ajax": {
                "url": "<?php echo site_url('employee/fwmsReportGenerateAjax')?>",
                "type": "POST",
                'data': {'company':<?php echo $cid;?>,'employee':<?php echo $employee;?>,'expiry':<?php echo $expiry;?>}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
				
            ],
           dom: 'Blfrtip'
          
        });



    });
    </script>