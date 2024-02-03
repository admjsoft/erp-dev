<?php if(!empty($products)) { $ii=1; foreach($products as $product){ ?>
    <tr><td><?php echo $ii; ?></td>
    <td><?php echo $product['product_name']; ?></td>
    <td><?php echo $product['product_code']; ?></td>    
    <td><?php echo $product['title']; ?></td>
    <td ><a href="#"class="get_product_details" p_id="<?php echo $product['pid']; ?>" ><?php echo (int)$product['qty']; ?></a></td>

   
<?php $ii++; }} ?>