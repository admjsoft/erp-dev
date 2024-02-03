<?php if(!empty($products)) { $ii=1; foreach($products as $product){ ?>   
    <?php if (!empty($product['months_left'])) {
    if ($product['months_left'] <= 0) {
        $class_name = 'custom-class-red';
    } elseif ($product['months_left'] == 1) {
        $class_name = 'custom-class-red1';
    } elseif ($product['months_left'] == 2) {
        $class_name = 'custom-class-red2';
    } elseif ($product['months_left'] == 3) {
        $class_name = 'custom-class-red3';
    } else {
        // Handle other cases if needed
        $class_name = '';
    }
} ?>

    <tr class="<?php echo $class_name; ?>">  
    
    <td><?php echo $product['product_code']; ?></td>
    <td><?php echo $product['product_name']; ?></td>
    <td><?php echo $product['serial']; ?></td>
    <td><?php echo date('d-m-Y',strtotime($product['cr_date'])); ?></td>
    <td><?php if(!empty($product['product_expiry_date'])){ echo date('d-m-Y',strtotime($product['product_expiry_date'])); }else{ echo "---"; }  ?></td>
    </tr>
    <?php $ii++; }} ?>

