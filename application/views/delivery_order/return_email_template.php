<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Order Status</title>
    <style>
        body {
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #3498db; /* Updated to blue */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #fff; /* Updated to white */
            background-color: #2980b9; /* Updated to a darker blue */
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 100%;
            height: auto;
        }

        .plist {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .plist th, .plist td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .plist th {
            background-color: #3498db; /* Updated to blue */
            color: #fff; /* Updated to white */
            font-weight: bold;
        }

        .text-xs-left {
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
        <img src="<?php base_url('userfiles/company/1678769032464681502.png'); ?>" class="top_logo">
    
        </div>
        <h2>The Delivery Order: <?php echo $parent_do_id; ?> has been raised Return Request successfully</h2>
        
        <table class="plist" cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th class="text-xs-left">Delivered Qty</th>
                    <th class="text-xs-left">Ordered Qty</th>
                    <th class="text-xs-left">Returned/Exchanged Qty</th>
                    <th class="text-xs-left">Return/Exchanged Description</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($delivery_order)) { $i = 1; foreach ($delivery_order as $d_list_do) { ?>
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
    </div>
</body>
</html>
