<?php
if (isset($_SESSION['status'])) {
    echo '<div class="alert alert-' . $_SESSION['status'] . '">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $_SESSION['message'] . '</div>
        </div>';
    unset($_SESSION['status']);
    unset($_SESSION['message']);
} ?>
<style>
    select#status, .inphtml{width: 100%; border: 1px   solid #ccc; border-radius:3px;padding: 10px;}
    #doct{
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    }
	.CustomBlueTable {
    font-family: Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
    border: 1px solid #0094ff;
}
.CustomBlueTable th {
    font-size: 12px;
}
.CustomBlueTable th {
    border: 1px solid #4CAF50;
    padding-top: 1px;
    padding-bottom: 1px;
    text-align: left;
    background-color:#0094ff ;
    color: white;
    line-height: 30px;
    padding-left: 5px;
}
.CustomBlueTable td, .CustomBlueTable th {
    font-size: 12px;
}
.CustomBlueTable td, #CustomBlueTable th {
    border: 1px solid #0094ff;
    /* padding: 1px; */
    line-height: 20px;
    padding-left: 5px;
}
</style>
   

<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Asset Comments') ?></h5>
			 <h4 class="card-title"> 
			
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div><div class="card-content">
			<div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
        
        <div class="card-body">
            <!--<div id="notify" class="alert alert-success" style="dataTables_scrollHeadInner:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                
            </div>-->


            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('Asset Id') ?></th>
                        <th><?php echo $this->lang->line('Comments') ?></th>
					     <th><?php echo $this->lang->line('Created By') ?></th>
					   <th><?php echo $this->lang->line('Created_At') ?></th>
				       <th><?php echo $this->lang->line('Actions') ?></th>

						
                    </tr>
                </thead>
                <tbody>
                </tbody>


           </table>
        </div>
    </div>
</div>
<?php // print_r($this->aauth->get_user()->username);
 ?>
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
                <p><?php echo $this->lang->line('delete this Comment') ?> <?php echo $this->lang->line('Are you sure you want to delete this Comment?'); ?></p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="asset/deleteComment">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
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
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('asset/assetllistComments') ?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name() ?>': crsf_hash}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": true,
                },
            ],

        });



    });
     	
</script>
