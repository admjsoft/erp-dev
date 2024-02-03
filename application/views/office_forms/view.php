<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h3><?php  // echo $contract['name'] ?></h3>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>

        
        <div class="row ">
            <div class="col-6 text-left ">
                <h5 class="ml-2"><?php echo $this->lang->line('Office Form') ?></h5>
            </div>
            <div class="col-6 text-right ">
                <!-- Small Button -->
                <a class="mr-2" href="<?php echo base_url('officeforms'); ?>"> <button type="button"
                        class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
            </div>
        </div>

        <div class="card-content">

            <div class="card-body">
            <?php if ($this->session->flashdata("SuccessMsg")) {?>
            <div class="alert alert-success notify-alert">
                <?php echo $this->session->flashdata("SuccessMsg") ?>
            </div>
            <?php }?>
            <?php if ($this->session->flashdata("ErrorMsg")) {?>
            <div class="alert alert-danger notify-alert">
                <?php echo $this->session->flashdata("ErrorMsg") ?>
            </div>
            <?php }?>
                <!-- <button id="exportButton">Export and Upload PDF</button> -->
                <div id="pspdfkit" style="width: 100%; height: 100vh"></div>


            </div>
        </div>
    </div>
</div>
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    <?php  if(!empty($office_form)) { ?>
        <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="<?php echo $office_form['form_url']; ?>" />

    <?php }else{ ?>
        <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="https://localhost/erp-dev/userfiles/contract_docs/sample.pdf" />

    <?php } ?>   
<script type="module" src="<?php echo base_url('pspdf_assets/'); ?>index_view.js"></script>