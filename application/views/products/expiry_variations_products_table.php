<?php if(!empty($products)) { $ii=1; foreach($products as $product){ ?>
    <tr><td><?php echo $ii; ?></td>
    <td><?php echo $product['product_name']; ?></td>
    <td><?php echo $product['product_code']; ?></td>
    <td ><a href="#"class="get_product_details" p_id="<?php echo $product['product_code']; ?>" ><?php echo (int)$product['total_qty']; ?></a></td>
    <td><?php echo $product['title']; ?></td>
    </tr>
<?php $ii++; }} ?>