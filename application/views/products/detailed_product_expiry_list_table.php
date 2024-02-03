<?php if(!empty($products)) { $ii=1; foreach($products as $product){ 
    if (((int)$product['delivered_qty'] - (int)$product['return_qty']) > (int)$product['total_used_qty']){ ?>  
<tr >                    
<td><?php echo $product['product_code']; ?></td>
<td><?php echo $product['title']; ?></td>
<td><?php echo $product['product_name']; ?></td>
<td><?php echo date('d-m-Y',strtotime($product['do_created_date'])); ?></td>
<td><?php if(!empty($product['do_expire_date'])){ echo date('d-m-Y',strtotime($product['do_expire_date'])); }else{ echo "---"; }  ?></td>
</tr>
<?php } $ii++; }} ?>