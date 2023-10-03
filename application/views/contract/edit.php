<div class="card card-block">
    <!-- Display validation errors here -->
    <div id="validation_errors" class="alert alert-danger" style="display:none;"></div>

    <?php
    $attributes = array('class' => 'card-body', 'id' => 'contract_form', 'name' => 'contract_form');
    echo form_open_multipart('contract/edit/' . $contract['id'], $attributes);
    ?>

    <h5><?php echo $this->lang->line('Edit Contract'); ?></h5>
    <hr>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Contract Name'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="contract_name" placeholder="<?php echo $this->lang->line('Contract Name'); ?>" required value="<?php echo $contract['name']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Start Date'); ?></label>
        <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
            <input type="date" class="form-control margin-bottom datepicker" autocomplete="false" name="start_date" placeholder="<?php echo $this->lang->line('Start Date'); ?>" value="<?php echo $contract['start_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('End Date'); ?></label>
        <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
            <input type="date" class="form-control datepicker" autocomplete="false" name="end_date" placeholder="<?php echo $this->lang->line('End Date'); ?>" value="<?php echo $contract['end_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Client Name'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="client_name" placeholder="<?php echo $this->lang->line('Client Name'); ?>" value="<?php echo $contract['client_name']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Person In Charge'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="person_in_charge" placeholder="<?php echo $this->lang->line('Person In Charge'); ?>" value="<?php echo $contract['pic']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Email'); ?></label>
        <div class="col-sm-6">
            <input type="email" class="form-control margin-bottom" name="email" placeholder="<?php echo $this->lang->line('Email'); ?>" value="<?php echo $contract['email']; ?>">
            <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Phone'); ?></label>
        <div class="col-sm-6">
            <input type="text" class="form-control margin-bottom" name="phone" placeholder="<?php echo $this->lang->line('Phone'); ?>" value="<?php echo $contract['phone']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Reminder Date'); ?></label>
        <div class="col-sm-6">
            <input type="date" class="form-control margin-bottom datepicker" name="reminder_date" placeholder="<?php echo $this->lang->line('Reminder Date'); ?>" value="<?php echo $contract['reminder_date']; ?>">
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Remarks'); ?></label>
        <div class="col-sm-6">
            <textarea class="form-control margin-bottom" name="remarks" placeholder="<?php echo $this->lang->line('Remarks'); ?>"><?php echo $contract['remarks']; ?></textarea>
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
        <input type="submit" class="btn btn-success margin-bottom" name="submit" value="<?php echo $this->lang->line('Add Contract') ?>" data-loading-text="Adding...">
        <!-- <input type="hidden" value="contract/edit" id="action-url"> -->
    </div>
    </div>

    <?php echo form_close(); ?>
    </div>

    <!-- JavaScript to display file preview -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.234/pdf.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
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

    </script>
