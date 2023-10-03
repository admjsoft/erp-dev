<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h5><?php echo $this->lang->line('Contract') ?> <a
                        href="<?php echo base_url('contract/create') ?>"
                        class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?></a></h5>
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


                <div class="table-responsive">
                    <table id="acctable" class="table table-hover mb-1" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Client Name') ?></th>
                            <th><?php echo $this->lang->line('Contract Name') ?></th>
                            <th><?php echo $this->lang->line('Start Date') ?></th>
                            <th><?php echo $this->lang->line('End Date') ?></th>
                            <th><?php echo $this->lang->line('Reminder Date') ?></th>
                            <th><?php echo $this->lang->line('Status') ?></th>
                            <th><?php echo $this->lang->line('Actions') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        foreach ($contract as $row) {
                            $contract_id = $row['id'];
                            $client_name = $row['client_name'];
                            $contract_name = $row['name'];
                            $start_date = $row['start_date'];
                            $end_date = $row['end_date']; //amountExchange($row['lastbal'], 0, $this->aauth->get_user()->loc);
                            $reminder_date = $row['reminder_date'];
                            $status = $row['status'];
                            echo "<tr>
                    <td>$i</td>
                    <td>$client_name</td>
                    <td>$contract_name</td>
                 
                    <td>$start_date</td>
                    <td>$end_date</td>
                    <td>$reminder_date</td>
                    <td>$status</td>
                    <td><a href='" . base_url("contract/view/$contract_id") . "' class='btn btn-success btn-xs'><i class='fa fa-eye'></i>  " . $this->lang->line('View') . "</a>&nbsp;<a href='" . base_url("contract/edit/$contract_id") . "' class='btn btn-warning btn-xs'><i class='fa fa-pencil'></i>  " . $this->lang->line('Edit') . "</a>&nbsp;<a href='#' data-object-id='" . $contract_id . "' class='btn btn-danger btn-xs delete-object' title='Delete'><i class='fa fa-trash'></i></a></td></tr>";
                            $i++;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Client Name') ?></th>
                            <th><?php echo $this->lang->line('Contract Name') ?></th>
                            <th><?php echo $this->lang->line('Start Date') ?></th>
                            <th><?php echo $this->lang->line('End Date') ?></th>
                            <th><?php echo $this->lang->line('Reminder Date') ?></th>
                            <th><?php echo $this->lang->line('Status') ?></th>
                            <th><?php echo $this->lang->line('Actions') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <input type="hidden" id="dashurl" value="accounts/account_stats">
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //datatables
            $('#acctable').DataTable({
                responsive: true, <?php datatable_lang();?> dom: 'Blfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3]
                        }
                    }
                ],
            });
            miniDash();

        });
    </script>
    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete Account') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <p><?php echo $this->lang->line('Delete account message') ?></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="accounts/delete_i">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>