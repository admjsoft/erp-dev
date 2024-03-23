<div class="content-body">
<?php if ($response == 1) {
            echo '<div id="notify" class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $responsetext . '</div>
        </div>';
        } else if ($response == 0) {
            echo '<div id="notify" class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>

            <div class="message">' . $responsetext . '</div>
        </div>';
        } ?>

    <div class="card ">
        
        <div class="card-header">
            <h5><?php echo $this->lang->line('Upload New Document') ?></h5>
            <a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
            <div class="heading-elements">
                <ul class="list-inline mb-0">
                    <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    <li><a data-action="close"><i class="ft-x"></i></a></li>
                </ul>
            </div>
        </div>
        <hr>

        <div class="card-content">

            <div class="card-body">
                <?php echo form_open_multipart('employee/adddocument'); ?>
                <input type="hidden" value="<?= $id ?>" name="id">
               

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label" for="name"><?php echo $this->lang->line('Title') ?></label>

                    <div class="col-sm-6">
                        <input type="text" placeholder="Document Title" class="form-control margin-bottom  required"
                            name="title">
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-4 col-form-label" for="name"><?php echo $this->lang->line('Document') ?>
                        (docx,docs,txt,pdf,xls)</label>

                    <div class="col-sm-6">
                    <input type="file" name="userfile" id="userfileDoc" onchange="checkFileSize(this)"
                                       accept=".docx, .docs, .txt, .pdf, .xls, .xlsx, .png, .jpg, .jpeg, .gif" />

                                            (docx, docs, txt, pdf, xls, png, jpg, gif, pptx)
                    </div>
                </div>


                <div class="form-group row">

                    <label class="col-sm-4 col-form-label"></label>

                    <div class="col-sm-4">
                        <input type="submit" id="document_add" class="btn btn-success margin-bottom"
                            value="<?php echo $this->lang->line('Upload Document') ?>" data-loading-text="Adding...">
                    </div>
                </div>


                </form>
            </div>
        </div>
    </div>
</div>

<script>
    
function checkFileSize(input) {

if (input.files && input.files[0]) {
    var file = input.files[0];
    var fileSize = file.size; // in bytes
    var maxSize = 5 * 1024 * 1024; // 2 MB
    // var allowedExtension = 'zip';
    // var fileExtension = file.name.split('.').pop().toLowerCase();
    // Check file size
    if (fileSize > maxSize) {
        //alert("File size exceeds 2 MB. Please upload the file in ZIP format.");
        Swal.fire({
            icon: "error",
            title: "File size exceeds 5 MB. Please upload the file less than 5 MB.",
            showConfirmButton: false,
            timer: 1500
        });
        input.value = ''; // Clear the file input
        return;
    }

    // Check file extension
    // var fileExtension = file.name.split('.').pop().toLowerCase();
    // if (fileExtension !== allowedExtension) {
    //     alert("Invalid file format. Please upload a ZIP file.");
    //     input.value = ''; // Clear the file input
    //     return;
    // }
}

}
</script>    