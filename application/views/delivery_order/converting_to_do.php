<div class="content-body">
    <?php if ($this->session->flashdata("messagePr")) {?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata("messagePr") ?>
    </div>
    <?php }?>
    <div id="c_body"></div>
    <div class="card">
        <div class="card-content">

            <div class="row mt-2">
                <div class="col-md-12">
                    <h1 class="text-center">Confirmation of Purchase Order Delivery</h1>
                    <?php  
                $failed = 0;
                
                foreach ($products as $pr_row) {
                        //$sub_t += $row['price'] * $pr_row['qty'];
                        if(((int)$pr_row['total_delivery_qty'] - (int)$pr_row['return_qty']) != $pr_row['qty'])
                        {
                            $failed++;
                        }else{
                            

                        }}?>

                <?php if($failed <= 0) { ?>
                    <!-- <h3 class="text-center mt-2">All Products Delivered!!!</h3> -->
                    <img style="display: block; float: right; margin-right:25px; height: 100px; width: 100px;" src="<?php echo base_url('userfiles/company/delivered.jpeg'); ?>" />

                <?php  } ?>

                </div>
               
                
            </div>
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div id="invoice-template" class="card-body">
                <div class="row wrapper white-bg page-heading">


                </div>

                <!-- Invoice Company Details -->
                <div id="invoice-company-details" class="row mt-2">
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                        <p></p>
                        <img src="<?php $loc = location($invoice['loc']);
echo base_url('userfiles/company/' . $loc['logo'])?>" class="img-responsive p-1 m-b-2" style="max-height: 120px;">
                        <p class="ml-2"><?=$loc['cname']?></p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
                        <h2><?php echo $this->lang->line('Purchase Order') ?></h2>
                        <p class="pb-1"> <?php echo prefix(2) . $invoice['tid'];?></p>

                        <ul class="px-0 list-unstyled">
                            <li><?php echo $this->lang->line('Gross Amount') ?></li>
                            <li class="lead text-bold-800">
                                <?php echo amountExchange($invoice['total'], 0, $this->aauth->get_user()->loc) ?></li>
                        </ul>
                    </div>
                </div>
                <!--/ Invoice Company Details -->

                <!-- Invoice Customer Details -->
                <div id="invoice-customer-details" class="row pt-2">
                    <div class="col-sm-12 text-xs-center text-md-left">
                        <p class="text-muted"><?php echo $this->lang->line('Bill From') ?></p>
                    </div>
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                        <ul class="px-0 list-unstyled">


                            <li class="text-bold-800"><a
                                    href="<?php echo base_url('supplier/view?id=' . $invoice['cid']) ?>"><strong
                                        class="invoice_a"><?php echo $invoice['name'] . '</strong></a></li><li>' . $invoice['address'] . '</li><li>' . $invoice['city'] . ',' . $invoice['country'] . '</li><li>' . $this->lang->line('Phone') . ': ' . $invoice['phone'] . '</li><li>' . $this->lang->line('Email') . ': ' . $invoice['email']; ?>
                            </li>
                        </ul>

                    </div>
                    <div class="offset-md-3 col-md-3 col-sm-12 text-xs-center text-md-left">
                        <?php echo '<p><span class="text-muted">' . $this->lang->line('Order Date') . ' :</span> ' . dateformat($invoice['invoicedate']) . '</p> <p><span class="text-muted">' . $this->lang->line('Due Date') . ' :</span> ' . dateformat($invoice['invoiceduedate']) . '</p>  <p><span class="text-muted">' . $this->lang->line('Terms') . ' :</span> ' . $invoice['termtit'] . '</p>';
