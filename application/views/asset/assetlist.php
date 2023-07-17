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
</style>
    <script src="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.js"></script>
    <link rel="stylesheet" href="https://lipis.github.io/bootstrap-sweetalert/dist/sweetalert.css" />

<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Asset List') ?></h5>
			 <h4 class="card-title"> 
			 <a href="#" onclick="AddEdit(0);"
                        class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?></a> 
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
        
        <div class="card-body"><?php
if (isset($_GET['succ'])) {
    $_SESSION['status'] = "success";
    $_SESSION['message'] = "Updated Sucessfully";
    echo '<div class="alert alert-' . $_SESSION['status'] . '">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $this->lang->line($_SESSION['message']) . '</div>
        </div>';
    unset($_SESSION['status']);
    unset($_SESSION['message']);
} else if (isset($_GET['err'])) {
    $_SESSION['status'] = "danger";
    $_SESSION['message'] = "Error In Update";
    echo '<div class="alert alert-' . $_SESSION['status'] . '">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $this->lang->line($_SESSION['message']) . '</div>
        </div>';
    unset($_SESSION['status']);
    unset($_SESSION['message']);
}
?>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                
            </div>


            <hr>
            <table id="trans_table" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                   width="100%">
                <thead>
                    <tr>
                        <th><?php echo $this->lang->line('Image') ?></th>
                        <th><?php echo $this->lang->line('Asset Id') ?></th>
						<th><?php echo $this->lang->line('Asset Model No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
					     <th><?php echo $this->lang->line('Assign Employee') ?></th>
					   <th><?php echo $this->lang->line('Unit Price') ?></th>
                        <th><?php echo $this->lang->line('Date of Purchase') ?></th>
				       <th><?php echo $this->lang->line('Actions') ?></th>

						
                    </tr>
                </thead>
                <tbody>
                </tbody>

                <tfoot>
                    <tr>
                      <th><?php echo $this->lang->line('Image') ?></th>
                        <th><?php echo $this->lang->line('Asset Id') ?></th>
						<th><?php echo $this->lang->line('Asset Model No') ?></th>
                        <th><?php echo $this->lang->line('Name') ?></th>
					     <th><?php echo $this->lang->line('Assign Employee') ?></th>
					   <th><?php echo $this->lang->line('Unit Price') ?></th>
                        <th><?php echo $this->lang->line('Date of Purchase') ?></th>
					<th><?php echo $this->lang->line('Actions') ?></th>
		
                    </tr>
                </tfoot>
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
                <p><?php echo $this->lang->line('delete this asset') ?>no Are you sure you want to delete this asset?</p>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="object-id" value="">
                <input type="hidden" id="action-url" value="asset/deleteAsset">
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
                    <h4 class="modal-title" id="myModalLabel"><?php echo $this->lang->line('Employee Details'); ?></h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only"><?php echo $this->lang->line('Close') ?></span>
                    </button>
                </div>
     <div class="modal-body" id="employee">
	 
	 
	 </div>
   <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                </div>
           
    </div>
  </div>
</div>
<div class="modal fade show" id="ExtraBigModal" role="dialog" style="display: None;" aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-4">
                    <h3 id="titleExtraBigModal" class="modal-title">Add Asset</h3>
                </div>
				<div class="col-md-4" >
				<span style="color:red" id="error-message"></span>
				</div>
                <div class="col-md-pull-4 pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                </div>
            </div>
            <div class="modal-body" id="extra">


            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#trans_table').removeAttr('width').DataTable( {
            scrollY:        "300px",
            scrollX:        true,
            scrollCollapse: true,
            columnDefs: [
                { width: 200, targets: 0 }
            ],
            fixedColumns: true,
            "processing": true,
            "serverSide": true,
            "stateSave": true,
            //responsive: true,
            <?php datatable_lang(); ?>
            "ajax": {
                "url": "<?php echo site_url('asset/assetllistAjax') ?>",
                "type": "POST",
                'data': {'<?=$this->security->get_csrf_token_name() ?>': crsf_hash}
            },
            "columnDefs": [
                {
                    "targets": [0],
                    "orderable": false,
                },
            ],
                      dom: 'Blfrtip'

        });



    });
     	
		 function AssignEmployeeInfo(val)
		{
//$('#bd-example-modal-lg').modal('show'); 
 $.ajax({
                "url": "<?php echo site_url('asset/getemployeedetails') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
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
		
			
		 function AssetInfo(val)
		{
//$('#bd-example-modal-lg').modal('show'); 
 $.ajax({
                "url": "<?php echo site_url('asset/getassetdetails') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
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
		function AssetEdit(val)
		{ 
		if(val!=0)
		{
			$("#titleExtraBigModal").text("Edit Asset");
		}
			$.ajax({
                "url": "<?php echo site_url('asset/AssetEdit') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':val
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                    $("#extra").html(data);
					$('#ExtraBigModal').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
	  function AddEdit(val)
		{
//$('#bd-example-modal-lg').modal('show'); 



 $.ajax({
                "url": "<?php echo site_url('asset/AddEdit') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':val
                    },
                    success: function(result){
                       var data=JSON.parse(result);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                    $("#extra").html(data);
					$('#ExtraBigModal').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
		  function AddNewComment()
		{
//$('#bd-example-modal-lg').modal('show'); 

var asset_id=$('#tmpAssetId').val(); 

var CommentMessage=$('#CommentMessage').val(); 


 $.ajax({
                "url": "<?php echo site_url('asset/AddComments') ?>",
                "type": "POST",
                'data': {
                    '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
                    'id':asset_id,'CommentMessage':CommentMessage
                    },
                    success: function(result){
                       var data=JSON.parse(result);
					   AssetEdit(asset_id);
                       //var file=baseurl+"userfiles/documents/"+data.doc;
                     //console.log(result);
                    //$("#extra").html(data);
					//$('#ExtraBigModal').modal('show');
					//$("#barcode").val(data.url);

              
                }
            });
			
		}
/*
		
		
/*
        $(document).on('click', ".view-object", function (e) {
            e.preventDefault();
            $('#object-id').val($(this).attr('data-object-id'));

            $(this).closest('tr').attr('id', $(this).attr('data-object-id'));
            $('#view_model').modal({backdrop: 'static', keyboard: false});

        });*/
	
		function SaveAsset()
		{
			
		
 $("#frmAsset").on('submit', function(e){
var category=$("#Category").val();
if($("#AssetModelNo").val()=="")
{
	
$("#error-message").text("Asset Model No Is Required");

	return false;
	
}
 else if($("#Name").val()=="")
{
	
$("#error-message").text("Name Is Required");

	return false;
	
}


else if($("#Description").val()=="")
{
	
$("#error-message").text("Description Is Required");

	return false;
	
}


 else if($("#UnitPrice").val()=="")
{
	
$("#error-message").text("UnitPrice Is Required");

	return false;
	
}

else if($("#AssetStatus").val()=="")
{
	
$("#error-message").text("AssetStatus Is Required");

	return false;
	
}
 else if($("#DateOfPurchase").val()=="")
{
	
$("#error-message").text("DateOfPurchase Is Required");

	return false;
	
}
 else if(category==null)
{
$("#error-message").text("Category Is Required");

	return false;
	
}
 else if($("#Department").val()==null)
{
	
$("#error-message").text("Department Is Required");

	return false;
	
}

 else if($("#DateOfManufacture").val()=="")
{
	
$("#error-message").text("DateOfManufacture Is Required");

	return false;
	
}

 else if($("#YearOfValuation").val()=="")
{
	
$("#error-message").text("YearOfValuation Is Required");

	return false;
	
}
else
{
$("#error-message").text("");	
	
}


var url="asset/addasset";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>' + url,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                $('#btnSave').attr("disabled","disabled");
                //$('#frmAsset').css("opacity",".5");
            },
            success: function(data){

              console.log(data);
			  
		  $('#ExtraBigModal').modal('hide');
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
		
		
		
		

    });

		}
		
		
		function updateAsset()
		{
       
 $("#frmAsset").on('submit', function(e){
	var category=$("#Category").val();
if($("#AssetModelNo").val()=="")
{
	
$("#error-message").text("Asset Model No Is Required");

	return false;
	
}
 else if($("#Name").val()=="")
{
	
$("#error-message").text("Name Is Required");

	return false;
	
}


else if($("#Description").val()=="")
{
	
$("#error-message").text("Description Is Required");

	return false;
	
}


 else if($("#UnitPrice").val()=="")
{
	
$("#error-message").text("UnitPrice Is Required");

	return false;
	
}

else if($("#AssetStatus").val()=="")
{
	
$("#error-message").text("AssetStatus Is Required");

	return false;
	
}
 else if($("#DateOfPurchase").val()=="")
{
	
$("#error-message").text("DateOfPurchase Is Required");

	return false;
	
}
 else if(category==null)
{
$("#error-message").text("Category Is Required");

	return false;
	
}
 else if($("#Department").val()==null)
{
	
$("#error-message").text("Department Is Required");

	return false;
	
}

 else if($("#DateOfManufacture").val()=="")
{
	
$("#error-message").text("DateOfManufacture Is Required");

	return false;
	
}

 else if($("#YearOfValuation").val()=="")
{
	
$("#error-message").text("YearOfValuation Is Required");

	return false;
	
}
else
{
$("#error-message").text("");	
	
}

var url="asset/update_asset";
        e.preventDefault();
     


	 $.ajax({
            type: 'POST',
            url: '<?php echo base_url(); ?>' + url,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
                //$('#btnSave').attr("disabled","disabled");
                //$('#frmAsset').css("opacity",".5");
            },
            success: function(data){
              //  alert(data.status);
			 $('#ExtraBigModal').modal('hide');
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
		
		
		
		

    });

		}
		
</script>
