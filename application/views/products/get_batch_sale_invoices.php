<?php if(!empty($invoices)) { $ii=1; foreach($invoices as $inv){ ?>   
    <tr>
    <td><a target="_blank" href="<?php echo base_url("invoices/view?id=".$inv['invoice_id']); ?>"> <?php echo $inv['invoice_tid']; ?></a></td>
    <td><?php echo $inv['name']; ?></td>
    <td><?php echo $inv['used_qty']; ?></td>
    <td><?php echo $inv['invoicedate']; ?></td>
    </tr>
    <?php $ii++; }} ?>