?>
                    </div>
                </div>
                <!--/ Invoice Customer Details -->

                <!-- Invoice Items Details -->
                <div id="invoice-items-details" class="pt-2">

                <div class="row mb-2">
                <div class="col-md-8">
    </div> 
                <div class="col-md-4 float-right">
                    <label>Supplier DO No :</label>
                    <input type="text" class="form-control" id="supplier_do_no" name="supplier_do_no" />
                </div>
                </div>
                    <div class="row">
                        <div class="table-responsive col-sm-12">
                            <table class="table table-striped">
                                <thead>
                                    <?php if ($invoice['taxstatus'] == 'cgst') {?>

                                    <tr>
                                        <th>#</th>
                                        <th><?php echo $this->lang->line('Description') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('HSN') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('Rate') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('Purchasing Quantity') ?>
                                        </th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('Discount') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('CGST') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('SGST') ?></th>
                                        <th class="text-xs-left"><?php echo $this->lang->line('Amount') ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1;
    $sub_t = 0;

    foreach ($products as $row) {
        $sub_t += $row['price'] * $row['qty'];
        $gst = $row['totaltax'] / 2;
        $rate = $row['tax'] / 2;
        echo '<tr>
<th scope="row">' . $c . '</th>
                            <td>' . $row['product'] . '</td>
                            <td>' . $row['code'] . '</td>
                            <td>' . amountExchange($row['price'], 0, $this->aauth->get_user()->loc) . '</td>
                             <td>' . amountFormat_general($row['qty']) . $row['unit'] . '</td>
                              <td>' . amountExchange($row['totaldiscount'], 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($row['discount']) . $this->lang->line($invoice['format_discount']) . ')</td>
                            <td>' . amountExchange($gst, 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($rate) . '%)</td>
                             <td>' . amountExchange($gst, 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($rate) . '%)</td>
                            <td>' . amountExchange($row['subtotal'], 0, $this->aauth->get_user()->loc) . '</td>
                        </tr>';

        echo '<tr><td colspan=5>' . $row['product_des'] . '</td></tr>';
        $c++;
    }?>

                                </tbody>
                                <?php

} elseif ($invoice['taxstatus'] == 'igst') {
    ?>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo $this->lang->line('Description') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('HSN') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Rate') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Purchasing Quantity') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Discount') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('IGST') ?></th>

                                    <th class="text-xs-left"><?php echo $this->lang->line('Amount') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1;
    $sub_t = 0;

    foreach ($products as $row) {
        $sub_t += $row['price'] * $row['qty'];

        echo '<tr>
<th scope="row">' . $c . '</th>
                            <td>' . $row['product'] . '</td>
                            <td>' . $row['code'] . '</td>
                            <td>' . amountExchange($row['price'], 0, $this->aauth->get_user()->loc) . '</td>
                             <td>' . amountFormat_general($row['qty']) . $row['unit'] . '</td>
                              <td>' . amountExchange($row['totaldiscount'], 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($row['discount']) . $this->lang->line($invoice['format_discount']) . ')</td>
                            <td>' . amountExchange($row['totaltax'], 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($row['tax']) . '%)</td>

                            <td>' . amountExchange($row['subtotal'], 0, $this->aauth->get_user()->loc) . '</td>
                        </tr>';

        echo '<tr><td colspan=5>' . $row['product_des'] . '</td></tr>';
        $c++;
    }?>

                                </tbody>
                                <?php
} else {
    ?>
                                <tr>
                                    <th>#</th>
                                    <th><?php echo $this->lang->line('Item') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Rate') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Purchasing Quantity') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Deliver Qty') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Delivered Qty') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Pending Qty') ?></th>
                                    <th class="text-xs-left"><?php echo $this->lang->line('Expiry Date') ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                    <?php $c = 1;
    $sub_t = 0;

    foreach ($products as $row) {
        $sub_t += $row['price'] * $row['qty'];
        if(((int)$row['total_delivery_qty']-(int)$row['return_qty']) < (int)$row['qty'])
        {
            $do_items_class= ' do_items_list';
            $do_items_d_status= '';
        }else{
            $do_items_class= ' ';
            $do_items_d_status= 'disabled';
        }
        
        echo '<tr>
<th scope="row">' . $c . '</th>
                            <td>' . $row['product'] . '</td>
                            <td>' . amountExchange($row['price'], 0, $this->aauth->get_user()->loc) . '</td>
                            <td>' . ((int)$row['qty']) . '</td> 
                            <td><input '.$do_items_d_status.' style="width: 50px;" po_id="'.$row['tid'].'" p_id="'.$row['pid'].'" class="xs form-control '.$do_items_class.'" type="number" value="' . ((int)$row['qty'] - ((int)$row['total_delivery_qty'] - (int)$row['return_qty'])) . '" /></td>
                             <td>' . ((int)$row['total_delivery_qty'] - (int)$row['return_qty'] ) . '</td>
                             <td>' . ((int)$row['qty'] - ((int)$row['total_delivery_qty'] - (int)$row['return_qty'])) . '</td>
                             <td><input '.$do_items_d_status.'  class="xs form-control do_items_dates " type="date"  /></td>
                        </tr>';

        echo '<tr><td colspan=5>' . $row['product_des'] . '</td></tr>';
        $c++;
    }?>

                                </tbody>
                                <?php }?>
                            </table>
                        </div>
                    </div>
                    <p></p>
                    <div class="row">
                        <div class="col-md-7 col-sm-12 text-xs-center text-md-left">


                            <div class="row">
                                <div class="col-md-8">
                                    <p class="lead"><?php echo $this->lang->line('Payment Status') ?>:
                                        <u><strong
                                                id="pstatus"><?php echo $this->lang->line(ucwords($invoice['status'])) ?></strong></u>
                                    </p>
                                    <p class="lead"><?php echo $this->lang->line('Payment Method') ?>: <u><strong
                                                id="pmethod"><?php echo $this->lang->line($invoice['pmethod']) ?></strong></u>
                                    </p>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-5 col-sm-12">

                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6"></div> <!-- Add an empty column to take up space on the left -->
                        <div class="col-lg-6 text-right">
                            <!-- Align content to the right -->
                            <div class="title-action">
                                <?php if ($invoice['status'] == 'paid') { ?>
                                <a href="#" class="btn btn-success" onclick="getDataAndSendToController()">
                                    <i class="fa fa-briefcase"></i> <?php echo $this->lang->line('Confirm DO') ?>
                                </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Invoice Footer -->

            </div>

        </div>
    </div>

</div>
<script src="<?php echo assets_url('assets/myjs/jquery.ui.widget.js') ?>"></script>
<script src="<?php echo assets_url('assets/myjs/jquery.fileupload.js') ?>"></script>
<script>
/*jslint unparam: true */
/*global window, $ */
$(function() {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '<?php echo base_url() ?>purchase/file_handling?id=<?php echo $invoice['iid'] ?>';
    $('#fileupload').fileupload({
            url: url,
            dataType: 'json',
            formData: {
                '<?=$this->security->get_csrf_token_name()?>': crsf_hash
            },
            done: function(e, data) {
                $.each(data.result.files, function(index, file) {
                    $('#files').append(
                        '<tr><td><a data-url="<?php echo base_url() ?>purchase/file_handling?op=delete&name=' +
                        file.name +
                        '&invoice=<?php echo $invoice['iid'] ?>" class="aj_delete"><i class="btn-danger btn-sm fa fa-trash"></i> ' +
                        file.name + ' </a></td></tr>');
                });
            },
            progressall: function(e, data) {
                var progress = parseInt(data.loaded / data.total * 100, 10);
                $('#progress .progress-bar').css(
                    'width',
                    progress + '%'
                );
            }
        }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});

$(document).on('click', ".aj_delete", function(e) {
    e.preventDefault();
    var aurl = $(this).attr('data-url');
    var obj = $(this);
    jQuery.ajax({
        url: aurl,
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            obj.closest('tr').remove();
            obj.remove();
        }
    });

});
</script>
<!-- Modal HTML -->
<div id="part_payment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Debit Payment Confirmation') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form class="payment">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-addon"><?php echo $this->config->item('currency') ?></div>
                                <input type="text" class="form-control" placeholder="Total Amount" name="amount"
                                    id="rmpay" value="<?php echo $rming ?>">
                            </div>

                        </div>
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon-calendar4" aria-hidden="true"></span>
                                </div>
                                <input type="text" class="form-control required" id="tsn_date"
                                    placeholder="Billing Date" name="paydate"
                                    value="<?php echo dateformat($this->config->item('date')); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1"><label
                                for="pmethod"><?php echo $this->lang->line('Payment Method') ?></label>
                            <select name="pmethod" class="form-control mb-1">
                                <option value="Cash"><?php echo $this->lang->line('Cash') ?></option>
                                <option value="Card"><?php echo $this->lang->line('Card') ?></option>
                                <option value="Bank">Bank</option>
                            </select><label for="account"><?php echo $this->lang->line('Account') ?></label>

                            <select name="account" class="form-control">
                                <?php foreach ($acclist as $row) {
    echo '<option value="' . $row['id'] . '">' . $row['holder'] . ' / ' . $row['acn'] . '</option>';
}
?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Note') ?></label>
                            <input type="text" class="form-control" name="shortnote" placeholder="Short note"
                                value="Payment for purchase #<?php echo $invoice['tid'] ?>">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control required" name="tid" id="invoiceid"
                            value="<?php echo $invoice['iid'] ?>">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                        <input type="hidden" name="cid" value="<?php echo $invoice['cid'] ?>"><input type="hidden"
                            name="cname" value="<?php echo $invoice['name'] ?>">
                        <button type="button" class="btn btn-primary"
                            id="purchasepayment"><?php echo $this->lang->line('Do Payment') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cancel -->
<div id="cancel_bill" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Cancel Purchase Order') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

            </div>
            <div class="modal-body">
                <form class="cancelbill">
                    <div class="row">
                        <div class="col">
                            <?php echo $this->lang->line('this action! Are you sure') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" class="form-control" name="tid" value="<?php echo $invoice['iid'] ?>">
                        <button type="button" class="btn btn-default" data-dismiss="modal">
                            <?php echo $this->lang->line('Close') ?></button>
                        <button type="button" class="btn btn-primary" id="send">
                            <?php echo $this->lang->line('Cancel') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Modal HTML -->
<div id="sendEmail" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title">Email</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div id="request">
                <div id="ballsWaveG">
                    <div id="ballsWaveG_1" class="ballsWaveG"></div>
                    <div id="ballsWaveG_2" class="ballsWaveG"></div>
                    <div id="ballsWaveG_3" class="ballsWaveG"></div>
                    <div id="ballsWaveG_4" class="ballsWaveG"></div>
                    <div id="ballsWaveG_5" class="ballsWaveG"></div>
                    <div id="ballsWaveG_6" class="ballsWaveG"></div>
                    <div id="ballsWaveG_7" class="ballsWaveG"></div>
                    <div id="ballsWaveG_8" class="ballsWaveG"></div>
                </div>
            </div>
            <div class="modal-body" id="emailbody" style="display: none;">
                <form id="sendbill">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon-envelope-o" aria-hidden="true"></span>
                                </div>
                                <input type="text" class="form-control" placeholder="Email" name="mailtoc"
                                    value="<?php echo $invoice['email'] ?>">
                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Supplier') ?></label>
                            <input type="text" class="form-control" name="customername"
                                value="<?php echo $invoice['name'] ?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Subject') ?></label>
                            <input type="text" class="form-control" name="subject" id="subject">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Message') ?></label>
                            <textarea name="text" class="summernote" id="contents" title="Contents"></textarea>
                        </div>
                    </div>

                    <input type="hidden" class="form-control" id="invoiceid" name="tid"
                        value="<?php echo $invoice['iid'] ?>">
                    <input type="hidden" class="form-control" id="emailtype" value="">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                <button type="button" class="btn btn-primary"
                    id="sendM"><?php echo $this->lang->line('Send') ?></button>
            </div>
        </div>
    </div>
</div>

<div id="pop_model" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo $this->lang->line('Change Status') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <form id="form_model" method="post" enctype="multipart/form-data"
                    action="<?php echo base_url("purchase/update_status") ?>">


                    <div class="row">
                        <div class="col mb-1"><label for="pmethod"><?php echo $this->lang->line('Mark As') ?></label>
                            <select name="status" class="form-control mb-1">
                                <option value="paid"><?php echo $this->lang->line('Paid') ?></option>
                                <option value="due"><?php echo $this->lang->line('Due') ?></option>
                                <option value="partial"><?php echo $this->lang->line('Partial') ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1"><label
                                for="pmethod"><?php echo $this->lang->line('Payment Method') ?></label>
                            <select name="pmethod" class="form-control"
                                <?php if ($invoice['status'] == 'paid') {echo "readonly";}?>>
                                <option value="Cash"><?php echo $this->lang->line('Cash') ?></option>
                                <option value="Card"><?php echo $this->lang->line('Card') ?></option>
                                <option value="Balance"><?php echo $this->lang->line('Wallet') ?></option>
                                <option value="Bank"><?php echo $this->lang->line('Bank') ?></option>
                            </select>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1">
                            <label for="account"><?php echo $this->lang->line('Account') ?></label>

                            <select name="status_account" class="form-control">
                                <?php foreach ($acclist as $a_row) {
    echo '<option value="' . $a_row['id'] . '">' . $a_row['holder'] . ' / ' . $a_row['acn'] . '</option>';
}
?>
                            </select>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col mb-1"><label
                                for="pmethod"><?php echo $this->lang->line('Amount') ?></label></br>
                            <input type="text" name="amount" id="amount" class="form-control"
                                <?php if ($invoice['status'] == 'paid') {echo "readonly";}?>>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label for="pmethod"><?php echo $this->lang->line('Note') ?></label></br>
                            <textarea name="note" id="note" class="form-control"
                                <?php if ($invoice['status'] == 'paid') {echo "readonly";}?>></textarea>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col mb-1"><label
                                for="pmethod"><?php echo $this->lang->line('Proof Of Payment') ?></label></br>
                            <input type="file" name="userfile" method="post" action=""
                                <?php if ($invoice['status'] == 'paid') {echo "disabled";}?>>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="cid" value="<?php echo $invoice['cid'] ?>"><input type="hidden"
                            name="cname" value="<?php echo $invoice['name'] ?>">
                        <input type="hidden" class="form-control required" name="tid" id="invoiceid"
                            value="<?php echo $invoice['iid'] ?>">
                        <button type="button" class="btn btn-default"
                            data-dismiss="modal"><?php echo $this->lang->line('Close') ?></button>
                        <input type="hidden" id="action-url" value="purchase/update_status">
                        <button type="submit" id="change_status_btn"
                            class="btn btn-primary"><?php echo $this->lang->line('Change Status') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="sendSMS" class="modal fade">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Send'); ?> SMS</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div id="request_sms">
                <div id="ballsWaveG1">
                    <div id="ballsWaveG_1" class="ballsWaveG"></div>
                    <div id="ballsWaveG_2" class="ballsWaveG"></div>
                    <div id="ballsWaveG_3" class="ballsWaveG"></div>
                    <div id="ballsWaveG_4" class="ballsWaveG"></div>
                    <div id="ballsWaveG_5" class="ballsWaveG"></div>
                    <div id="ballsWaveG_6" class="ballsWaveG"></div>
                    <div id="ballsWaveG_7" class="ballsWaveG"></div>
                    <div id="ballsWaveG_8" class="ballsWaveG"></div>
                </div>
            </div>
            <div class="modal-body" id="smsbody" style="display: none;">
                <form id="sendsms">
                    <div class="row">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group-addon"><span class="icon-envelope-o" aria-hidden="true"></span>
                                </div>
                                <input type="text" class="form-control" placeholder="SMS" name="mobile"
                                    value="<?php echo $invoice['phone'] ?>">
                            </div>

                        </div>

                    </div>


                    <div class="row">
                        <div class="col mb-1"><label
                                for="shortnote"><?php echo $this->lang->line('Customer Name'); ?></label>
                            <input type="text" class="form-control" value="<?php echo $invoice['name'] ?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-1"><label for="shortnote"><?php echo $this->lang->line('Message'); ?></label>
                            <textarea class="form-control" name="text_message" id="sms_tem" title="Contents"
                                rows="3"></textarea>
                        </div>
                    </div>


                    <input type="hidden" class="form-control" id="smstype" value="">


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"
                    data-dismiss="modal"><?php echo $this->lang->line('Close'); ?></button>
                <button type="button" class="btn btn-primary"
                    id="submitSMS"><?php echo $this->lang->line('Send'); ?></button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="po_id" name="po_id" value="<?php echo $id; ?>" />
<script type="text/javascript">
$(function() {
    $('.summernote').summernote({
        height: 100,
        toolbar: [
            // [groupName, [list of button]]
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['fullscreen', ['fullscreen']],
            ['codeview', ['codeview']]
        ]
    });

    $('#sendM').on('click', function(e) {
        e.preventDefault();

        sendBill($('.summernote').summernote('code'));

    });
});



$(document).on('click', "#cancel-bill_p", function(e) {
    e.preventDefault();

    $('#cancel_bill').modal({
        backdrop: 'static',
        keyboard: false
    }).one('click', '#send', function() {
        var acturl = 'transactions/cancelpurchase';
        cancelBill(acturl);

    });
});

function getDataAndSendToController() {

    var do_no = $('#supplier_do_no').val();

    if(do_no != '')
    {

    
    Swal.fire({
        title: "Do you want to Confirm DO?",
        showCancelButton: true,
        confirmButtonText: "Yes",
    }).then((result) => {
        /* Read more about isConfirmed, isDenied below */
        if (result.isConfirmed) {

            // Get all elements with the class "do_items_list"
            var elements = document.getElementsByClassName('do_items_list');
            var elementsDates = document.getElementsByClassName('do_items_dates');
            // Convert HTMLCollection to an array using Array.from
            var inputElements = Array.from(elements);
            var inputDateElements = Array.from(elementsDates);

            // Create an array to store the data
            var inputData = [];

            // Iterate through the input elements and extract attributes
            inputElements.forEach(function(input, index) {
                var inputAttributes = {
                    // // Your attribute extraction logic here
                    // po_id: input.getAttribute('po_id'),
                    value: input.value,
                    po_id: input.getAttribute('po_id'),
                    p_id: input.getAttribute('p_id'),
                    date: inputDateElements[index].value
                    // Add more attributes as needed
                };

                // Push the attribute object to the array
                inputData.push(inputAttributes);
            });

            // Log the data to the console for verification
            // console.log(inputData);

            // Uncomment the following code to send the data to the controller using AJAX
            var po_id = $("#po_id").val();

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: '<?php echo base_url('deliveryorder/update_delivery_order') ?>',
                data: {
                    inputData: JSON.stringify(inputData),
                    po_id: po_id,
                    do_no: do_no
                },
                success: function(response) {

                    if (response.status == '200') {
                        //alert(response.message);
                        Swal.fire({
                      icon: "success",
                      title: response.message,
                      showConfirmButton: false,
                      timer: 1500
                    });
                        //location.reload();
                        window.location.href ='<?php echo base_url('deliveryorder/recieved_list') ?>';
                    } else {
                        //alert(response.message);
                        Swal.fire({
                            icon: "error",
                            title: response.message,
                            showConfirmButton: false,
                            timer: 1500
                            });
                    }
                    // Handle the response from the controller
                    // console.log(response);
                },
                error: function(error) {
                    // console.error(error);
                }
            });

        } else if (result.isDenied) {
            Swal.fire("Changes are not saved", "", "info");
        }
    });

}else{

    Swal.fire({
                icon: "error",
                title: "Please Enter Supplier DO No",
                showConfirmButton: false,
                timer: 1500
                });

}

}
</script>