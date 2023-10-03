    <div class="card card-block">
    <div id="notify" class="alert alert-success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <div class="message"></div>
    </div>
    <div class="card card-block">
        <!-- Display uploaded files -->
        <?php if(isset($files) && !empty($files)): ?>
            <h3>Selected Files for Upload:</h3>
            <ul>
                <?php foreach($files as $file): ?>
                    <li><?php echo $file['file_name']; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Display validation errors here -->
        <div id="validation_errors" class="alert alert-danger" style="display:none;"></div>

        <?php
        $attributes = array('class' => 'card-body', 'id' => 'contract_form', 'name' => 'contract_form');
        echo form_open_multipart('contract/create', $attributes);
        ?>

        <h5><?php echo $this->lang->line('Add New Contract') ?></h5>
        <hr>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Contract Name'); ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control margin-bottom" name="contract_name" placeholder="<?php echo $this->lang->line('Contract Name'); ?>" required>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Start Date'); ?></label>
            <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
                <input type="date" class="form-control margin-bottom datepicker" 
                    autocomplete="false" name="start_date" placeholder="<?php echo $this->lang->line('Start Date'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('End Date'); ?></label>
            <div class="col-sm-6"><span class="icon-calendar4" aria-hidden="true"></span>
                <input type="date" class="form-control datepicker"
                    autocomplete="false" name="end_date" placeholder="<?php echo $this->lang->line('End Date'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Client Name'); ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control margin-bottom" name="client_name" placeholder="<?php echo $this->lang->line('Client Name'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Person In Charge'); ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control margin-bottom" name="person_in_charge" placeholder="<?php echo $this->lang->line('Person In Charge'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Email'); ?></label>
            <div class="col-sm-6">
                <input type="email" class="form-control margin-bottom" name="email" placeholder="<?php echo $this->lang->line('Email'); ?>">
                <?php echo form_error('email', '<div class="text-danger">', '</div>'); ?>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Phone'); ?></label>
            <div class="col-sm-6">
                <input type="text" class="form-control margin-bottom" name="phone" placeholder="<?php echo $this->lang->line('Phone'); ?>">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Reminder Date'); ?></label>
            <div class="col-sm-6">
                <input type="date" class="form-control margin-bottom datepicker" name="reminder_date" placeholder="<?php echo $this->lang->line('Reminder Date'); ?>">
            </div>
        </div>

        <div class="form-group row">
    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Remarks'); ?></label>
    <div class="col-sm-6">
        <textarea class="form-control margin-bottom" name="remarks" placeholder="<?php echo $this->lang->line('Remarks'); ?>"></textarea>
    </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Document Upload'); ?></label>
        <div class="col-sm-6">
            <input type="file" class="form-control-file margin-bottom" id="userfile" name="contract_files[]" accept=".pdf, .jpg, .jpeg, .png" multiple required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Document Preview'); ?></label>
        <div class="col-sm-6" id="file-preview">
        </div>
    </div>

    <div class="form-group row">

    <label class="col-sm-2 col-form-label"></label>

    <div class="col-sm-4">
        <input type="submit" class="btn btn-success margin-bottom" name="submit" value="<?php echo $this->lang->line('Add Contract') ?>" data-loading-text="Adding...">
        <!-- <input type="hidden" value="contract/create" id="action-url"> -->
    </div>
    </div>

    <?php echo form_close(); ?>
    </div>
    <!-- JavaScript to display file preview -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.234/pdf.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#contract_form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            // Redirect to the success page
                            window.location.href = response.redirect_url;
                        } else {
                            // Display validation errors
                            $('#validation_errors').html(response.validation_errors).show();
                        }
                    }
                });
            });
        });
    </script>

    <script>
    $(document).ready(function() {
        $('#contract_form').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            
            // Check if at least one file is selected
            var fileInput = document.getElementById('userfile');
            if (fileInput.files.length === 0) {
                $('#validation_errors').html('Please select at least one file.').show();
                return;
            }

            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: formData,
                dataType: 'json',
                contentType: false, // Important for file uploads
                processData: false, // Important for file uploads
                success: function(response) {
                    if (response.success) {
                        // Redirect to the success page
                        window.location.href = response.redirect_url;
                    } else {
                        // Display validation errors
                        $('#validation_errors').html(response.validation_errors).show();
                    }
                }
            });
        });
    });
</script>

    <!-- JavaScript to display file preview, check file size, and remove files -->
    <script>
        document.querySelector('input[name="contract_files[]"]').addEventListener('change', function() {
            const fileInput = this;
            const filePreview = document.getElementById('file-preview');
            filePreview.innerHTML = '';

            const removeAllButton = document.createElement('a');
            removeAllButton.href = '#';
            removeAllButton.classList.add('btn', 'btn-danger', 'btn-sm', 'rounded');
            removeAllButton.setAttribute('data-lang', 'Remove All');
            removeAllButton.innerHTML = '<span class="fa fa-trash-o"></span> Remove All';
            removeAllButton.addEventListener('click', function() {
                // Remove all files from the input element and the preview
                fileInput.value = null;
                filePreview.innerHTML = '';
            });

            filePreview.appendChild(removeAllButton);

            for (const file of fileInput.files) {
                const filePreviewItem = document.createElement('div');
                filePreviewItem.classList.add('file-preview-item');

                const fileName = document.createElement('strong');
                fileName.textContent = file.name;
                filePreviewItem.appendChild(fileName);

                if (file.size > 2048 * 1024) { // 2MB limit (2048 * 1024 bytes)
                    const fileSizeWarning = document.createElement('p');
                    fileSizeWarning.style.color = 'red';
                    fileSizeWarning.textContent = 'File size exceeds the limit (2MB).';

                    filePreviewItem.appendChild(fileSizeWarning);
                } else {
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
                }

                // Add the custom remove button for the individual file
                const removeButton = document.createElement('a');
                removeButton.href = '#';
                removeButton.setAttribute('data-object-id', '1');
                removeButton.classList.add('btn', 'btn-danger', 'btn-sm', 'delete-object');
                removeButton.innerHTML = '<span class="fa fa-trash"></span>';
                removeButton.addEventListener('click', function() {
                    // Remove the file from the input element and the preview
                    fileInput.value = null;
                    filePreviewItem.remove();
                });

                const buttonContainer = document.createElement('div');
                buttonContainer.classList.add('remove-button-container');
                buttonContainer.appendChild(removeButton);

                filePreviewItem.appendChild(buttonContainer);

                filePreview.appendChild(filePreviewItem);
            }
        });
    </script>


</div>
