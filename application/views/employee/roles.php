<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Roles') ?> <a href="<?php echo base_url('employee/role') ?>"
                                                                  class="btn btn-primary btn-sm rounded">
                    <?php echo $this->lang->line('Add new') ?>
                </a>
            </h5>
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
		 <?php
if(isset($_SESSION['status'])){
 echo '<div class="alert alert-'.$_SESSION['status'].'">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' .$_SESSION['message']. '</div>
        </div>';
unset($_SESSION['status']);unset($_SESSION['message']);
} ?>
		
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">

                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>


                        <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1;

                    foreach ($role_list as $row) {
                        $aid = $row['id'];
                       if($row['status']==1)
					   {
						   $status="Active";
					   }
					   else{
					   $status="In Active";
					}

                        echo "<tr>
<td>" . $i . "</td>
                    <td>" . $row['role_name'] . "</td>
                    <td>" . $status . "</td>


                    <td> <a href='" . base_url("employee/roleedit?id=$aid") . "' class='btn btn-blue  btn-sm'><i class='fa fa-pencil'></i> " . $this->lang->line('Edit') . "</a> <a href='#' data-object-id='$aid' class='btn btn-danger btn-sm delete-object  btn-sm'><span class='fa fa-trash'></span></a></td></tr>";
                        $i++;
                    }
                    ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>


                        <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //datatables
            $('#emptable').DataTable({responsive: true});


        });

        $('.delemp').click(function (e) {
            e.preventDefault();
            $('#empid').val($(this).attr('data-object-id'));

        });
    </script>

    <div id="delete_model" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">

                    <h4 class="modal-title"><?php echo $this->lang->line('Delete') ?></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <?php echo $this->lang->line('Delete');
                    echo ' ' . $this->lang->line('Role'); ?>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="employee/delete_role">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete-confirm"><?php echo $this->lang->line('Yes') ?></button>
                    <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('No') ?></button>
                </div>
            </div>
        </div>
    </div>