<div class="card card-block">

    <!-- Display validation errors here -->
    <div id="validation_errors" class="alert alert-danger" style="display:none;"></div>

    <?php
    $attributes = array('class' => 'card-body', 'id' => 'contract_form', 'name' => 'contract_form');
    echo form_open_multipart('contract/edit/' . $contract['id'], $attributes);
    ?>

    <div class="row mr-2">
        <div class="col-6 text-left mr-">
            <h5><?php echo $this->lang->line('Edit Contract') ?></h5>
        </div>
        <div class="col-6 text-right mr-">
            <!-- Small Button -->
            <a href="<?php echo base_url('contract'); ?>"> <button type="button"
                    class="btn btn-sm btn-primary"><?php echo $this->lang->line('List'); ?> </button></a>
        </div>
    </div>
    <hr>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Contract Name'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="contract_name"
                placeholder="<?php echo $this->lang->line('Contract Name'); ?>" required
                value="<?php echo $contract['name']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Start Date'); ?></label>
        <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
            <input type="date" class="form-control margin-bottom datepicker" autocomplete="false" name="start_date"
                placeholder="<?php echo $this->lang->line('Start Date'); ?>"
                value="<?php echo $contract['start_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('End Date'); ?></label>
        <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
            <input type="date" class="form-control datepicker" autocomplete="false" name="end_date"
                placeholder="<?php echo $this->lang->line('End Date'); ?>" value="<?php echo $contract['end_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Client Name'); ?></label>
        <div class="col-sm-6">
            <input type="text" value="<?php echo $contract['client_name']; ?>" autocomplete="off"
                class="form-control margin-bottom" id="customer-box-contract" name="client_name"
                placeholder="<?php echo $this->lang->line('Client Name'); ?>">
            <div id="customer-box-result"></div>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Person In Charge'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="person_in_charge"
                placeholder="<?php echo $this->lang->line('Person In Charge'); ?>"
                value="<?php echo $contract['pic']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('No Of People To Share'); ?></label>
        <div class="col-sm-6">
            <select class="form-control margin-bottom" id="sharing_count" name="sharing_count"
                placeholder="<?php echo $this->lang->line('No Of People To Share'); ?>">
                <option value="1" <?php if($contract['sharing_count'] == 1){ echo "selected"; } ?>>1</option>
                <option value="2" <?php if($contract['sharing_count'] == 2){ echo "selected"; } ?>>2</option>
                <option value="3" <?php if($contract['sharing_count'] == 3){ echo "selected"; } ?>>3</option>
                <option value="4" <?php if($contract['sharing_count'] == 4){ echo "selected"; } ?>>4</option>
                <option value="5" <?php if($contract['sharing_count'] == 5){ echo "selected"; } ?>>5</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Email'); ?></label>
        <div class="col-sm-6">
            <input type="email" class="form-control margin-bottom" name="email"
                placeholder="<?php echo $this->lang->line('Email'); ?>" value="<?php echo $contract['email']; ?>">
            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Phone'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="phone"
                placeholder="<?php echo $this->lang->line('Phone'); ?>" value="<?php echo $contract['phone']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Reminder Date'); ?></label>
        <div class="col-sm-6">
            <input type="date" class="form-control margin-bottom datepicker" name="reminder_date"
                placeholder="<?php echo $this->lang->line('Reminder Date'); ?>"
                value="<?php echo $contract['reminder_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Remarks'); ?></label>
        <div class="col-sm-6">
            <textarea class="form-control margin-bottom" name="remarks"
                placeholder="<?php echo $this->lang->line('Remarks'); ?>"><?php echo $contract['remarks']; ?></textarea>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Document Preview'); ?></label>
        <div class="col-sm-6" id="file-preview">
            <!-- File previews will be displayed here -->
        </div>
    </div>

    <div class="form-group row">

        <label class="col-sm-2 col-form-label"></label>

        <div class="col-sm-4">
            <input type="submit" class="btn btn-success margin-bottom" name="submit"
                value="<?php echo $this->lang->line('Edit Contract') ?>" data-loading-text="Adding...">
            <!-- <input type="hidden" value="contract/edit" id="action-url"> -->
            <input type="hidden" value="<?php echo $contract['client_id']; ?>" id="contract_customer_id"
                name="contract_customer_id">
        </div>
    </div>

    <?php echo form_close(); ?>
</div>
<?php /* if(!empty($upload_files)){ $up=1; foreach($upload_files as $up_files){ ?>
<input type="hidden" value="<?php echo $up_files['file_path']; ?>" id="uploaded_file_<?php echo $up; ?>"
    name="uploaded_file_<?php echo $up; ?>" />
<?php $up++; }} */ ?>
<?php if(!empty($contract_signings)) { ?>
<input type="hidden" id="latest_updated_doc" name="latest_updated_doc"
    value="<?php echo $contract_signings[0]['file_path']; ?>" />
<?php }else if(!empty($upload_files)) { ?>
<input type="hidden" id="latest_updated_doc" name="latest_updated_doc"
    value="<?php echo $upload_files[0]['file_path']; ?>" />

<?php }else{ ?>
<input type="hidden" id="latest_updated_doc" name="latest_updated_doc"
    value="https://localhost/erp-dev/userfiles/contract_docs/sample.pdf" />

<?php } ?>
<!-- JavaScript to display file preview -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.234/pdf.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

<!-- <script>
    // JavaScript code for handling file preview
    document.querySelector('input[name="contract_files[]"]').addEventListener('change', function () {
        const fileInput = this;
        const filePreview = document.getElementById('file-preview');
        filePreview.innerHTML = '';

        for (const file of fileInput.files) {
            const filePreviewItem = document.createElement('div');
            filePreviewItem.classList.add('file-preview-item');

            const fileName = document.createElement('strong');
            fileName.textContent = file.name;
            filePreviewItem.appendChild(fileName);

            if (file.type.startsWith('image/')) {
                // Image file preview
                const img = document.createElement('img');
                img.src = URL.createObjectURL(file);
                img.width = 500;
                filePreviewItem.appendChild(img);
            } else if (file.type === 'application/pdf') {
                // PDF file preview
                const pdfViewer = document.createElement('iframe');
                pdfViewer.src = URL.createObjectURL(file);
                pdfViewer.width = 500;
                pdfViewer.height = 500;
                filePreviewItem.appendChild(pdfViewer);
            }

            filePreview.appendChild(filePreviewItem);
        }
    });

    </script> -->

<script>
$(document).ready(function() {

    var pdf_url = $('#latest_updated_doc').val();
    //const fileInput = this;
    // const filePreview = document.getElementById('file-preview');
    // filePreview.innerHTML = '';
    // const pdfViewer = document.createElement('iframe');
    // const filePreviewItem = document.createElement('div');
    // filePreviewItem.classList.add('file-preview-item');
    // pdfViewer.src = 'https://localhost/erp-dev/userfiles/contract_docs/sample.pdf';
    // pdfViewer.width = 500;
    // pdfViewer.height = 500;
    // filePreviewItem.appendChild(pdfViewer);

    const filePreview = document.getElementById('file-preview');
    filePreview.innerHTML = '';

    const pdfViewer = document.createElement('iframe');
    pdfViewer.setAttribute('src', pdf_url);
    pdfViewer.setAttribute('width', '690');
    pdfViewer.setAttribute('height', '500');
    pdfViewer.setAttribute('type', 'application/pdf'); // Set the type attribute for PDF

    const filePreviewItem = document.createElement('div');
    filePreviewItem.classList.add('file-preview-item');
    filePreviewItem.appendChild(pdfViewer);

    filePreview.appendChild(filePreviewItem);


});
</script>