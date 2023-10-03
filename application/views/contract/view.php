<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.234/pdf.js"></script>

<div class="content-body">
    <div class="card">
        <div class="card-header">
            <h3><?php echo $contract['name'] ?></h3>
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

                <div class="row">
                    <div class="col-sm-6">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Start Date') ?></div>
                            <div class="value"><?php echo dateformat_time($contract['start_date']) ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('End Date') ?></div>
                            <div class="value"><?php echo dateformat_time($contract['end_date']) ?></div>
                        </div>
                        <hr>
                    </div>

                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Client Name') ?></div>
                            <div class="value"><?php echo $contract['client_name'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Person In Charge') ?></div>
                            <div class="value"><?php echo $contract['pic'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">

                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Email') ?></div>
                            <div class="value"><?php echo $contract['email'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Phone') ?></div>
                            <div class="value"><?php echo $contract['phone'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Reminder Date') ?></div>
                            <div class="value"><?php echo dateformat_time($contract['reminder_date']) ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Remarks') ?></div>
                            <div class="value"><?php echo $contract['remarks'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Status') ?></div>
                            <div class="value"><?php echo $contract['status'] ?></div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-sm-6 stat-col">
                        <div class="stat">
                            <div class="name"><?php echo $this->lang->line('Last Updated On') ?></div>
                            <div class="value"><?php echo dateformat_time($contract['updated_on']) ?></div>
                        </div>
                        <hr>
                    </div>
                    
                   <!-- Display associated upload files -->
                <div class="row">
                    <div class="col-md-12">
                    <div class="stat">
                        <h4>Uploaded Files</h4>
                        <ol>
                            <?php foreach ($upload_files as $file): ?>
                                <li>
                                    <?php
                                    // Determine the file extension
                                    $fileExtension = pathinfo($file['file_name'], PATHINFO_EXTENSION);

                                    // Check if it's an image file (png, jpg, jpeg, gif)
                                    if (in_array($fileExtension, ['png', 'jpg', 'jpeg', 'gif'])):
                                    ?>
                                        <img src="<?php echo base_url('uploads/' . $file['file_name']); ?>" alt="<?php echo $file['file_name']; ?>" style="max-width: 100%; height: auto;">
                                         <!-- Add sharing icons for email and WhatsApp -->
                                        <div class="sharing-icons">
                                        <!-- Email sharing icon -->
                                        <a href="mailto:?subject=Check%20out%20this%20image&body=I%20found%20this%20image%20and%20thought%20you%20might%20like%20it:%20<?php echo base_url('path_to_root_folder/' . $file['file_name']); ?>"><i class="fa fa-envelope"></i></a>
                                        
                                        <!-- WhatsApp sharing icon -->
                                        <a href="whatsapp://send?text=Check%20out%20this%20image:%20<?php echo base_url('path_to_root_folder/' . $file['file_name']); ?>"><i class="fa fa-whatsapp"></i></a>
                                    </div>
                                    <?php
                                    // Check if it's a PDF file
                                    elseif ($fileExtension === 'pdf'):
                                    ?>
                                        <!-- Display PDF file using PDF.js viewer -->
                                        <iframe src="<?php echo base_url('uploads/' . $file['file_name']); ?>" width="100%" height="500px"></iframe>
                                        <div class="sharing-icons">
                                        <!-- Email sharing icon -->
                                        <a href="mailto:?subject=Check%20out%20this%20PDF&body=I%20found%20this%20PDF%20and%20thought%20you%20might%20find%20it%20interesting:%20<?php echo base_url('path_to_root_folder/' . $file['file_name']); ?>"><i class="fa fa-envelope"></i></a>
                                        
                                        <!-- WhatsApp sharing icon -->
                                        <a href="whatsapp://send?text=Check%20out%20this%20PDF:%20<?php echo base_url('path_to_root_folder/' . $file['file_name']); ?>"><i class="fa fa-whatsapp"></i></a>
                                    </div>
                                    <?php
                                    else:
                                        // Handle other file types as needed (provide download link)
                                    ?>
                                        <a href="<?php echo base_url('uploads/' . $file['file_name']); ?>" download="<?php echo $file['file_name']; ?>"><?php echo $file['file_name']; ?></a>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript to display file preview and check file size -->
<script>
    document.querySelector('input[name="contract_files[]"]').addEventListener('change', function() {
        const fileInput = this;
        const filePreview = document.getElementById('file-preview');
        filePreview.innerHTML = '';

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

            filePreview.appendChild(filePreviewItem);
        }
    });
</script>
