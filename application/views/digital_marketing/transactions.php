<?php
$due = false;
if ($this->input->get('due')) {
    $due = true;
} ?>
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"><a
                        href="<?php echo base_url('customers') ?>"
                        class="mr-5">
                        <?php echo $this->lang->line('Customers'); ?></a></h4>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                         
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">

                <table id="transactionstable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <?php if($txn_type == 'email'){ ?>                            
                        <th><?php echo $this->lang->line('Subject'); ?></th>
                        <?php } ?>
                        <th><?php echo $this->lang->line('message'); ?></th>
                        <?php if($txn_type == 'email'){ ?>   
                        <th><?php echo $this->lang->line('Customer Emails'); ?></th>
                        <?php }else{ ?>
                        <th><?php echo "Customer Phone No's"; // $this->lang->line('Phone') ?></th>
                        <?php } ?>
                        <th><?php echo $this->lang->line('No Of Customers'); ?></th>
                        <th><?php echo $this->lang->line('Sent Date'); ?></th>


                    </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($transactions)) { $sno=1; foreach($transactions as $txn){ ?>
                            <tr>
                                <td><?php echo $sno; ?></td>
                                <?php if($txn_type == 'email'){ ?>                            
                                <td><?php echo $txn['subject']; ?></td>
                                <?php } ?>
                                <td><?php echo $txn['message'];  ?></td>
                                <td><?php echo $txn['customer_source'];  ?></td>
                                <td><?php echo count(explode(',',$txn['customer_source']));  ?></td>
                                <td><?php echo $txn['cr_date'];  ?></td>
                            </tr>
                        <?php $sno++; } } ?>
                    </tbody>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function () {

        $('#transactionstable').DataTable();

    });


</script>
