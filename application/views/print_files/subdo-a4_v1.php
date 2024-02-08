<!doctype html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Print Invoice #<?php echo $invoice['tid'] ?></title>
    <style>
    body {
        color: #2B2000;
        font-family: 'Helvetica';
    }

    .invoice-box {
        width: 210mm;
        height: 297mm;
        margin: auto;
        padding-left: 4mm;
        padding-right: 4mm;
        border: 0;
        font-size: 10pt;
        line-height: 14pt;
        color: #000;
    }

    table {
        width: 100%;
        line-height: 11pt;
        text-align: left;
        border-collapse: collapse;
    }

    .plist tr td {
        line-height: 10pt;
    }

    .subtotal {
        page-break-inside: avoid;
    }

    .subtotal tr td {
        line-height: 10pt;
        padding: 6pt;
    }

    .subtotal tr td {
        border: 1px solid #ddd;
    }

    .sign {
        text-align: right;
        font-size: 10pt;
        margin-right: 110pt;
    }

    .sign1 {
        text-align: right;
        font-size: 10pt;
        margin-right: 90pt;
    }

    .sign2 {
        text-align: right;
        font-size: 10pt;
        margin-right: 115pt;
    }

    .sign3 {
        text-align: right;
        font-size: 10pt;
        margin-right: 115pt;
    }

    .terms {
        font-size: 9pt;
        line-height: 16pt;
        margin-right: 20pt;
    }

    .invoice-box table td {
        padding: 10pt 4pt 8pt 4pt;
        vertical-align: top;
        font-size: 8pt !important;
        line-height: 10pt !important;
    }

    .invoice-box table th {
        padding: 10pt 4pt 8pt 4pt;
        vertical-align: top;
        font-size: 8pt !important;
        line-height: 10pt !important;
    }

    .invoice-box table.top_sum td {
        padding: 0;
        font-size: 12pt;
    }

    .party tr td:nth-child(3) {
        text-align: center;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20pt;
    }

    table tr.top table td.title {
        font-size: 45pt;
        line-height: 45pt;
        color: #555;
    }

    table tr.information table td {
        padding-bottom: 20pt;
    }

    table tr.heading th {
        background: #515151;
        color: #FFF;
        padding: 6pt;
        /* color: #000;
            padding: 6pt;
            border: 1px solid #dfdfdf; */
    }

    table tr.heading td {
        background: #515151;
        color: #FFF;
        padding: 6pt;
        /* color: #000;
            padding: 6pt;
            border: 1px solid #dfdfdf; */
    }

    /* table.plist tr.heading td {
            background: #515151;
            color: #FFF;
            padding: 6pt;
           
        } */

    table tr.details td {
        padding-bottom: 20pt;
    }

    .invoice-box table tr.item td {
        border: 1px solid #ddd;
    }

    table tr.b_class td {
        border-bottom: 1px solid #ddd;
    }

    table tr.b_class.last td {
        border-bottom: none;
    }

    table tr.total td:nth-child(4) {
        border-top: 2px solid #fff;
        font-weight: bold;
    }

    .myco {
        width: 400pt;
    }

    .myco2 {
        width: 200pt;
    }

    .myw {
        width: 300pt;
        font-size: 14pt;
        line-height: 14pt;
    }

    .mfill {
        /* background-color: #eee; */
    }

    .descr {
        font-size: 10pt;
        color: #515151;
    }

    .tax {
        font-size: 10px;
        color: #515151;
    }

    .t_center {
        text-align: right;
    }

    .party {
        border: #ccc 1px solid;

    }

    .top_logo {
        max-height: 180px;
        max-width: 250px;
        <?php if(LTR=='rtl') echo 'margin-left: 200px;'?>
    }
    </style>
</head>

