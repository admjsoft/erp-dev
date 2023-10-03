<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title"> <?php echo $this->lang->line('Add Module') ?> <a
                        href="<?php echo base_url('modules/add') ?>"
                        class="btn btn-primary btn-sm rounded ml-2">
                    <?php echo $this->lang->line('Add New Module') ?>
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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div class="card-body">

                <table id="modules_table" class="table table-striped table-bordered zero-configuration">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Parent Module') ?></th>
                        <!-- <th><?php // echo $this->lang->line('Icon') ?></th> -->
                        <th><?php echo $this->lang->line('Activity Type') ?></th>
                        <th><?php echo $this->lang->line('Module Type') ?></th>
                        <th><?php echo $this->lang->line('Status') ?></th>
                        <!-- <th><?php // echo $this->lang->line('Position') ?></th> -->
                        <th><?php echo $this->lang->line('Action') ?></th>



                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($modules)) { $i = 1;  foreach ($modules as $row) { ?>
                    <tr>                        
                    <td><?php echo $i; ?></td>
                    <td><?php echo $row['title']; ?></td>
                    <td><?php echo $row['rel_parent_title']; ?></td>
                    <!-- <td><?php // echo $row['icon']; ?></td> -->
                    <td><?php echo $row['module_type']; ?></td>
                    <td><?php echo $row['type']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <!-- <td><?php // echo $row['display_order']; ?></td> -->
                    <td><a href="<?php echo base_url("modules/edit?id=".$row['id']); ?>" class='btn btn-success btn-sm'><i class='fa fa-edit'></i><?php echo $this->lang->line('Edit'); ?></a>&nbsp; <a href='#' data-object-id='<?php echo $row['id']; ?>' class='btn btn-danger btn-sm delete-object' title='Delete'><i class='fa fa-trash'></i></a></td></tr>
                    <?php $i++; }  } ?>
                    </tbody>
                    <tfoot>
                    <?php /* ?>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Total Products') ?></th>
                        <th><?php echo $this->lang->line('Stock Quantity') ?></th>
                        <th><?php echo $this->lang->line('Worth (Sales/Stock)') ?></th>
                        <th><?php echo $this->lang->line('Action') ?></th>
                    </tr> 
                    <?php */ ?>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {

            //datatables
            $('#modules_table').DataTable();

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
                    <p><?php echo $this->lang->line('Delete This Module') ?></strong></p>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="object-id" value="">
                    <input type="hidden" id="action-url" value="modules/delete">
                    <button type="button" data-dismiss="modal" class="btn btn-primary"
                            id="delete-confirm"><?php echo $this->lang->line('Delete') ?></button>
                    <button type="button" data-dismiss="modal"
                            class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                </div>
            </div>
        </div>
    </div>