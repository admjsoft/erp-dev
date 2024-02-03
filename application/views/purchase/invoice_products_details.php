<div id="saman-row">
    <table class="table-responsive tfr my_stripe">
        <thead>

            <tr class="item_header bg-gradient-directional-amber">
                <th width="30%" class="text-center"><?php echo $this->lang->line('Item Name') ?></th>
                <th width="8%" class="text-center"><?php echo $this->lang->line('Quantity') ?></th>
                <th width="10%" class="text-center"><?php echo $this->lang->line('Rate') ?></th>
                <th width="10%" class="text-center"><?php echo $this->lang->line('Tax') ?>(%)</th>
                <th width="10%" class="text-center"><?php echo $this->lang->line('Tax') ?></th>
                <th width="7%" class="text-center"><?php echo $this->lang->line('Discount') ?></th>
                <th width="10%" class="text-center">
                    <?php echo $this->lang->line('Amount') ?>
                    (<?php echo $this->config->item('currency'); ?>)
                </th>
                <th width="5%" class="text-center"><?php echo $this->lang->line('Action') ?></th>
            </tr>
        </thead>
        <tbody>

            <?php 
                                $discount = 0;
                                $tax = 0;
                                $total = 0;
                            if(!empty($products)){ $pc=0; foreach($products as $prod){ 
                                $tax_amount = 0;
                                $discount += ($prod['fproduct_price'] * $prod['disrate'])/100;
                                $tax_amount = ($prod['fproduct_price'] * $prod['taxrate'])/100;
                                $total += ($prod['fproduct_price'] + $tax_amount);
                                $tax += $tax_amount;

                                ?>

            <tr>
                <td><input type="text" class="form-control text-center" name="product_name[]"
                        placeholder="<?php echo $this->lang->line('Enter Product name') ?>"
                        id="<?php echo 'productname-'.$pc; ?>" value="<?php echo $prod['product_name']; ?>">
                </td>
                <td><input type="text" class="form-control req amnt" name="product_qty[]"
                        id="<?php echo "amount-".$pc; ?>" onkeypress="return isNumber(event)"
                        onkeyup="rowTotal('0'), billUpyog()" autocomplete="off" value="1"></td>
                <td><input type="text" class="form-control req prc" name="product_price[]"
                        id="<?php echo "price-".$pc; ?>" onkeypress="return isNumber(event)"
                        onkeyup="rowTotal('0'), billUpyog()" autocomplete="off"
                        value="<?php echo $prod['fproduct_price']; ?>"></td>
                <td><input type="text" class="form-control vat " name="product_tax[]" id="<?php echo "vat-".$pc; ?>"
                        onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()" autocomplete="off"
                        value="<?php echo $prod['taxrate']; ?>"></td>
                <td class="text-center" id="<?php echo "texttaxa-".$pc; ?>">0</td>
                <td><input type="text" class="form-control discount" name="product_discount[]"
                        onkeypress="return isNumber(event)" id="<?php echo "discount-".$pc; ?>"
                        onkeyup="rowTotal('0'), billUpyog()" autocomplete="off" value="<?php echo $prod['disrate']; ?>">
                </td>
                <td><span class="currenty"><?php echo $this->config->item('currency'); ?></span>
                    <strong><span class='ttlText'
                            id="<?php echo "result-".$pc; ?>"><?php echo $prod['fproduct_price']; ?></span></strong>
                </td>
                <td class="text-center"><button type="button" data-rowid="<?php echo $pc; ?>"
                        class="btn btn-danger removeProd" title="Remove"> <i class="fa fa-minus-square"></i> </button>
                </td>
                <input type="hidden" name="taxa[]" id="<?php echo "taxa-".$pc; ?>" value="0">
                <input type="hidden" name="disca[]" id="<?php echo "disca-".$pc; ?>" value="0">
                <input type="hidden" class="ttInput" name="product_subtotal[]" id="<?php echo "total-".$pc; ?>"
                    value="0">
                <input type="hidden" class="pdIn" name="pid[]" id="<?php echo "pid-".$pc; ?>"
                    value="<?php echo $prod['pid']; ?>">
                <input type="hidden" name="unit[]" id="<?php echo "unit-".$pc; ?>" value="">
                <input type="hidden" name="hsn[]" id="<?php echo "hsn-".$pc; ?>" value="">
            </tr>


            <tr>
                <td colspan="8"><textarea id="<?php echo "dpid-".$pc; ?>" class="form-control"
                        name="product_description[]"
                        placeholder="<?php echo $this->lang->line('Enter Product description'); ?>"
                        autocomplete="off"></textarea><br></td>
            </tr>
            <?php $pc++; }}else{ ?>

            <tr>
                <td><input type="text" class="form-control text-center" name="product_name[]"
                        placeholder="<?php echo $this->lang->line('Enter Product name') ?>" id='productname-0'>
                </td>
                <td><input type="text" class="form-control req amnt" name="product_qty[]" id="amount-0"
                        onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()" autocomplete="off"
                        value="1"></td>
                <td><input type="text" class="form-control req prc" name="product_price[]" id="price-0"
                        onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()" autocomplete="off">
                </td>
                <td><input type="text" class="form-control vat " name="product_tax[]" id="vat-0"
                        onkeypress="return isNumber(event)" onkeyup="rowTotal('0'), billUpyog()" autocomplete="off">
                </td>
                <td class="text-center" id="texttaxa-0">0</td>
                <td><input type="text" class="form-control discount" name="product_discount[]"
                        onkeypress="return isNumber(event)" id="discount-0" onkeyup="rowTotal('0'), billUpyog()"
                        autocomplete="off"></td>
                <td><span class="currenty"><?php echo $this->config->item('currency'); ?></span>
                    <strong><span class='ttlText' id="result-0">0</span></strong>
                </td>
                <td class="text-center">

                </td>
                <input type="hidden" name="taxa[]" id="taxa-0" value="0">
                <input type="hidden" name="disca[]" id="disca-0" value="0">
                <input type="hidden" class="ttInput" name="product_subtotal[]" id="total-0" value="0">
                <input type="hidden" class="pdIn" name="pid[]" id="pid-0" value="0">
                <input type="hidden" name="unit[]" id="unit-0" value=""><input type="hidden" name="hsn[]" id="hsn-0"
                    value="">
            </tr>


            <tr>
                <td colspan="8"><textarea id="dpid-0" class="form-control" name="product_description[]"
                        placeholder="<?php echo $this->lang->line('Enter Product description'); ?>"
                        autocomplete="off"></textarea><br></td>
            </tr>
            <?php } ?>
            <tr class="last-item-row">
                <td class="add-row">
                    <button type="button" class="btn btn-success" aria-label="Left Align" id="addproduct">
                        <i class="fa fa-plus-square"></i> <?php echo $this->lang->line('Add Row') ?>
                    </button>
                </td>
                <td colspan="7"></td>
            </tr>

            <tr class="sub_c" style="display: table-row;">
                <td colspan="6" align="right"><input type="hidden" value="0" id="subttlform"
                        name="subtotal"><strong><?php echo $this->lang->line('Total Tax') ?></strong>
                </td>
                <td align="left" colspan="2"><span
                        class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                    <span id="taxr" class="lightMode"><?php echo $tax; ?></span>
                </td>
            </tr>
            <tr class="sub_c" style="display: table-row;">
                <td colspan="6" align="right">
                    <strong><?php echo $this->lang->line('Total Discount') ?></strong>
                </td>
                <td align="left" colspan="2"><span
                        class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>
                    <span id="discs" class="lightMode"><?php echo $discount; ?></span>
                </td>
            </tr>

            <tr class="sub_c" style="display: table-row;">
                <td colspan="6" align="right">
                    <strong><?php echo $this->lang->line('Shipping') ?></strong>
                </td>
                <td align="left" colspan="2"><input type="text" class="form-control shipVal"
                        onkeypress="return isNumber(event)" placeholder="Value" name="shipping" autocomplete="off"
                        onkeyup="billUpyog();">
                    ( <?php echo $this->lang->line('Tax') ?> <?= $this->config->item('currency'); ?>
                    <span id="ship_final">0</span> )
                </td>
            </tr>

            <tr class="sub_c" style="display: table-row;">
                <td colspan="2">
                    <?php if ($exchange['active'] == 1){
                                    echo $this->lang->line('Payment Currency client') . ' <small>' . $this->lang->line('based on live market') ?></small>
                    <select name="mcurrency" class="selectpicker form-contol">
                        <option value="0">Default</option>
                        <?php foreach ($currency as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['symbol'] . ' (' . $row['code'] . ')</option>';
                                        } ?>

                    </select><?php } ?>
                </td>
                <td colspan="4" align="right"><strong><?php echo $this->lang->line('Grand Total') ?>
                        (<span
                            class="currenty lightMode"><?php echo $this->config->item('currency'); ?></span>)</strong>
                </td>
                <td align="left" colspan="2"><input type="text" name="total" class="form-control" id="invoiceyoghtml"
                        value="<?php echo $total; ?>" readonly="">

                </td>
            </tr>
            <tr class="sub_c" style="display: table-row;">
                <td colspan="2"><?php echo $this->lang->line('Payment Terms') ?> <select name="pterms"
                        class="selectpicker form-control"><?php foreach ($terms as $row) {
                                            echo '<option value="' . $row['id'] . '">' . $row['title'] . '</option>';
                                        } ?>

                    </select></td>
                <td colspan="2">
                    <div>
                        <label><?php echo $this->lang->line('Update Stock') ?></label>
                        <fieldset class="right-radio">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="update_stock"
                                    id="customRadioRight1" value="yes" checked="">
                                <label class="custom-control-label"
                                    for="customRadioRight1"><?php echo $this->lang->line('Yes') ?></label>
                            </div>
                        </fieldset>
                        <fieldset class="right-radio">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="update_stock"
                                    id="customRadioRight2" value="no">
                                <label class="custom-control-label"
                                    for="customRadioRight2"><?php echo $this->lang->line('No') ?></label>
                            </div>
                        </fieldset>

                    </div>
                </td>
                <!-- <td align="right" colspan="4"><input type="button" class="btn btn-success sub-btn"
                        value="<?php echo $this->lang->line('Generate Order') ?>" id="submit-data"
                        data-loading-text="Creating...">

                </td> -->
            </tr>


        </tbody>
    </table>
</div>

<input type="hidden" value="purchase/action" id="action-url">
<input type="hidden" value="puchase_search" id="billtype">
<input type="hidden" value="<?php echo count($products) - 1; ?>" name="counter" id="ganak">
<input type="hidden" id="after_action" name="after_action" value="page_reload" />
<input type="hidden" value="<?php echo $this->config->item('currency'); ?>" name="currency">
<input type="hidden" value="<?= $taxdetails['handle']; ?>" name="taxformat" id="tax_format">

<input type="hidden" value="<?= $taxdetails['format']; ?>" name="tax_handle" id="tax_status">
<input type="hidden" value="yes" name="applyDiscount" id="discount_handle">


<input type="hidden" value="<?= $this->common->disc_status()['disc_format']; ?>" name="discountFormat"
    id="discount_format">
<input type="hidden" value="<?= amountFormat_general($this->common->disc_status()['ship_rate']); ?>" name="shipRate"
    id="ship_rate">
<input type="hidden" value="<?= $this->common->disc_status()['ship_tax']; ?>" name="ship_taxtype" id="ship_taxtype">
<input type="hidden" value="0" name="ship_tax" id="ship_tax">