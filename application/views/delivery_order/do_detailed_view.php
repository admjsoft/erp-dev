<div class="card-content">
    <?php
    if($do_type == 'invoice')
    {
        $validtoken = hash_hmac(
            "ripemd160",
            $invoice["iid"],
            $this->config->item("encryption_key")
        );
    
        $link = base_url(
            "billing/view?id=" . $invoice["iid"] . "&token=" . $validtoken 
        );
    
    }else if($do_type == 'po'){

        $validtoken = hash_hmac('ripemd160', 'p' . $invoice['iid'], $this->config->item('encryption_key'));
        $link = base_url('billing/purchase?id=' . $invoice['iid'] . '&token=' . $validtoken);
    }
   

    ?>
    <?php /* ?>
    <div class="row">
    <div class="col-md-12">
        <div class="btn-group">
            <button type="button" class="btn btn-success mb-1 btn-min-width dropdown-toggle float-right" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>
                <?php echo $this->lang->line('Print') ?>
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" target="_blank"
                    href="<?= base_url('billing/printdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id); ?>"><?php echo $this->lang->line('Print') ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" target="_blank"
                    href="<?= base_url('billing/printdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id); ?>&d=1"><?php echo $this->lang->line('PDF Download') ?></a>
            </div>
        </div>
    </div>
    <?php */ ?>
       <div class="row">
    <div class="col-md-12">
        <h1 class="text-center" style="color:#fff; background-color:#3C9B90; padding:3px;">Delivery Order Details</h1>
        <div class="btn-group float-right">
            <button type="button" class="btn btn-success mb-1 btn-min-width dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>
                Print
            </button>
            <div class="dropdown-menu">
                <a class="dropdown-item" target="_blank"
                    href="<?= base_url('billing/printdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id); ?>"><?php echo $this->lang->line('Print') ?></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" target="_blank"
                    href="<?= base_url('billing/printdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id); ?>&d=1"><?php echo $this->lang->line('PDF Download') ?></a>
            </div>
        </div>
    </div>
</div>

</div>


    <!-- Invoice Company Details -->
    <div id="invoice-company-details" class="row mt-2">
        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
            <p></p>
            <img src="<?php
            $loc = location($invoice["loc"]);
            echo base_url("userfiles/company/" . $loc["logo"]);
            ?>" class="img-responsive p-1 m-b-2" style="max-height: 120px;">
            <p class="ml-2"><?= $loc["cname"] ?></p>
        </div>
        <div class="col-md-6 col-sm-12 text-xs-center text-md-right">
            <h2><?php // echo $this->lang->line("INVOICE"); ?></h2>
            <p class="pb-1"> <?php /* echo $this->config->item("prefix") .
                " " .
                $invoice["tid"] .
                '</p>
                            <p class="pb-1">' .
                $this->lang->line("Reference") .
                ":" .
                $invoice["refer"] .
                "</p>"; */ ?>
            <ul class="px-0 list-unstyled">
                <li><?php //echo $this->lang->line("Gross Amount"); ?></li>
                <li class="lead text-bold-800">
                    <?php /* echo amountExchange(
                        $invoice["total"],
                        0,
                        $this->aauth->get_user()->loc
                    ); */ ?></li>
            </ul>
        </div>
    </div>
    <!--/ Invoice Company Details -->

    <!-- Invoice Customer Details -->
    <div id="invoice-customer-details" class="row pt-2">
        <div class="col-sm-12 text-xs-center text-md-left">

        <?php 
        if($do_type == 'invoice'){ ?>
            <p class="text-muted"><?php echo $this->lang->line("Ship To"); ?></p>        
        
        <?php }else if($do_type == 'po'){ ?>
            <p class="text-muted"><?php echo $this->lang->line("From Supplier"); ?></p>   
        <?php } ?>
            
        </div>
        <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
            <ul class="px-0 list-unstyled">


                <li class="text-bold-800"><a href="<?php echo base_url(
                            "customers/view?id=" . $invoice["cid"]
                        ); ?>"><strong class="invoice_a"><?php
echo $invoice["name"] .
    "</strong></a></li><li>" .
    $invoice["company"] .
    "</li><li>" .
    $invoice["address"] .
    "</li><li>" .
    $invoice["city"] .
    "," .
    $invoice["country"] .
    "</li><li>" .
    $this->lang->line("Phone") .
    ": " .
    $invoice["phone"] .
    "</li><li>" .
    $this->lang->line("Email") .
    ": " .
    $invoice["email"] .
    "</li>";
