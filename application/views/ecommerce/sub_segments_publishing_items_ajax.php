<div class="table-filters overflow-x mb-3">
    
  </div>
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