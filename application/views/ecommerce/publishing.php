
      
      <div class="row mx-1  mt-3">
        <div class="card col-lg-3">
          <h4 class="mb-0">Categories</h4>
          <hr>
          <?php
          if(!empty($segments)) {
              $i=1;
              foreach($segments as $segment) {
               
          ?>
          <div class="accordion <?php $i==1?'mt-2':''; ?> py-1" id="accordionExample">
            <div class="accordion-item">
              <h2 class="accordion-header" >
                <button class="accordion-button fs-6 text-dark Segment" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="<?php $i==1?'true':'false'; ?>" aria-controls="collapseOne" fetchId="<?php echo $segment['id']; ?>" fetchId2="<?php // echo $merchant_id; ?>" fetchurl="<?php echo base_url('ecommerce/GetPublishingSubSegments'); ?>" appendDivId="SubSegmentDiv">
                  <?php echo $segment['title']; ?>
                </button>
              </h2>
              <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse <?php echo $i == 1?'show':''; ?>">
                <div class="accordion-body">
                  <?php
                  foreach($thirdparty_vendors as $tvendors) {
                  $DisableStatus = $tvendors['Status'] == 1 ?"checked":"";
                  ?>
                  <div class="row">
                    <div class="col-xl-8 fs-12">
                      <?php echo $tvendors['VendorName'];?>
                    </div>
                    <div class="col-xl-2">
                      <div class="form-check form-switch ">
                        <input class="form-check-input vendors_thirdparty_update_status_segments" type="checkbox" id="flexSwitchCheckChecked" fetchid="<?php echo $tvendors['Id']; ?>" segmentId="<?php echo $segment['id']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsStatusSegments'); ?>" <?php echo $DisableStatus; ?> appendDivId="SubSegmentDiv"/>
                        <label class="form-check-label" for="flexSwitchCheckDefault"></label>                          
                    </div>
                    </div>
                  </div>
                  <hr class="my-2">
                  <?php } ?>
                 
                </div>
              </div>
            </div>
          </div>
          
          <?php $i++; } }  ?>
          
          
        </div>
        <div class="card col-lg-9 ps-2">
          <div class=" p-2 pt-3">  
            
            <div class="tab-content" id="SubSegmentDiv">
              <div id="swiggy" class="tab-pane active">
                <div class="table-head">
                  <h4>Sub-categories</h4>
                  <div class="tex">
                    <button type="button" class="btn-primery _btn-outline white-space-nowrap m-0 publishing_user_activities" fetchurl="<?php echo base_url('ecommerce/GetUserPublishingActivities'); ?>" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#confirm-popup">Submit </button>
                  </div>
                </div>
                <hr>
                <h4 class=""><?php if(!empty($segments[0]['Name'])) { echo $segments[0]['Name']; }else{ echo ''; } ?></h4>
                <?php
                if(!empty($sub_segments)) {
                $m=1;
                foreach($sub_segments['sub_segments_details'] as $sub_segment) {
                if($m==1) {
                  $show_class = "show";
                } else {
                  $show_class = "";
                }
                ?>
                <div class="accordion mt-2 sub-categories-accordion" id="accordionExample">
                  <div class="accordion-item">
                    <h2 class="accordion-header mx-2" id="headingOne">
                      <!-- <button class="accordion-button fs-6 text-dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnesub" aria-expanded="true" aria-controls="collapseOne">
                        Oils & Ghee
                      </button> -->
                      <div class="row ">
                        <button class="no-button accordion-button fs-12 w-95 border-end-0 right-radius-0 ms-1 pe-0 accordion-btn-hide" type="button">
                        <span class="w-50 text-start fs-6 text-dark"><?php echo $sub_segment['title']; ?></span>
                        <?php
                        foreach($thirdparty_vendors as $tvendors) {
                          $DisableStatus = $tvendors['Status'] == 1 ?"checked":"";
                        ?>
                        <span class="form-check form-switch w-25 text-end">
                          <input class="form-check-input pt-0 vendors_thirdparty_update_status" type="checkbox" id="flexSwitchCheckDefault" fetchid="<?php echo $tvendors['Id']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsStatus'); ?>" <?php echo $DisableStatus; ?> appendDivId="third_party_vendors_status">   
                          <label class="form-check-label pt-15" for="flexSwitchCheckDefault"><?php echo $tvendors['VendorName'];?></label>     
                        </span>
                        <?php } ?>
                       
                        </button>
                        <button class="accordion-button  w-5 border-start-0 left-radius-0 ps-0 SubSegment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnesub<?php echo $m;?>" fetchId="<?php echo $sub_segment['id']; ?>" fetchId2="<?php echo $sub_segment['rel_id']; ?>" fetchId3="<?php // echo $merchant_id; ?>" fetchurl="<?php echo base_url('ecommerce/GetPublishingSubSegmentsItems'); ?>" appendDivId="SubSegmentItemsDiv<?php echo $m;?>" aria-expanded="true" aria-controls="collapseOnesub">
                      </div>
                    </h2>
                    <div id="collapseOnesub<?php echo $m;?>" class="accordion-collapse collapse <?php echo $show_class; ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body" id="SubSegmentItemsDiv<?php echo $m;?>">
                        <div class="table-filters overflow-x mb-3">
                          <div class="left">
                            Show <select class="form-select ms-2 w-75" aria-label="Default select example">
                              <option selected="">10</option>
                              <option value="1">20</option>
                              <option value="2">30</option>
                              <option value="3">40</option>
                            </select>
                          </div>
                          <div class="ms-auto right">
                            <input type="search" class="form-control rounded ms-2" placeholder="Search" aria-label="Search"
                              aria-describedby="search-addon" />
                              
                          </div>
                        </div>
                        <div class="row ">
                        <div class="col-md-12 de-table table-responsive pe-0">
                          <table class="table table-striped ">
                            <thead>
                              <tr>
                                <th >S.no</th>
                                <th class="px-2 white-space-nowrap" scope="col">Product</th>
                                <th class="px-2 white-space-nowrap rounded-0" scope="col">Product Price</th> 
                                <?php if(!empty($thirdparty_vendors)){ foreach($thirdparty_vendors as $tvendor_pr) { ?>
                                  <th class="px-2 white-space-nowrap w-150" scope="col"><?php echo $tvendor_pr['VendorName']; ?> / Price</th> 
                                <?php } } ?>    

                              </tr>
                            </thead>
                            <tbody class="align-middle">
                               <?php
                              if(!empty($sub_segments['item_details'])) {
                              $k=1;
                              foreach($sub_segments['item_details'] as $item) {
                                $string = substr($item['PricesVendors'], 0, -2);
                                $explode = explode("##",$string);

                                
                              ?>
                              <tr>
                                <td class="text-center py-9rem"><?php echo $k; ?>.</td>                       
                                <td class="py-9rem"><?php echo $item['product_name']; ?> </td>
                                <td class="py-9rem"><?php echo $item['product_price']; ?></td> 
                            
                                <?php
                                for ($x = 0; $x < count($explode); $x++) {
                                  if($x!=0) {
                                    $vendors_price = substr($explode[$x],1);
                                  } else {
                                    $vendors_price = $explode[$x];
                                  }
                                  $split_price= explode(',',$vendors_price);
                                ?>
                                <td class="py-2">
                                  <div class="row">
                                    <div class="form-check form-switch col-md-5 pt-2 ms-3 pe-0">
                                      <input class="form-check-input merchant_items_thirdparty_update_status" type="checkbox" id="flexSwitchCheckDefault"  fetchid="<?php echo $tvendors['Id']; ?>" ItemId="<?php echo $item['pid']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsPricesStatus'); ?>" appendDivId="third_party_vendors_status">
                                      <label class="form-check-label" for="flexSwitchCheckDefault"></label>                          
                                  </div>
                                  <div class="col-md-6 p-0">
                                    <input type="text" value="<?php echo $split_price[1]; ?>" id="VendorPrice_<?php echo $item['pid']; ?>_<?php echo $tvendors['Id']; ?>" class="form-control rounded merchant_items_thirdparty_update_price" placeholder="Price" value="" fetchid="<?php echo $tvendors['Id']; ?>" ItemId="<?php echo $item['pid']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsPrices'); ?>" appendDivId="third_party_vendors_prices">
                                  </div>     
                                  </div>
                                  
                                </td>
                                <?php } ?>
                               
                              </tr>
                              
                               <?php $k++; } } ?>
                              
                            </tbody>
                          </table>
                          <div class="table-footer">
                            <div class="left">
                              Showing 1 to 2 of 2 entries
                            </div>
                          </div>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" value="<?php // echo $merchant_id; ?>" id="MerchantId">
                <input type="hidden" value="" id="CityId">
                <input type="hidden" value="" id="LocationId">
                <input type="hidden" value="<?php echo $sub_segment['rel_id']; ?>" id="SegmentId">
                <input type="hidden" value="<?php echo $sub_segment['id']; ?>" id="SubSegmentId">
                
                <?php $m++; } } ?>
             
              </div>
              
              
            </div>
          </div>
        </div>
      </div>


    <div class="modal fade" id="confirm-popup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <form method="post" autocomplete="off" action="<?php echo base_url('ecommerce/PublishingUserActivitiesUpdate'); ?>" id="add_inventory_item_form" name="add_inventory_item_form" class="validate_form ajax_form" enctype="multipart/form-data">
    <div class="modal-dialog modal-dialog-scrollable w-500">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title fw-bold">Alert</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          

          

         
        </div>
        <div class="modal-footer">
          <input type="hidden" id="form_id" name="form_id" value="">
          <input type="hidden" id="after_save_action" name="after_save_action" value="modal_close">
          <button type="submit" class="btn-primery _btn-outline">Confirm</button>
        </div>
      </div>
    </div>
  </form>
  </div>
  <script>

    // publishing

        
    $("body").on("click", ".Segment", function() {
        event.preventDefault();
        
        var fetchId = $(this).attr("fetchId");
        //alert(fetchId);
        var fetchId2 = $(this).attr("fetchId2");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2 };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

          $("body").on("click", ".SubSegment", function() {
        event.preventDefault();
        var fetchId = $(this).attr("fetchId");
        var fetchId2 = $(this).attr("fetchId2");
        var fetchId3 = $(this).attr("fetchId3");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        //alert(appendDivId);
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3 };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

          $("body").on("click", ".Location", function() {
        event.preventDefault();
        var location = $(this).attr("location");
        var fetchId = $(this).attr("fetchId");
        var fetchId2 = $(this).attr("fetchId2");
        var fetchId3 = $(this).attr("fetchId3");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        //alert(appendDivId);
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "fetchId3": fetchId3, "location": location };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

        $("body").on("change", ".merchant_items_thirdparty_update_price", function(e) {
        e.preventDefault();
        var ThirdPartyVenderId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var MerchantId = $("#MerchantId").val();
        var ItemId = $(this).attr("ItemId");
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        var Price = $("#VendorPrice_"+ItemId+"_"+ThirdPartyVenderId ).val();
        
        var formData = { "ItemId": ItemId, "ThirdPartyVenderId": ThirdPartyVenderId, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId, "Price": Price };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".merchant_items_thirdparty_update_status", function(e) {
        e.preventDefault();
        var ThirdPartyVenderId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("appendDivId");
        var MerchantId = $("#MerchantId").val();
        var ItemId = $(this).attr("ItemId");
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        
        var formData = { "ItemId": ItemId, "ThirdPartyVenderId": ThirdPartyVenderId, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".vendors_thirdparty_update_status", function(e) {
        e.preventDefault();
        if($(this).is(':checked'))
        {
            var status = 1;
        }else{
            var status = 0;
        }
        //var status = $(this).val();
        var fetchId = $(this).attr("fetchid");
        var fetchId2 = $(this).attr("fetchid2");
        var fetchurl = $(this).attr("fetchurl");
        var MerchantId = $("#MerchantId").val();
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $("#SegmentId").val();
        var SubSegmentId = $("#SubSegmentId").val();
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "fetchId": fetchId, "fetchId2": fetchId2, "status":status, "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId, "SubSegmentId": SubSegmentId};
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                //$("#" + appendDivId).html(data.html);
                console.log(data.Message);
            }
        });
        return;
    });

         $("body").on("change", ".vendors_thirdparty_update_status_segments", function(e) {
        e.preventDefault();

        if($(this).is(':checked'))
        {
            var status = 1;
        }else{
            var status = 0;
        }

        var fetchId = $(this).attr("fetchid");
        var fetchurl = $(this).attr("fetchurl");
        var MerchantId = $("#MerchantId").val();
        var CityId = $("#CityId").val();
        var LocationId = $("#LocationId").val();
        var SegmentId = $(this).attr("segmentId");
        var appendDivId = $(this).attr("appendDivId");
        var formData = { "status": status, "fetchId": fetchId,  "MerchantId": MerchantId, "CityId": CityId, "LocationId": LocationId, "SegmentId": SegmentId };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            async: false,
            cache: false,
            success: function(data) {
                $("#" + appendDivId).html(data.html);
            }
        });
        return;
    });

        $("body").on("click", ".publishing_user_activities", function() {
        event.preventDefault();
        var fetchurl = $(this).attr("fetchurl");
        var appendDivId = $(this).attr("data-bs-target");
        var formData = { "fetchId": '' };
        $.ajax({
            type: "POST",
            dataType: "json",
            url: fetchurl,
            data: formData,
            cache: false,
            success: function(data) {

                $(appendDivId).find(".modal-body").html(data.html);
                
            }
        });
       
    });





    $("body").on("submit", ".ajax_form", function(event) {
       // alert('ssss');
        event.preventDefault();
        $(this).find(':input[type=submit]').prop('disabled', true);
        var formData = new FormData($(this)[0]);
        var form_id = $(this).attr("id");
        //alert(form_id);
        var ajax_url = $(this).attr("action");
        var after_save_action = $("#" + form_id).find("#after_save_action").val();
        var table_reload = $("#" + form_id).find("#table_reload").val();
        var approval = $("#" + form_id).find("#admin_approval").val();
        // alert(form_id);
        // alert(table_reload);


            
        $.ajax({
            type: "POST",
            url: ajax_url,
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false, 
            error: function(jqXHR, textStatus, errorMessage) {},
            success: function(data) {
                if (data.Status == 200) {
                    //alert(after_save_action);
                    $('#'+form_id)[0].reset();
                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                    DoAfterSaveAction(form_id, after_save_action, data, table_reload);
                    
                } else if (data.Status == 500) {
                    //alert(data.Message);
                    $("#"+form_id).find(':input[type=submit]').prop('disabled', false);
                    swal(data.Message, {
                        icon: "error",
                      });
                }
            }
        });
        

        function DoAfterSaveAction(form_id, after_save_action, data,table_reload='') {
        //alert(table_reload);
        if (after_save_action == 'redirect_to') {
            document.location = data.redirect_to;
        } else if (after_save_action == 'reload') {
            swal(data.Message, {
                icon: "success",
              });
            location.reload();
        } else if (after_save_action == 'modal_close') {
           // alert(data.Message);

            swal(data.Message, {
                icon: "success",
              });

             //alert(form_id);
            //alert($("#" + form_id).closest(".modal"));

             if(form_id == 'add_employee_bonus_details_form')
            {
                $('#bonus').modal('hide');
            }
           
            $("#" + form_id).closest(".modal").find(".btn-close").click();

            

            if(form_id == 'add_employee_details_form' || form_id =='edit_employee_details_form')
            {
                $('#runnerprofile').modal('hide');
            }

        } else {
            //alert(data.Message);
            swal(data.Message, {
                icon: "success",
              });
        }
  
      }
        //DataTableBind1($("#" + table_reload), true);
    });





  </script>  
    
  