<body dir="<?= LTR ?>">
    
    <div class="invoice-box">

        <br>
        <table class="party">
            <thead>
                <tr class="heading">
                    <td> <?php echo $this->lang->line('Our Info') ?>:</td>
                    <td><?= $general['person'] ?>:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><strong><?php $loc = location($invoice['loc']);
                    echo $loc['cname']; ?></strong><br>
                        <?php echo
                    $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br>' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $loc['email'];
                if ($loc['taxid']) echo '<br>' . $this->lang->line('TaxID') . ': ' . $loc['taxid'];
                ?>
                    </td>
                    <td>
                        <?php
                    if ($invoice['company']){  $company = $invoice['company']; }else{  $company = '';}
                echo '<strong>' . $company . '</strong><br>';
                if ($invoice['name']) echo $invoice['name'] . '<br>';

                echo $invoice['address'] . '<br>' . $invoice['city'] . ', ' . $invoice['region'];
                if ($invoice['country']) echo '<br>' . $invoice['country'];
                if ($invoice['postbox']) echo ' - ' . $invoice['postbox'];
                if ($invoice['phone']) echo '<br>' . $this->lang->line('Phone') . ': ' . $invoice['phone'];
                if ($invoice['email']) echo '<br> ' . $this->lang->line('Email') . ': ' . $invoice['email'];

               if ($invoice['taxid']) echo '<br>' . $this->lang->line('TaxID') . ': ' . $invoice['taxid'];
                if (is_array($c_custom_fields)) {
                    echo '<br>';
                    foreach ($c_custom_fields as $row) {
                        echo $row['name'] . ': ' . $row['data'] . '<br>';
                    }
                }
                ?>
                        </ul>
                    </td>
                </tr>
                <?php if (@$invoice['name_s']) {
             if($invoice['name_s'] != $invoice['name'] &&  $invoice['address_s'] != $invoice['address'] &&  $invoice['country_s'] != $invoice['country'] && 
             $invoice['postbox_s'] != $invoice['postbox'] &&  $invoice['phone_s'] != $invoice['phone'] &&  $invoice['email_s'] != $invoice['email']  ){ ?>
                <tr>
                    <td>
                        <?php echo '<strong>' . $this->lang->line('Shipping Address') . '</strong>:<br>';
                    echo $invoice['name_s'] . '<br>';
                    echo $invoice['address_s'] . '<br>' . $invoice['city_s'] . ', ' . $invoice['region_s'];
                    if ($invoice['country_s']) echo '<br>' . $invoice['country_s'];
                    if ($invoice['postbox_s']) echo ' - ' . $invoice['postbox_s'];
                    if ($invoice['phone_s']) echo '<br>' . $this->lang->line('Phone') . ': ' . $invoice['phone_s'];
                    if ($invoice['email_s']) echo '<br> ' . $this->lang->line('Email') . ': ' . $invoice['email_s'];

                    ?>
                    </td>
                </tr>
                <?php } } ?>
            </tbody>
        </table>
        <br>
    
        <?php if(!empty($do_list)) $dd=1; { foreach($do_list as $d_list){ ?>
        <?php if($dd == 1){ ?>
        <h2> DO No: # <?php echo $d_list['parent_do_id']; ?> </h2>
        <?php } ?>
        <h4>Sub Delivery Order No: # <?php echo $d_list['do_id']; ?></h4>
        <h4>Delivered Date: # <?php echo $d_list['cr_date']; ?></h4>
        
        <table class="plist" cellpadding="0" cellspacing="0">
        <thead>

            <tr class="heading">
                <th>#</th>
                <th><?php echo $this->lang->line("Item"); ?></th>
                <th class="text-xs-left"><?php echo $this->lang->line("Delivered Qty"); ?></th>
                <th class="text-xs-left"><?php echo $this->lang->line("Ordered Qty"); ?></th>
                <th class="text-xs-left"><?php echo $this->lang->line("Returned/Exchanged Qty"); ?></th>
                <th class="text-xs-left"><?php echo $this->lang->line("Return/Exchanged Description"); ?>
                </th>
                <?php /* if(!empty($do_option)){ ?><th><?php echo $this->lang->line("Options"); ?> </th>
                <?php } */ ?>
            </tr>
            </thead>
            <tbody>
            <?php if(!empty($d_list['delivery_order'])) { $i=1; foreach($d_list['delivery_order'] as $d_list_do){ ?>
            <tr>
                <th><?php echo $i; ?></th>
                <th><?php echo $d_list_do['product']; ?></th>
                <th class="text-xs-left"><?php echo (int)$d_list_do['delivered_qty']; ?></th>
                <th class="text-xs-left"><?php echo (int)$d_list_do['ordered_qty']; ?></th>
                <th class="text-xs-left"><?php echo (int)$d_list_do['return_qty']; ?></th>
                <th class="text-xs-left"><?php echo $d_list_do['description']; ?></th>

            </tr>
            <?php $i++; }} ?>
            </tbody>
        </table>
        <br> 
        <?php $dd++; }} ?>

    </div>
    </div>
</body>

</html>