foreach ($c_custom_fields as $row) {
    echo "  <li>" . $row["name"] . ": " . $row["data"]; ?></li>

                <?php
}
?>


            </ul>

        </div>
        <div class="offset-md-3 col-md-3 col-sm-12 text-xs-center text-md-left">
            <?php echo '<p><span class="text-muted">' .
                $this->lang->line("Invoice Date") .
                "  :</span> " .
                dateformat($invoice["invoicedate"]) .
                '</p> <p><span class="text-muted">' .
                $this->lang->line("Due Date") .
                " :</span> " .
                dateformat($invoice["invoiceduedate"]) .
                '</p>  <p><span class="text-muted">' .
                $this->lang->line("Terms") .
                " :</span> " .
                $invoice["termtit"] .
                "</p>"; ?>
        </div>
    </div>
    <!--/ Invoice Customer Details -->

    <!-- Invoice Items Details -->
    <?php if(!empty($do_list)) $dd=1; { foreach($do_list as $d_list){ ?>
    <?php if($dd == 1){ ?>
    <h1> DO No: # <?php echo $d_list['parent_do_id']; ?> </h1>
    
    <?php } ?>

    <div id="invoice-items-details" class="pt-2" style="margin-left:15%;margin-right:5%;">




        <div class="row">
            <div class="col-sm-12">
                <div class="row align-items-center" style="color:#fff; background-color:#3C9B90; padding-top:5px;">
                    <div class="col-sm-6">
                        <h4># <?php echo $d_list['do_id']; ?></h4>
                        <?php if($d_list['do_type'] == 'po'){ ?>
                            
                        <h4>Received Date: # <?php echo $d_list['cr_date']; ?></h4>
                        <?php }else{ ?>
                            
                        <h4>Delivery Order Date: # <?php echo $d_list['cr_date']; ?></h4>
                        <?php } ?>
                        <?php if(!empty($d_list['supplier_do_id'])){ ?>
                            
                        <h4>Supplier Delivery No: # <?php echo $d_list['supplier_do_id']; ?></h4>
                        <?php } ?>
                    </div>
                    

                    <div class="col-sm-6 text-right ">
                        <?php if ($do_option == 'return') { ?>
                        <a href="#" class="btn btn-danger get_do_return_details "
                            p_do_id="<?php echo $d_list['parent_do_id']; ?>" do_type="<?php echo $d_list['do_type']; ?>"
                            do_id="<?php echo $d_list['do_id']; ?>"><i class="fa fa-reply"></i> Return</a>
                        <?php } else if ($do_option == 'cancel') { ?>
                        <a href="#" class="btn btn-danger get_do_cancel_details"
                            p_do_id="<?php echo $d_list['parent_do_id']; ?>" do_type="<?php echo $d_list['do_type']; ?>"
                            do_id="<?php echo $d_list['do_id']; ?>"><i class="fa fa-trash"></i> Cancel</a>
                        <?php }else{ ?>
                            
                            <div class="btn-group">
                            <button type="button" class="btn btn-success mb-1 btn-min-width dropdown-toggle float-right" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><i class="fa fa-print"></i>
                                <?php echo $this->lang->line('Print') ?>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" target="_blank"
                                    href="<?= base_url('billing/printsubdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id. '&sub_do_id='.$d_list['do_id']); ?>"><?php echo $this->lang->line('Print') ?></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" target="_blank"
                                    href="<?= base_url('billing/printsubdo?id=' . $invoice['iid'] . '&token=' . $validtoken. '&type=' . $do_type. '&do_id=' .$parent_do_id. '&sub_do_id='.$d_list['do_id']); ?>&d=1"><?php echo $this->lang->line('PDF Download') ?></a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

            <div class="table-responsive col-sm-12">
                <table class="table table-striped">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line("Item"); ?></th>
                            
                            <th class="text-xs-left"><?php echo $this->lang->line("Ordered Qty"); ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line("Delivered Qty"); ?></th>
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
                            
                            <th class="text-xs-left"><?php echo (int)$d_list_do['ordered_qty']; ?></th>
                            <th class="text-xs-left"><?php echo (int)$d_list_do['delivered_qty']; ?></th>
                            <th class="text-xs-left"><?php echo (int)$d_list_do['return_qty']; ?></th>
                            <th class="text-xs-left"><?php if(!empty($d_list_do['description'])){ echo $d_list_do['description']; }else{ echo "----"; }  ?></th>

                        </tr>
                        <?php $i++; }} ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $dd++; }} ?>



    <p></p>

    <div class="text-xs-center">
        <p><?php // echo $this->lang->line("Authorized person"); ?></p>
        <?php /* if (!empty($employee)) { ?>
        <?php echo '<img src="' .
                        base_url(
                            "userfiles/employee_sign/" .
                                (!empty($employee["sign"])
                                    ? $employee["sign"]
                                    : "")
                        ) .
                        '" alt="signature" class="height-100"/>
                                    <h6>' .
                        (!empty($employee["name"]) ? $employee["name"] : "") .
                        '</h6>
                                    <p class="text-muted">' .
                        (!empty($employee["roleid"])
                            ? user_role($employee["roleid"])
                            : "") .
                        "</p>"; ?>

        <?php } else { ?>
        <p>Not Available</p>
        <?php } */ ?>
    </div>
</div>
</div>
</div>



</div>
</div>