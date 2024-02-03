 
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-content">
                <?php if($digital_signatures['status'] != 'COMPLETED'){ ?>
                <div class="text-right m-2 ">
                    <input id="exportButton" type="button" class="btn btn-success" value="Upload Document">
                </div>
                <?php }?>
                <div id="pspdfkit" style="width: 100%; height: 100vh"></div>

        </div>
        </section>
    </div>
</div>
</div>
<input type="hidden" value="<?php echo $digital_signatures['id']; ?>" id="ds_id">
<input type="hidden" value="<?php echo base_url('billing/save_ds_signing_details'); ?>" id="ds_sign_form" name="ds_sign_form" />
 
<?php if(!empty($ds_signings)) { ?>
        <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="<?php echo $ds_signings[0]['file_path']; ?>" />
    <?php }else if(!empty($digital_signatures)) { ?>
        <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="<?php echo $digital_signatures['file_path']; ?>" />

    <?php }else{ ?>
        <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="https://localhost/erp-dev/userfiles/contract_docs/sample.pdf" />

    <?php } ?>   
<script type="module" src="<?php echo base_url('pspdf_assets/'); ?>index.js"></script>
