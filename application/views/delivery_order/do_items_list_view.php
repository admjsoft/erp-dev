  
    <!-- Invoice Items Details -->
    <?php if(!empty($do_list)) $dd=1; { foreach($do_list as $d_list){ ?>
  
    
    <div id="invoice-items-details" class="pt-2" >
    
        
   
    
        <div class="row">
        <div class="col-sm-12">
        <div class="row align-items-center">
        <div class="col-sm-6">
            <h4># <?php echo $d_list['do_id']; ?></h4>
        </div>
        

            <div class="table-responsive col-sm-12">
                <table class="table table-striped" id="do_return_items_table">
                    <thead>

                        <tr>
                            <th>#</th>
                            <th><?php echo $this->lang->line("Item"); ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line("Delivered Qty"); ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line("Return Qty"); ?></th>
                            <th class="text-xs-left"><?php echo $this->lang->line("Return Description"); ?></th>                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($d_list['delivery_order'])) { $i=1; foreach($d_list['delivery_order'] as $d_list_do){ ?>
                            <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $d_list_do['product']; ?></td>
                            <td class="text-xs-left"><?php echo $d_list_do['delivered_qty']; ?></td>
                            <td><input style="width: 50px;" p_id="<?php echo $d_list_do['p_id']; ?>" do_id="<?php echo $d_list['do_id']; ?>" parent_do_id="<?php echo $d_list['parent_do_id']; ?>" row_id="<?php echo $d_list_do['id']; ?>" class="xs form-control " type="number" value="" max="<?php echo $d_list_do['delivered_qty']; ?>"/></td>
                            <td><input class="xs form-control " type="text" value="" /></td>
                            </tr>
                        <?php $i++; }} ?>
                        </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php $dd++; }} ?>
        

