<div id="swiggy" class="tab-pane active">
                <div class="table-head">
                  <h4>Sub-categories</h4>
                  <div class="tex">
                    <button type="button" class="btn-primery _btn-outline white-space-nowrap m-0 publishing_user_activities" fetchurl="<?php echo base_url('ecommerce/GetUserPublishingActivities'); ?>" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#confirm-popup">Submit </button>
                  </div>
                </div>
                <hr>
                <h4 class=""><?php echo $segment_name; ?></h4>
               <?php
                if(!empty($sub_segments_details)) {
                  $m=1;
                  foreach($sub_segments_details as $sub_segment) {
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
                          <input class="form-check-input pt-0 vendors_thirdparty_update_status" type="checkbox" id="flexSwitchCheckDefault" fetchid="<?php echo $sub_segment['id']; ?>"  fetchid2="<?php echo $tvendors['Id']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsStatus'); ?>" <?php echo $DisableStatus; ?> appendDivId="third_party_vendors_status">   
                          <label class="form-check-label pt-15" for="flexSwitchCheckDefault"><?php echo $tvendors['VendorName'];?></label>     
                        </span>
                        <?php } ?>
                       
                        </button>
                        <button class="accordion-button  w-5 border-start-0 left-radius-0 ps-0 SubSegment" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOnesub<?php echo $m;?>" fetchId="<?php echo $sub_segment['id']; ?>" fetchId2="<?php echo $sub_segment['rel_id']; ?>" fetchId3="<?php // echo $merchant_id; ?>" fetchurl="<?php echo base_url('ecommerce/GetPublishingSubSegmentsItems'); ?>" appendDivId="SubSegmentItemsDiv<?php echo $m;?>" aria-expanded="true" aria-controls="collapseOnesub">
                      </div>
                    </h2>
                    <div id="collapseOnesub<?php echo $m;?>" class="accordion-collapse collapse <?php echo $m == 1?'show':''; ?>" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                      <div class="accordion-body" id="SubSegmentItemsDiv<?php echo $m;?>">
                        
                        <div class="row ">
                        <div class="col-md-12 de-table table-responsive pe-0">
                          <table class="table table-striped ">
                            <thead>
                              <tr>
                                <th >S.no</th>
                                <th class="px-2 white-space-nowrap" scope="col">Product</th>
                                <th class="px-2 white-space-nowrap rounded-0" scope="col"><?php echo $this->lang->line('Product price'); ?></th>
                                <?php if(!empty($thirdparty_vendors)){ foreach($thirdparty_vendors as $tvendor_pr) { ?>
                                  <th class="px-2 white-space-nowrap w-150" scope="col"><?php echo $tvendor_pr['VendorName']; ?> / Price</th> 
                                <?php } } ?>     
                              </tr>
                            </thead>
                            <tbody class="align-middle">
          <?php
        $k=1;
        foreach($item_details as $item) {
        ?>
        <tr>
          <td class="text-center py-9rem"><?php echo $k; ?>.</td>                       
          <td class="py-9rem"><?php echo $item['product_name']; ?> </td>
          <td class="py-9rem"><?php echo $item['product_price']; ?></td> 
      
            <?php
            $price_vendors = $item['PricesVendors'].",";
            $price_vendors = explode('##,',$price_vendors);
            if(!empty($price_vendors))
            {
            foreach($price_vendors as $price_vendor) {
              if(!empty($price_vendor)){
              $pricing_details = explode(',',$price_vendor);
          ?>
          <td class="py-2">
            <div class="row">
              <div class="form-check form-switch col-md-5 pt-2 ms-3 pe-0">
                <input class="form-check-input merchant_items_thirdparty_update_status" type="checkbox" id="flexSwitchCheckDefault" <?php if($pricing_details[1]){ echo "checked"; } ?> fetchid="<?php echo $pricing_details[0]; ?>" ItemId="<?php echo $item['pid']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsPricesStatus'); ?>" appendDivId="third_party_vendors_status">
                <label class="form-check-label" for="flexSwitchCheckDefault"></label>                          
            </div>
            <div class="col-md-6 p-0">
              <input type="text" id="VendorPrice_<?php echo $item['pid']; ?>_<?php echo $pricing_details[0]; ?>" class="form-control rounded merchant_items_thirdparty_update_price" placeholder="Price" value="<?php echo $pricing_details[2]; ?>" fetchid="<?php echo $pricing_details[0]; ?>" ItemId="<?php echo $item['pid']; ?>" fetchurl="<?php echo base_url('ecommerce/UpdateThirdPartyVendorsPrices'); ?>" appendDivId="third_party_vendors_prices">
            </div>     
            </div>
            
          </td>
          <?php } } }?>
        </tr>
          <?php $k++; } ?>
        
      </tbody>
                          </table>
                          
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <input type="hidden" value="3" id="MerchantId">
                <input type="hidden" value="5" id="CityId">
                <input type="hidden" value="10" id="LocationId">
                <input type="hidden" value="<?php echo $sub_segment['rel_id']; ?>" id="SegmentId">
                <input type="hidden" value="<?php echo $sub_segment['id']; ?>" id="SubSegmentId">
                
                
                <?php $m++; } } ?>
             
              </div>