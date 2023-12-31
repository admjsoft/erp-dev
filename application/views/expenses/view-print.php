<!doctype html>
<html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Print Trans #<?php echo $trans['id'] ?></title>

    <style>

        @page {
            sheet-size: 220mm 110mm;
        }

        h1.bigsection {
            page-break-before: always;
            page: bigger;
        }

        table td {
            padding: 8pt;
        }


    </style>

</head>
<body style="font-family: Helvetica;" dir="<?= LTR ?>">
<h5><?php echo $this->lang->line('Expense details id') . ' : ' . prefix(5) . $trans['id'] ?></h5>
<table>
    <?php echo '<tr><td>' . $this->lang->line('Date') . ' : ' . dateformat($trans['updated_at']) . '</td><td>'.$this->lang->line('Transaction id') . ' : ' . prefix(5) . $trans['id'] . '</td><td> ' . $this->lang->line('Category') . ' : ' . $trans['category'] . '</td></tr>'; ?>
</table>

<hr>
<table>
    <tr>
        <td>
            <?php $loc = location($trans['loc']);
            echo '<strong>' . $loc['cname'] . '</strong><br>' .
                $loc['address'] . '<br>' . $loc['city'] . ', ' . $loc['region'] . '<br>' . $loc['country'] . ' -  ' . $loc['postbox'] . '<br> ' . $this->lang->line('Phone') . ': ' . $loc['phone'] . '<br>  ' . $this->lang->line('Email') . ': ' . $loc['email'];
            ?>

        </td>
        <td> <?php echo '<strong>' . $trans['name'] . '</strong><br>' .
                $cdata['address'] . '<br>' . $cdata['city'] . '<br>' . $this->lang->line('Phone') . ': ' . $cdata['phone'] . '<br> ' . $this->lang->line('Email') . ': ' . $cdata['email']; ?></td>
        <td> <?php echo '<div class="col-xs-6 col-sm-6 col-md-6">
                    <p>' . $this->lang->line('amount') . ' : ' . amountExchange($trans['receipt_amount'], 0, $this->aauth->get_user()->loc) . ' </p><p>' . $this->lang->line('Tax') . 'Tax : ' . amountExchange($trans['tax_amount'], 0, $this->aauth->get_user()->loc) . ' </p>'; ?></td>
    </tr>
</table>
<?php echo '<p>' . $this->lang->line('Remarks') . ' : ' . $trans['remarks'] . '</p>'; ?>
</body>