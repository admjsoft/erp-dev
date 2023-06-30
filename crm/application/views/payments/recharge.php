<div class="app-content content container-fluid">
    <div class="content-wrapper">


        <div class="content-body">
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
                                <input type="submit" class="btn btn-lg btn-success" value="Add Money to Wallet">
                                <button type="button" class="btn btn-lg btn-amber" title="support recharge still pending" data-toggle="modal" data-target="#part_payment" >
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
