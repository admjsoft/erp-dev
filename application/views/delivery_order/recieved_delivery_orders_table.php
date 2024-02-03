<?php if(!empty($do_orders)) { $ii=1; foreach($do_orders as $do_order){ ?>
    <tr><td><?php echo $ii; ?></td>
        <td><a href="#" class="do_details_display" do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>"> <?php echo $do_order['do_id']; ?></a></td>
        <td><a target="_blank" href="<?php echo base_url('purchase/view?id='.$do_order['po_id']); ?>" class="" ><?php echo $do_order['display_invoice_id']; ?></a></td>

        <td><?php echo $do_order['items']; ?></td>
    <td style="background-color:<?php if($do_order['status'] == 'partial' || $do_order['status'] == 'due'){ echo "#E68C70"; }else{echo "#39DAA9";}  ?>"><?php echo ($do_order['total_qty'] - $do_order['return_qty']); ?></td>
    <td><?php echo $do_order['balance_qty']; ?></td>
    <td style="background-color:<?php if($do_order['status'] == 'partial' || $do_order['status'] == 'due'){ echo "#E68C70"; }else{echo "#39DAA9";}  ?>"><?php echo $do_order['status']; ?></td>
    <td><?php echo $do_order['do_count']; ?></td>
    <td><?php echo date('d-m-Y',strtotime($do_order['cr_date'])); ?></td>
    <td>
        <?php if($do_order['do_type'] == 'po'){ ?>
            <a href="<?php echo base_url('deliveryorder/create_purchase_delivery_order?id='.$do_order['po_id']); ?>" class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>" ><i class="fa fa-edit"></i> <?php echo $this->lang->line('edit') ?></a> &nbsp; 
        <?php }else if($do_order['do_type'] == 'invoice'){ ?>
            <a href="<?php echo base_url('deliveryorder/create_invoice_delivery_order?id='.$do_order['invoice_id']); ?>" class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>" ><i class="fa fa-edit"></i> <?php echo $this->lang->line('edit') ?></a> &nbsp; 
        <?php  }else if($do_order['do_type'] == 'do'){ ?>
            <a href="<?php echo base_url('deliveryorder/create_purchase_delivery_order?id='.$do_order['po_id']); ?>" class="btn btn-primary btn-sm " do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>" ><i class="fa fa-edit"></i> <?php echo $this->lang->line('edit') ?></a> &nbsp; 
        <?php } ?>    
        &nbsp; 
        <a href="#" class="btn btn-warning btn-sm do_retrun_modal" do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>" ><i class="fa fa-reply"></i> <?php echo $this->lang->line('return') ?></a> &nbsp; 
        <?php if($do_order['status'] != 'completed'){ ?>
        <a href="#" class="btn btn-danger btn-sm do_cancel_modal"  do_type="<?php echo $do_order['do_type']; ?>" do_id="<?php echo $do_order['do_id']; ?>" ><i class="fa fa-trash"></i> <?php echo $this->lang->line('cancel') ?></a></td></tr>
        <?php } ?>
        <?php $ii++; }} ?>