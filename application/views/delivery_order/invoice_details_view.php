<div class="card-content">
<?php 
$validtoken = hash_hmac('ripemd160', $invoice['iid'], $this->config->item('encryption_key'));

$link = base_url('billing/view?id=' . $invoice['iid'] . '&token=' . $validtoken);
?>
    <!-- Invoice Company Details -->
    <div id="invoice-company-details" class="row mt-2">
        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
            <p></p>
            <img src="<?php $loc = location($invoice['loc']);
                        echo base_url('userfiles/company/' . $loc['logo']) ?>" class="img-responsive p-1 m-b-2"
                style="max-height: 120px;">
            <p class="ml-2"><?= $loc['cname'] ?></p>
        </div>
        <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
            <h2><?php echo $this->lang->line('INVOICE') ?></h2>
            <p class="pb-1"> <?php echo $this->config->item('prefix') . ' ' . $invoice['tid'] . '</p>
                            <p class="pb-1">' . $this->lang->line('Reference') . ':' . $invoice['refer'] . '</p>'; ?>
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
            <p class="text-muted"><?php echo $this->lang->line('Bill To') ?></p>
        </div>
        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
            <ul class="px-0 list-unstyled">


                <li class="text-bold-800"><a
                        href="<?php echo base_url('customers/view?id=' . $invoice['cid']) ?>"><strong class="invoice_a"><?php echo $invoice['name'] . '</strong></a></li><li>' . $invoice['company'] . '</li><li>' . $invoice['address'] . '</li><li>' . $invoice['city'] . ',' . $invoice['country'] . '</li><li>' . $this->lang->line('Phone') . ': ' . $invoice['phone'] . '</li><li>' . $this->lang->line('Email') . ': ' . $invoice['email'] . '</li>';
                                foreach ($c_custom_fields

                                as $row) {
                                echo '  <li>' . $row['name'] . ': ' . $row['data'] ?></li>

                <?php } ?>


            </ul>

        </div>
        <div class="offset-md-3 col-md-3 col-sm-12 text-xs-center text-md-left">
            <?php echo '<p><span class="text-muted">' . $this->lang->line('Invoice Date') . '  :</span> ' . dateformat($invoice['invoicedate']) . '</p> <p><span class="text-muted">' . $this->lang->line('Due Date') . ' :</span> ' . dateformat($invoice['invoiceduedate']) . '</p>  <p><span class="text-muted">' . $this->lang->line('Terms') . ' :</span> ' . $invoice['termtit'] . '</p>';
                        ?>
        </div>
    </div>
    <!--/ Invoice Customer Details -->

    <!-- Invoice Items Details -->
    <div id="invoice-items-details" class="pt-2">
        <div class="row">
            <div class="table-responsive col-sm-12">
                <table class="table table-striped">
                    <thead>
                        <?php if ($invoice['taxstatus'] == 'cgst'){ ?>

                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Item') ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line('HSN') ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line('Rate') ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line('Purchasing Quantity') ?></th>
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
                                       if($row['serial']) $row['product_des'].=' - '.$row['serial'];
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
                                } ?>

                    </tbody>
                    <?php

                                } elseif ($invoice['taxstatus'] == 'igst') {
                                    ?>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Item') ?></th>
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
   if($row['serial']) $row['product_des'].=' - '.$row['serial'];
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
                                    } ?>

                    </tbody>
                    <?php
                                } else {
                                    ?>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Item') ?></th>
                        <th class="text-xs-left"><?php echo $this->lang->line('Rate') ?></th>
                        <th class="text-xs-left"><?php echo $this->lang->line('Purchasing Quantity') ?></th>
                        <th class="text-xs-left"><?php echo $this->lang->line('Tax') ?></th>
                        <th class="text-xs-left"><?php echo $this->lang->line('Discount') ?></th>
                        <th class="text-xs-left"><?php echo $this->lang->line('Amount') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $c = 1;
                                    $sub_t = 0;

                                    foreach ($products as $row) {
                                        $sub_t += $row['price'] * $row['qty'];
                                        if($row['serial']) $row['product_des'].=' - '.$row['serial'];
                                        echo '<tr>
<th scope="row">' . $c . '</th>
                            <td>' . $row['product'] . '</td>
                            <td>' . amountExchange($row['price'], 0, $this->aauth->get_user()->loc) . '</td>
                             <td>' . amountFormat_general($row['qty']) . $row['unit'] . '</td>
                            <td>' . amountExchange($row['totaltax'], 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($row['tax']) . '%)</td>
                            <td>' . amountExchange($row['totaldiscount'], 0, $this->aauth->get_user()->loc) . ' (' . amountFormat_s($row['discount']) . $this->lang->line($invoice['format_discount']) . ')</td>
                            <td>' . amountExchange($row['subtotal'], 0, $this->aauth->get_user()->loc) . '</td>
                        </tr>';

                                        echo '<tr><td colspan=5>' . $row['product_des'] . '</td></tr>';
                                        $c++;
                                    } ?>

                    </tbody>
                    <?php } ?>
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

                        <p class="lead mt-1"><br><?php echo $this->lang->line('Note') ?>:</p>
                        <code>
                                        <?php echo $invoice['notes'] ?>
                                    </code>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-sm-12">
                <p class="lead"><?php echo $this->lang->line('Summary') ?></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td><?php echo $this->lang->line('Sub Total') ?></td>
                                <td class="text-xs-right">
                                    <?php echo amountExchange($sub_t, 0, $this->aauth->get_user()->loc) ?></td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Tax') ?></td>
                                <td class="text-xs-right">
                                    <?php echo amountExchange($invoice['tax'], 0, $this->aauth->get_user()->loc) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Discount') ?></td>
                                <td class="text-xs-right">
                                    <?php echo amountExchange($invoice['discount'], 0, $this->aauth->get_user()->loc) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Shipping') ?></td>
                                <td class="text-xs-right">
                                    <?php echo amountExchange($invoice['shipping'], 0, $this->aauth->get_user()->loc) ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-bold-800"><?php echo $this->lang->line('Total') ?></td>
                                <td class="text-bold-800 text-xs-right">
                                    <?php echo amountExchange($invoice['total'], 0, $this->aauth->get_user()->loc) ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo $this->lang->line('Payment Made') ?></td>
                                <td class="pink text-xs-right">
                                    (-)
                                    <?php echo ' <span id="paymade">' . amountExchange($invoice['pamnt'], 0, $this->aauth->get_user()->loc) ?></span>
                                </td>
                            </tr>
                            <tr class="bg-grey bg-lighten-4">
                                <td class="text-bold-800"><?php echo $this->lang->line('Balance Due') ?></td>
                                <td class="text-bold-800 text-xs-right">
                                    <?php $myp = '';
                                            $rming = $invoice['total'] - $invoice['pamnt'];
                                            if ($rming < 0) {
                                                $rming = 0;

                                            }
                                            echo ' <span id="paydue">' . amountExchange($rming, 0, $this->aauth->get_user()->loc) . '</span></strong>'; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="text-xs-center">
                    <p><?php echo $this->lang->line('Authorized person') ?></p>
                    <?php if(!empty($employee)){ ?>

                    <?php /* echo '<img src="' . base_url('userfiles/employee_sign/' . $employee['sign']) . '" alt="signature" class="height-100"/>
                                    <h6>(' . $employee['name'] . ')</h6>
                                    <p class="text-muted">' . user_role($employee['roleid']) . '</p>'; */ ?>
                    <?php 
                                echo '<img src="' . base_url('userfiles/employee_sign/' . (!empty($employee['sign']) ? $employee['sign'] : '')) . '" alt="signature" class="height-100"/>
                                    <h6>' . (!empty($employee['name']) ? $employee['name'] : '') . '</h6>
                                    <p class="text-muted">' . (!empty($employee['roleid']) ? user_role($employee['roleid']) : '') . '</p>';
                                ?>

                    <?php }else{ ?>
                    <p>Not Available</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Invoice Footer -->
    <?php if(is_array($custom_fields)) {
                        echo '<div class="card">';
                        foreach ($custom_fields as $row) {
                            ?>
    <hr>
    <div class="row m-t-lg">
        <div class="col-md-2">
            <strong><?php echo $row['name'] ?></strong>
        </div>
        <div class="col-md-10">
            <?php echo $row['data'] ?>
        </div>

    </div>


    <?php


                        }   echo '</div>';
                    }
                                            ?>
    <div id="invoice-footer">
        <p class="lead"><?php echo $this->lang->line('Credit Transactions') ?>:</p>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Date') ?></th>
                    <th><?php echo $this->lang->line('Method') ?></th>
                    <th><?php echo $this->lang->line('Debit') ?></th>
                    <th><?php echo $this->lang->line('Credit') ?></th>
                    <th><?php echo $this->lang->line('Note') ?></th>
                    <th><?php echo $this->lang->line('Proof Of Payment') ?></th>


                </tr>
            </thead>
            <tbody id="activity">
                <?php 
						foreach ($activity as $row) {
$docurl="../userfiles/documents/".$row['payment_proof'];
                            echo '<tr>
                            <td><a href="view_payslip?id=' . $row['id'] . '&inv=' . $invoice['iid'] . '" target="_blank” class="btn btn-blue btn-sm"><span class="icon-print" aria-hidden="true"></span> ' . $this->lang->line('Print') . '  </a> ' . $row['date'] . '</td>
                            <td>' . $this->lang->line($row['method']) . '</td>

                              <td>' . amountExchange($row['debit'], 0, $this->aauth->get_user()->loc) . '</td>
                               <td>' . amountExchange($row['credit'], 0, $this->aauth->get_user()->loc) . '</td>
                            <td>' . $row['note'] . '</td>
							                            <td><a href="'.$docurl.'" target="_blank">' . $row['payment_proof'] . '</a></td>

                        </tr>';
                        } ?>

            </tbody>
        </table>

        <div class="row">

            <div class="col-md-7 col-sm-12">

                <h6><?php //echo $this->lang->line('Terms & Condition') ?></h6>
                <p> <?php

                                echo '<strong>' . $invoice['termtit'] . '</strong><br>' . $invoice['terms'];
                                ?></p>
            </div>

        </div>

    </div>
    <!--/ Invoice Footer -->
    <hr>
    <pre><?php echo $this->lang->line('Public Access URL') ?>: <?php
                    echo $link ?></pre>

    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->lang->line('Files') ?></th>


                </tr>
            </thead>
            <tbody id="activity">
                <?php foreach ($attach as $row) {

                            echo '<tr><td><a data-url="' . base_url() . 'invoices/file_handling?op=delete&name=' . $row['col1'] . '&invoice=' . $invoice['iid'] . '" class="aj_delete"><i class="btn-danger btn-lg fa fa-trash"></i></a> <a class="n_item" target="_blank"  href="' . base_url() . 'userfiles/attach/' . $row['col1'] . '"> ' . $row['col1'] . ' </a></td></tr>';
                        } ?>

            </tbody>
        </table>
    </div>
    <div class="card">
        <pre>Allowed: gif, jpeg, png, docx, docs, txt, pdf, xls </pre>
        <br>
        <!-- The fileinput-button span is used to style the file input field as button -->
        <div class="btn btn-success fileinput-button display-block">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Select files...</span>
            <!-- The file input field used as target for the file upload widget -->
            <input id="fileupload" type="file" name="files[]" multiple>
        </div>
    </div>

    <!-- The global progress bar -->
    <div id="progress" class="progress progress-sm mt-1 mb-0">
        <div class="progress-bar bg-success" role="progressbar" style="width: 0%" aria-valuenow="0" aria-valuemin="0"
            aria-valuemax="100"></div>
    </div>

    <!-- The container for the uploaded files -->
    <table id="files" class="files table table-striped"></table>
    <br>

</div>
</div>