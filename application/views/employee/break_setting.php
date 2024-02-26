<div class="content-body">
<div id="c_body"></div>
    <div class="card">
        <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('Attandance') ?>
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
            <?php //if($this->session->flashdata('key')){ ?>
            <div id="notify" class="alert alert-<?= $this->session->flashdata('key');?>" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <div class="message"><?= $this->session->flashdata('msg');?> </div>
            </div>
            <div class="card-body">

                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                       width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th><?php echo $this->lang->line('Name') ?></th>
                        <th><?php echo $this->lang->line('Time') ?></th>
                        <th><?php echo $this->lang->line('Actions') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php  
                            $edit_option = false;   
                          if ($this->aauth->premission(209)) { 
                            $edit_option = true;
                            }
                        $i = 1; if($time_list) { foreach ($time_list as $row) { ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row['btime']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php if($edit_option) { ?><a href='#' data-object-id='<?php echo $row['id']; ?>' data-object-name='<?php echo $row['name']; ?>' data-object-time='<?php echo $row['name']; ?>'  class='btn btn-blue  btn-sm editbreak'><i class='fa fa-pencil'></i><?php echo $this->lang->line('Edit'); ?></a><?php } ?></td>
                        </tr>
                        <?php }}?>    
                        
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            //datatables
            $('#emptable').DataTable({responsive: true});
        });

        $('.editbreak').click(function () {
            var date ='<?php echo date('Y-m-d'); ?>';
            var id = $(this).attr('data-object-id');
            var name = $(this).attr('data-object-name');

            var time = $(this).attr('data-object-time');
             var date = new Date(date+' '+time);
            $('#object-id').val(id);
            $('#breakname').val($(this).attr('data-object-name'));
            if(date.getHours()<10){
            $('#breakhour').val('0'+date.getHours());}
            else{$('#breakhour').val(date.getHours());}
             if(date.getMinutes()<10){
            $('#breakminut').val('0'+date.getMinutes());}
            else{$('#breakminut').val(date.getMinutes());}
            $('#update_model').modal('show');
        });
    </script>
 <form action="<?php echo base_url('employee/update_break_time') ?>" method="GET">
    <div id="update_model" class="modal fade">
        <div class="modal-dialog">

                <div class="modal-content ">
                    <div class="modal-header">

                        <h4 class="modal-title"><?php echo $this->lang->line('Update') ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row"><div class="col-sm-12 p-1">
                        <label><?php echo $this->lang->line('Name') ?></label>
                        <input type="text" id="breakname" class="form-control" name="name" value="">
                        </div>
                        <div class="col-3 py-1">
                        <label><?php echo $this->lang->line('Hour') ?></label>
                        <select id="breakhour"  class="form-control" name="hour">
                            <?php
                            for($i=0;$i<=12;$i++){
                                $num=sprintf("%02d",$i);
                                echo '<option value="'.$num.'">'.$num.'</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <div class="col-3 py-1 ">
                        <label><?php echo $this->lang->line('Minutes') ?></label>
                        <select id="breakminut"  class="form-control" name="minut">
                            <?php
                            for($i=0;$i<=59;$i++){
                                $num=sprintf("%02d",$i);
                                echo '<option value="'.$num.'">'.$num.'</option>';
                            }
                            ?>
                        </select>
                        </div>
                        <input type="hidden" id="object-id" name="id" value="" />
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-primary"
                               ><?php echo $this->lang->line('Update') ?></button>
                        <button type="button" data-dismiss="modal"
                                class="btn"><?php echo $this->lang->line('Cancel') ?></button>
                    </div>
                </div>

        </div>
    </div>
    </form>