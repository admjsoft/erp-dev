
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
}	.CustomBlueTable {
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
</style>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line("Asset History"); ?></h5>
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
		   <?php if (isset($_SESSION["succ"])) {
         echo '<div class="alert alert-' .
             $_SESSION["status"] .
             '">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .
             $_SESSION["message"] .
             '</div>
        </div>';
         unset($_SESSION["status"]);
         unset($_SESSION["message"]);
     } ?>

            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
</a></h3>

            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>

                        <th><?php echo $this->lang->line("Asset Id"); ?></th>
                        <th><?php echo $this->lang->line(
                            "Assign Employee"
                        ); ?></th>
						<th><?php echo $this->lang->line("Action"); ?></th>
		          <th>              <?php echo $this->lang->line("Created At"); ?></th>


                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>

                        <th><?php echo $this->lang->line("Asset Id"); ?></th>
                        <th><?php echo $this->lang->line(
                            "Assign Employee"
                        ); ?></th>
						<th><?php echo $this->lang->line("Action"); ?></th>
			 		          <th><?php echo $this->lang->line("Created At"); ?></th>


                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-lg" id="bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line(
                        "Asset Details"
                    ); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line(
                            "Close"
                        ); ?></span>
                    </button>
                </div>
     <div class="modal-body" id="employee">
	 
	 
	 </div>
   <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line(
                                "Close"
                            ); ?></button>
                </div>
           
    </div>
  </div>
</div>
<?php
// print_r($this->aauth->get_user()->username);
?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#trans_table').removeAttr('width').DataTable( {
                fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            responsive: true,
            <?php datatable_lang(); ?>
			 'order': [],
            "ajax": {
                "url": "<?php echo site_url("asset/getAssetHistory"); ?>",
                "type": "POST",
                'data': {'<?= $this->security->get_csrf_token_name() ?>': crsf_hash}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
            ],
           
        });



    });
     	 function AssetInfo(val)
		{
		
//$('#bd-example-modal-lg').modal('show'); 
 $.ajax({
                "url": "<?php echo site_url("asset/getassetdetails"); ?>",
                "type": "POST",
                'data': {
                    '<?= $this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':val
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                   $("#employee").html(data);
					$('#bd-example-modal-lg').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
</script>
