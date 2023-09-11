<div class="app-content content container-fluid">
    <div class="content-wrapper">


        <div class="content-body">
<div id="c_body"></div>
            <section class="card">
                <div class="card-block">
<h2 class="text-xs-center">Current Balance is <?= amountFormat($balance) ?></h2>
                </div>
                <?php
                if($this->session->flashdata('sstatus')=="success"){?>
                    <div class="card"><div class="alert alert-success"><h3>Request Send Successful!</h3></div></div>
                <?php unset($_SESSION['sstatus']); } ?>




               <div class="card-block">
                       <form method="get" action="<?php echo substr(base_url(),0,-4) ?>billing/recharge">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                        <input type="hidden" value="<?=base64_encode($this->session->userdata('user_details')[0]->cid) ?>" name="id">

                    <form>
                        <div class="form-group row">

                            <label class="col-sm-2 col-form-label"
                                   for="amount"><?php echo $this->lang->line('Amount') ?></label>

                            <div class="col-sm-3">
                                <input type="number" placeholder="Enter amount in 0.00"
                                       class="form-control margin-bottom " name="amount" min="1.00" required>
                            </div>
                        </div>

                         <div class="form-group row ">
                                        <label for="gid" class="col-sm-2 col-form-label"><?php echo $this->lang->line('Payment Gateways') ?></label> <div class="col-sm-3">
                                        <select class="form-control" name="gid">
                                            <?php
                                            $surcharge_t = false;
                                            foreach ($gateway as $row) {
                                                $cid = $row['id'];
                                                $title = $row['name'];
                                                if ($row['surcharge'] > 0) {
                                                    $surcharge_t = true;
                                                    $fee = '(+' . amountFormat_s($row['surcharge']) . ' %)';
                                                } else {
                                                    $fee = '';
                                                }
                                                echo "<option value='$cid'>$title $fee</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                         </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label"
                                   for="name"></label>

                            <div class="col-sm-8">
                                <button type="button" class="btn btn-lg btn-success" data-toggle="modal" data-target="#paymentCard" >Add Money to Wallet
                                <button type="button" class="btn btn-lg btn-amber" title="support recharge still pending" data-toggle="modal" data-target="#part_payment_new" >
                                    <?php //echo $this->lang->line('Support') ?>Payment Proof</button>
                            </div>
                        </div>
                    </form>



                </div>

                <h5 class="text-xs-center"><?php echo $this->lang->line('Payment History') ?></h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th><?php echo $this->lang->line('Amount') ?></th>
                        <th><?php echo $this->lang->line('Note') ?></th>


                    </tr>
                    </thead>
                    <tbody id="activity">
                    <?php foreach ($activity as $row) {

                        echo '<tr>
                            <td>' . amountFormat($row['col1']) . '</td><td>' . $row['col2'] . '</td>

                        </tr>';
                    } ?>

                    </tbody>
                </table>
        </div>

            </section>
        </div>
    </div>
</div>
<!-- Modal HTML Wallet -->
<div id="part_payment" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h4 class="modal-title"><?php echo $this->lang->line('Payment Confirmation') ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>

            <div class="modal-body">
                <section class="card">
                    <div class="card-block" style="max-width: 600px;margin-left: auto; margin-right: auto;">
                        <form id="sendmail_form" method="post"
                              action="<?php echo substr_replace(base_url(), '', -4); ?>crm/payments/send_general"
                              enctype="multipart/form-data" >
                            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>"
                                   value="<?php echo $this->security->get_csrf_hash(); ?>">
                            <div class="row">
                                <div class="col">
                                    <div class="input-group">
                                        <div class="input-group-addon"><span class="icon-envelope-o"
                                                                             aria-hidden="true"></span></div>
                                        <input type="text" class="form-control" placeholder="Email" name="mailtoc"
                                               value="<?php echo $this->session->userdata('user_details')[0]->email; ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-1"><label
                                            for="shortnote"><?php echo $this->lang->line('Notes') ?></label>
                                    <input type="text" class="form-control"
                                           name="notes" id="subject" >
                                </div>
                            </div> <div class="row">
                                <div class="col mb-1"><label
                                            for="shortnote"><?php echo $this->lang->line('Amount') ?></label>
                                    <input type="number" placeholder="Enter amount in 0.00"
                                           class="form-control margin-bottom " name="amount">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-1"><label
                                            for="shortnote"><?php echo $this->lang->line('Attachment') ?>Proof Of Payment</label>
                                    <input type="file" class="form-control"
                                           name="afile" id="subject" accept=" .jpg, .jpeg, .png"></div>
                            </div>

                            <input type="hidden" class="form-control"
                                   name="customername" value="<?php echo $this->session->userdata('user_details')[0]->name; ?>">
                            <input type="hidden" class="form-control"
                                   id="cid" name="cid" value="<?php echo $this->session->userdata('user_details')[0]->users_id ?>">
                            <button type="submit" class="btn btn-primary"
                                    id="sendNow"><?php //echo $this->lang->line('Add Balance') ?>Support Request</button>

                        </form>


                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
<div id="paymentCard" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Make Payment') ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <span style="color:red">Please Contact System Provider If Required Online Function</span>
                    <?php


                    /*foreach ($gateway as $row) {
                        $cid = $row['id'];
                        $title = $row['name'];
                        if ($row['surcharge'] > 0) {
                            $surcharge_t = true;
                            $fee = '( ' . amountExchange($rming, $invoice['multi'], $invoice['loc']) . '+' . amountFormat_s($row['surcharge']) . ' %)';
                        } else {
                            $fee = '';
                        }

                        echo '<a href="' . base_url('billing/card?id=' . $invoice['iid'] . '&itype=inv&token=' . $token) . '&gid=' . $cid . '" class="btn mb-1 btn-block blue rounded border border-info text-bold-700 border-lighten-5 "><span class=" display-block"><span class="grey">Pay With </span><span class="blue font-medium-2">' . $title . ' ' . $fee . '</span></span>

 <img class="mt-1 bg-white round" style="max-width:20rem;max-height:10rem"
                                             src="' . assets_url('assets/gateway_logo/' . $cid . '.png') . '">
</a><br>';
                    }*/
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>


    <!-- Modal HTML Wallet -->
    <div id="part_payment_new" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Payment Confirmation') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

                <div class="modal-body">
                    <form class="payment" action="<?php echo base_url(); ?>/billing/walletpay" method="post" >
                                            <span style="color:red">Please Contact System Provider Adding Money To e-wallet</span>

                      <!--  <div class="row">
                            <div class="col"><label
                                        for="rmpay"><?php //echo $this->lang->line('Payment') ?></label>
                                    <input type="text" class="form-control" placeholder="Total Amount" name="amount"
                                           id="rmpay"
                                           value="<?php //amountExchange_s($rming, 0, $invoice['loc']) ?>">
                                    <div class="form-control-position">
                                        <?php //echo $this->config->item('currency') ?>
                                    </div>
                            </div>
                        </div>-->

                        <!--<div class="row">
                            <div class="col mb-1">
                                <input type="hidden" name="pmethod" class="form-control mb-1" value="Balance" />
                                <label for="account"><?php //echo $this->lang->line('Wallet') ?> <?php //echo $this->lang->line('Balance') ?></label>
                                <input type="text" name="account" class="form-control mb-1" value="<?php //echo $customers['balance']; ?>" readonly />
                           </div>
                        </div>-->
                        <!--<div class="row">
                            <div class="col mb-1"><label
                                        for="shortnote"><?php //echo $this->lang->line('Note') ?></label>
                                <input type="text" class="form-control"
                                       name="shortnote" placeholder="Short note"
                                       value="Payment for invoice #<?php //echo $invoice['tid'] ?>"></div>
                        </div>-->
                        <div class="modal-footer">
                            
                            <!--<button type="submit" class="btn btn-primary"
                                    id=""  <?php //if($rming>$customers['balance']){echo "disabled"; } ?>><?php //echo $this->lang->line('Make Payment'); ?></button>--->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
