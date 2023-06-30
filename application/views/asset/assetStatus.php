<?php
 ?>
<style>
    select#status, .inphtml{width: 100%; border: 1px   solid #ccc; border-radius:3px;padding: 10px;}
    #doct{
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
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Asset Status') ?></h5>
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
                                            <a href='#'
                                                                                          class="btn btn-primary btn-sm rounded"
                                                                                          data-toggle="modal"
                                                                                          data-target="#addCategory">
                                                <?php echo $this->lang->line('Add Asset Status') ?>
                                            </a></h3>

            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
					                        <th><?php echo $this->lang->line('No') ?></th>

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

<div class="modal fade" id="addCategory" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content ">
            <form method="post" id="product_action" class="form-horizontal" action="<?php echo base_url("asset/create_asset_status") ?>">
                <!-- Modal Header -->
                

                <!-- Modal Body -->
                <div class="modal-body">
                    <p id="statusMsg"></p>
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label"
                                       for="name"><?php echo $this->lang->line('Name') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Name"
                                           class="form-control margin-bottom" id="name" name="name" required>
                                </div>
                            </div>

                            <div class="form-group row">

                                <label class="col-sm-2 col-form-label"
                                       for="phone"><?php echo $this->lang->line('Description') ?></label>

                                <div class="col-sm-10">
                                    <input type="text" placeholder="Description"
                                           class="form-control margin-bottom" name="description" id="description">
                                </div>
                            </div>
                            

                                </div>

                     
                       


                        </div>

                    </div>
					 <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                    <input type="submit" id="submit" class="btn btn-primary submitBtn" value="ADD"/>
                </div>
                </div>
                <!-- Modal Footer -->
               
            </form>
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
                <p><?php echo $this->lang->line('delete this asset') ?>no Are you sure you want to delete this Status?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="asset/deleteStatus">
                <button type="button" data-dismiss="modal" class="btn btn-primary"
                        id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                <button type="button" data-dismiss="modal"
                        class="btn"><?php echo $this->lang->line('Cancel') ?></button>
            </div>
        </div>
    </div>
</div>
</form>
<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Edit Asset Status'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                </div>
     <div class="modal-body" id="status">
	 
	 
	 </div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#trans_table').removeAttr('width').DataTable( {
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang();?>
            "ajax": {
                "url": "<?php echo site_url('asset/getassetstatus')?>",
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
      function AddEdit(val)
		{
//$('#bd-example-modal-lg').modal('show'); 
 $.ajax({
                "url": "<?php echo site_url('asset/getAssetStatusForEdit') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':val
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                   $("#status").html(data);
					$('#bd-example-modal-lg').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
		
		  function Save()
		{
			
             var name=$('#Name').val(); 
			 var id=$('#Id').val(); 

			 var descrption=$('#Description').val(); 
 $.ajax({
                "url": "<?php echo site_url('asset/updateStatus') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'name':name,'descrption':descrption,'id':id
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                   //$("#status").html(data);
					$('#bd-example-modal-lg').modal('hide');
					//$("#barcode").val(data.url);
                   if (data.status == "Success") {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();
					setTimeout(function() {
    location.reload();
}, 1000);
                } else {
                    $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                    $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                    $("html, body").scrollTop($("body").offset().top);
                    $("#data_form").hide();
					setTimeout(function() {
    location.reload();
}, 1000);
                }
              
                }
            });
			
		}
		
</script>
