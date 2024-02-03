<?php if(!empty($products)) { $ii=1; foreach($products as $product){ ?>   
    <tr>
    <td><?php echo $product['delivery_order_id']; ?></td>
    <td><?php echo $product['supplier_delivery_order_id']; ?></td>
    <td><?php echo $product['product_name']; ?></td>
    <td><?php echo $product['product_code']; ?></td>
    <td><?php echo ((int)$product['delivered_qty'] - (int)$product['return_qty']); ?></td>
    <td><?php echo date('d-m-Y',strtotime($product['do_created_date'])); ?></td>
    <td><?php if(!empty($product['product_expiry_date'])){ echo date('d-m-Y',strtotime($product['product_expiry_date'])); } else { echo "----"; } ?></td>
    </tr>
    <?php $ii++; }} ?>