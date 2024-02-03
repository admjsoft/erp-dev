<?PHP
$a=0;
 for($i = 0; $i<5; $i++) 
{
    $a .= mt_rand(0,9);
}
$assetId="AST-".$a;
$_SESSION['asset_id']=$assetId;

?>
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><?php echo $this->lang->line('Add New Customer') ?></h4>

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
            <form method="post" id="data_form" class="form-horizontal" enctype="multipart/form-data">
                <div class="card">

                    <div class="card-content">
                        <div class="card-body">
                            <div id="succ-msg" style="color:green;font-size:20px;text-align:center">

                            </div>
                            <div id="err-msg" style="color:red;font-size:20px;text-align:center">

                            </div>
                            <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active show" id="base-tab1" data-toggle="tab"
                                        aria-controls="tab1" href="#tab1" role="tab"
                                        aria-selected="true"><?php echo $this->lang->line('Basic Info') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab2" data-toggle="tab" aria-controls="tab2"
                                        href="#tab2" role="tab"
                                        aria-selected="false"><?php echo $this->lang->line('Other Info') ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="base-tab3" data-toggle="tab" aria-controls="tab4"
                                        href="#tab4" role="tab"
                                        aria-selected="false"><?php echo $this->lang->line('Asset Assign') ?></a>
                                </li>


                            </ul>
                            <div class="tab-content px-1 pt-1">
                                <div class="tab-pane active show" id="tab1" role="tabpanel" aria-labelledby="base-tab1">
                                    <div class="form-group row mt-1">

                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Asset Id') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Asset Id"
                                                class="form-control margin-bottom b_input required" name="AssetId"
                                                value="<?php echo $assetId;?>" id="AssetId">
                                        </div>
                                    </div>
                                    <div class="form-group row">


                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Barcode') ?></label>

                                        <div class="col-sm-8" id="image">
                                        </div> <input type="hidden" name="barcode" value="" id="barcode">

                                    </div>

                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="name"><?php echo $this->lang->line('Asset Model No') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Asset Model No"
                                                class="form-control margin-bottom b_input" name="AssetModelNo"
                                                id="AssetModelNo">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="phone"><?php echo $this->lang->line('Name') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Name"
                                                class="form-control margin-bottom required b_input" name="Name"
                                                id="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="email"><?php echo $this->lang->line('Description') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Description"
                                                class="form-control margin-bottom required b_input" name="Description"
                                                id="Description">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label"
                                            for="address"><?php echo $this->lang->line('Unit Price') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Unit Price"
                                                class="form-control margin-bottom b_input" name="UnitPrice"
                                                id="UnitPrice">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="city"><?php echo $this->lang->line('Asset Status') ?></label>
                                        <div class="col-sm-8">
                                            <select id="AssetStatus" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="The Category field is required."
                                                name="AssetStatus">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <?php foreach($status as $statusval)
											  {
												  ?>
                                                <option value="<?php echo $statusval['id'];?>">
                                                    <?php echo $statusval['name'];?></option>
                                                <?php
										   }
										   ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="region"><?php echo $this->lang->line('Date Of Purchase') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Date Of Purchase"
                                                class="form-control margin-bottom b_input" name="DateOfPurchase"
                                                id="DateOfPurchase" data-toggle="datepicker" autocomplete="false">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="country"><?php echo $this->lang->line('Category') ?></label>

                                        <div class="col-sm-8">
                                            <select id="Category" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="The Category field is required."
                                                name="Category">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <?php foreach($categories as $cat)
											  {
												  ?>
                                                <option value="<?php echo $cat['id'];?>"><?php echo $cat['name'];?>
                                                </option>
                                                <?php
										   }
										   ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('Sub Category') ?></label>

                                        <div class="col-sm-8">
                                            <select id="SubCategory" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="The Sub Category field is required."
                                                name="SubCategory">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <?php foreach($subcategories as $subcat)
											  {?>
                                                <option value="<?php echo $subcat['id'];?>">
                                                    <?php echo $subcat['name'];?></option>
                                                <?php
										   }
										   ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('Supplier') ?></label>

                                        <div class="col-sm-8">
                                            <select id="Supplier" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="The Supplier field is required."
                                                name="Supplier">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <option value="1"><?php echo $this->lang->line('Common Supplier'); ?></option>
                                                <option value="2"><?php echo $this->lang->line('Google'); ?></option>
                                                <option value="3"><?php echo $this->lang->line('Amazon'); ?></option>
                                                <option value="4"><?php echo $this->lang->line('Microsoft'); ?></option>
                                                <option value="5"><?php echo $this->lang->line('PHP'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('Department') ?></label>

                                        <div class="col-sm-8">
                                            <select id="Department" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="The Category field is required."
                                                name="Department">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <?php foreach($department as $departmentval)
											  {
												  ?>
                                                <option value="<?php echo $departmentval['id'];?>">
                                                    <?php echo $departmentval['val1'];?></option>
                                                <?php
										   }
										   ?>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="postbox"><?php echo $this->lang->line('Sub Department') ?></label>

                                        <div class="col-sm-8">
                                            <select id="SubDepartment" class="form-control" style="width:100%;"
                                                data-val="true"
                                                data-val-required="The Sub Department field is required."
                                                name="SubDepartment">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <option value="1"><?php echo $this->lang->line('QA'); ?></option>
                                                <option value="2"><?php echo $this->lang->line('Software Development'); ?></option>
                                                <option value="3"><?php echo $this->lang->line('Operation'); ?></option>
                                                <option value="4"><?php echo $this->lang->line('PM'); ?></option>
                                                <option value="5"><?php echo $this->lang->line('Recruitment'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab2" role="tabpanel" aria-labelledby="base-tab2">
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="name_s"><?php echo $this->lang->line('Date Of Manufacture') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Date Of Manufacture"
                                                class="form-control margin-bottom b_input" name="DateOfManufacture"
                                                data-toggle="datepicker" id="DateOfManufacture">
                                        </div>
                                    </div>


                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="phone_s"><?php echo $this->lang->line('Year Of Valuation') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Year Of Valuation"
                                                class="form-control margin-bottom b_input" name="YearOfValuation"
                                                data-toggle="datepicker" id="YearOfValuation">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="WarranetyInMonth"><?php echo $this->lang->line('Warranety In Month') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Warranety In Month"
                                                class="form-control margin-bottom b_input" name="WarranetyInMonth"
                                                id="WarranetyInMonth">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="address"><?php echo $this->lang->line('Depreciation In Month') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Depreciation In Month"
                                                class="form-control margin-bottom b_input" name="DepreciationInMonth"
                                                id="DepreciationInMonth">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="address"><?php echo $this->lang->line('Location') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Location"
                                                class="form-control margin-bottom b_input" name="Location"
                                                id="Location">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="city_s"><?php echo $this->lang->line('Image URL') ?></label>

                                        <div class="col-sm-8">
                                            <input type="file" data-val="true"
                                                data-val-required="The ImageURLDetails field is required." id="image"
                                                name="image">
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <label class="col-sm-2 col-form-label"
                                            for="region_s"><?php echo $this->lang->line('Note') ?></label>

                                        <div class="col-sm-8">
                                            <input type="text" placeholder="Note"
                                                class="form-control margin-bottom b_input" name="note" id="note">
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane show" id="tab4" role="tabpanel" aria-labelledby="base-tab4">


                                    <div class="form-group row"><label class="col-sm-2 col-form-label"
                                            for="Discount"><?php echo $this->lang->line('Assign Employee') ?> </label>
                                        <div class="col-sm-6">
                                            <select id="employee" class="form-control" style="width:100%;"
                                                data-val="true" data-val-required="Employee field is required."
                                                name="employee">
                                                <option disabled="" selected="">--- <?php echo $this->lang->line('SELECT'); ?> ---</option>
                                                <?php foreach($employee as $employee)
											  {
												  ?>
                                                <option value="<?php echo $employee['id'];?>">
                                                    <?php echo $employee['name'];?></option>
                                                <?php
										   }
										   ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="mybutton">
                                        <input type="submit" id="submit-data1"
                                            class="btn btn-lg btn btn-primary margin-bottom round float-xs-right mr-2"
                                            value="<?php echo $this->lang->line('Add Asset') ?>"
                                            data-loading-text="Adding...">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <input type="hidden" value="asset/addasset" id="action-url">
            </form>
        </div>
    </div>
</div>
<div class="modal fade show" id="ExtraBigModal" role="dialog" style="display: block; padding-right: 17px;"
    aria-modal="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-md-8">
                    <h3 id="titleExtraBigModal" class="modal-title"><?php echo $this->lang->line('Add Asset'); ?></h3>
                </div>
                <div class="col-md-pull-4 pull-right">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">X</button>
                </div>
            </div>
            <div class="modal-body" id="ExtraBigModalDiv">


            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {

    var assetid = $("#AssetId").val();

    $.ajax({
        "url": "<?php echo site_url('asset/getbarcode')?>",
        "type": "POST",
        'data': {
            '<?=$this->security->get_csrf_token_name()?>': crsf_hash,
            'assetid': assetid
        },
        success: function(result) {
            var data = JSON.parse(result);
            //var file=baseurl+"userfiles/documents/"+data.doc;
            //console.log(file);
            $("#image").html(data.img);
            $("#barcode").val(data.url);


        }
    });


});
</script>
<script type="text/javascript">
//universal create
/*$("#submit-data1").on("click", function (e) {
        e.preventDefault();

        var o_data = $("#data_form").serialize();
        var action_url = $('#action-url').val();
		
		
        //addObject(o_data, action_url);
    });*/

function AddEdit(val) {
    //$('#bd-example-modal-lg').modal('show'); 
    $.ajax({
        "url": "<?php echo site_url('asset/AddEdit') ?>",
        "type": "POST",
        'data': {
            '<?=$this->security->get_csrf_token_name() ?>': crsf_hash,
            'id': val
        },
        success: function(result) {
            var data = JSON.parse(result);
            //var file=baseurl+"userfiles/documents/"+data.doc;
            //console.log(result);
            $("#ExtraBigModal").html(data);
            $('#ExtraBigModal').modal('show');
            //$("#barcode").val(data.url);


        }
    });

}
/
$(document).ready(function(e) {
    // Submit form data via Ajax
    $("#data_form").on('submit', function(e) {
        var action_url = $('#action-url').val();
        var redirect = '<?php echo site_url('asset/assetlist')?>';
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url() ?>' + action_url,
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('.submitBtn').attr("disabled", "disabled");
                $('#fupForm').css("opacity", ".5");
            },
            success: function(response) {
                console.log(response);

                if (response.status == "file") {
                    $("#err-msg").html(response.error);
                } else {

                    if (response.status == "Success") {

                        $("#succ-msg").html(response.msg);
                        top.location.href = redirect;


                    } else {

                        $("#err-msg").html(response.msg);


                    }


                }
            }

        });



    });
});


function addObject(action, action_url) {


    jQuery.ajax({

        url: '<?php echo base_url() ?>' + action_url,
        type: 'POST',
        data: action + '&<?=$this->security->get_csrf_token_name(); ?>=<?=$this->security->get_csrf_hash(); ?>',
        dataType: 'json',
        success: function(data) {
            if (data.status == "Success") {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-danger").addClass("alert-success").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                $("#data_form").hide();


            } else {
                $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
                $("#notify").removeClass("alert-success").addClass("alert-danger").fadeIn();
                $("html, body").scrollTop($("body").offset().top);
                $("#data_form").hide();
            }

        },
        error: function(data) {
            $("#notify .message").html("<strong>" + data.status + "</strong>: " + data.message);
            $("#notify").removeClass("alert-success").addClass("alert-warning").fadeIn();
            $("html, body").scrollTop($("body").offset().top);

        }
    });


}
</script>