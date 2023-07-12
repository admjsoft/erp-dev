
<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title">
               
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


                <form method="post" id="data_form" class="form-horizontal">
                    <table id="" class="table table-striped table-bordered zero-configuration table-responsive"
                           cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Modules') ?></th>
                            <th><?php echo $this->lang->line('Subscribe/UnSubscribe') ?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;

                        foreach ($permission as $row) {
                            $i = $row['id'];
                            $module = $row['module'];
                            echo "<tr>
                    <td>$i</td>
                    <td>$module</td>"; ?>
                            <td><input type="checkbox" name="r_<?= $i ?>_1"
                                       class="m-1" <?php if ($row['r_1']) echo 'checked="checked"' ?>></td>
                            <?php
                            echo "
                    </tr>";
                            //  $i++;
                        }
                        ?>
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line('Modules') ?></th>
                            <th><?php echo $this->lang->line('Subscribe/UnSubscribe') ?></th>
                        </tr>
                        </tfoot>
                    </table>
                    <div class="form-group row">

                        <div class="col-sm-1"></div>

                        <div class="col-sm-6">
                            <input type="submit" id="submit-data" class="btn btn-success margin-bottom btn-lg"
                                   value="<?php echo $this->lang->line('Update') ?>"
                                   data-loading-text="Adding...">
                            <input type="hidden" value="dashboard/updatesubscription" id="action-url">
                        </div>
                    </div>
            </div>

        </div>
    </div>
</div>




