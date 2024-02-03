<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.css"> -->
<link rel="stylesheet" href="<?php echo base_url('pdf-assets/'); ?>styles.css">
<link rel="stylesheet" href="<?php echo base_url('pdf-assets/'); ?>pdfannotate.css">
<style>

#pdf-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
    box-sizing: border-box;
    text-align:center !important;
}

.canvas-container {
    width: 100% !important;
    position: relative;
    overflow: hidden;
    min-height: 500px; 
}

.pdf-canvas {
    display: block; 
    width: auto !important; 
    max-width: 100%; 
    height: auto !important; 
    margin: 0 auto; 
} 

#pdf-container .canvas-container {
    width: 100% !important;
    height: auto !important; 
    position: relative;
    overflow: hidden;
    min-height: 500px; 
    text-align:center !important;
}


/* 


#pdf-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
    box-sizing: border-box;
}

.canvas-container {
    width: 100% !important;
    position: relative;
    overflow: hidden;
}

.pdf-canvas {
    display: block; 
    width: auto !important; 
    max-width: 100%; 
    height: auto !important; 
    margin: 0 auto; 
}   */
/* 
#pdf-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
    box-sizing: border-box;
}

.canvas-container {
    width: 100% !important;
    position: relative;
    overflow: hidden;
    min-height: 500px; 
}

.pdf-canvas {
    display: block; 
    width: auto !important; 
    max-width: 100%; 
    height: auto !important; 
    margin: 0 auto; 
}


@media (max-width: 767px) {
    .canvas-container {
        padding-bottom: 141.4%; 
    }
}

#pdf-container .canvas-container {
    width: 100% !important;
    height: auto !important; 
    position: relative;
    overflow: hidden;
    min-height: 500px; 
} */
/* 
#pdf-container {
    max-width: 100%;
    margin: 0 auto;
    padding: 10px;
    box-sizing: border-box;
}

.canvas-container {
    width: 100%;
    position: relative;
    overflow: hidden;
}

.pdf-canvas {
    display: block;
    max-width: 100%;
    height: auto;
    margin: 0 auto;
    object-fit: contain;


@media (max-width: 767px) {
    .canvas-container {
        padding-bottom: 141.4%; 
    }
} */

</style>    
<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
        <div class="card-content">
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>


            <div id="invoice-template" class="card-body">
                <div class="row wrapper white-bg page-heading">

                    <div class="col text-center">
                        <h1> Jsuitecloud - E signing</h1>
                    </div>
                </div>

                <!-- Invoice Company Details -->
                <div id="invoice-company-details" class="row mt-2">
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-left">
                        <p></p>
                        <img src="<?php //$loc = location($invoice['loc']);
                        echo base_url('userfiles/company/' . $system_data[0]['logo']) ?>"
                            class="img-responsive p-1 m-b-2" style="max-height: 120px;">
                        <p class="text-muted"><?php echo $this->lang->line('From') ?></p>
                        <?php /* ?>
                        <ul class="px-0 list-unstyled">
                            <?php
                            echo '<li class="text-bold-800">' . $this->lang->line('Name') . ' : '. $contract['name'] . '</li><li>' . $this->lang->line('Start Date') . ' : ' . $contract['start_date'] . '</li><li>' . $this->lang->line('End Date') . ' : ' . $contract['end_date'] . ',</li><li>' . $this->lang->line('Client Name') . ' : ' . $contract['client_name'] . '</li><li>' . $this->lang->line('Phone') . ' : ' . $contract['phone'] . '</li><li> ' . $this->lang->line('Email') . ' : ' . $contract['email'] ?>
                            </li>
                        </ul>
                        <?php */ ?>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Name') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['name'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Start Date') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['start_date'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('End Date') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['end_date'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Client Name') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['client_name'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Person In Charge') ?> :
                                            </p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['pic'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('No Of People Shared') ?>
                                                :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['sharing_count'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Reminder Date') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['reminder_date'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Phone') ?> :</p>
                                        </div>
                                        <div class="col-md-8 ">
                                            <p><?= $contract['phone'] ?></p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <p class="font-weight-bold"><?= $this->lang->line('Email') ?> :</p>
                                        </div>
                                        <div class="col-md-8">
                                            <p><?= $contract['email'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-6 col-sm-12 text-xs-center text-md-right mt-2">
                        <h2><?php echo $this->lang->line('CONTRACT') ?></h2>
                        <p class="pb-1"> <?php echo $contract['contract_unique_id']; ?></p>

                    </div>

                </div>

                <!--/ Invoice Company Details -->



                <!-- Invoice Items Details -->
                <div class="form-group row">
                    <label class="col-sm-2 col-form-label"><?php echo $this->lang->line('Document Preview'); ?></label>
                    <!-- <div class="col-sm-6" id="file-preview">
                    </div> -->
                    
                <div class="toolbar">
                   
                    <div class="tool">
                        <label for="">Brush size</label>
                        <input type="number" class="form-control text-right" value="1" id="brush-size" max="50">
                    </div>
                    <div class="tool">
                        <label for="">Font size</label>
                        <select id="font-size" class="form-control">
                            <option value="10">10</option>
                            <option value="12">12</option>
                            <option value="16" selected>16</option>
                            <option value="18">18</option>
                            <option value="24">24</option>
                            <option value="32">32</option>
                            <option value="48">48</option>
                            <option value="64">64</option>
                            <option value="72">72</option>
                            <option value="108">108</option>
                        </select>
                    </div>
                    <div class="tool">
                        <button class="color-tool active" style="background-color: #212121;"></button>
                        <button class="color-tool" style="background-color: red;"></button>
                        <button class="color-tool" style="background-color: blue;"></button>
                        <button class="color-tool" style="background-color: green;"></button>
                        <button class="color-tool" style="background-color: yellow;"></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button active"><i class="fa fa-hand-paper-o" title="Free Hand" onclick="enableSelector(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button"><i class="fa fa-pencil" title="Pencil" onclick="enablePencil(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button"><i class="fa fa-font" title="Add Text" onclick="enableAddText(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button"><i class="fa fa-long-arrow-right" title="Add Arrow" onclick="enableAddArrow(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button"><i class="fa fa-square-o" title="Add rectangle" onclick="enableRectangle(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="tool-button"><i class="fa fa-picture-o" title="Add an Image" onclick="addImage(event)"></i></button>
                    </div>
                    <div class="tool">
                        <button class="btn btn-danger btn-sm" onclick="deleteSelectedObject(event)"><i class="fa fa-trash"></i></button>
                    </div>
                    <div class="tool">
                        <button class="btn btn-danger btn-sm" onclick="clearPage()">Clear Page</button>
                    </div>
                    <!-- <div class="tool">
                        <button class="btn btn-info btn-sm" onclick="showPdfData()">{}</button>
                    </div>
                    <div class="tool">
                        <button class="btn btn-light btn-sm" onclick="savePDF()"><i class="fa fa-save"></i> Save</button>
                    </div> -->
                </div>
                <div id="pdf-container"></div>
                </div>


                <?php if($contract['status'] != 'COMPLETED'){ ?>
                <div class="form-group row">

                    <label class="col-sm-2 col-form-label">Remarks</label>

                    <div class="col-sm-6">
                        <textarea class="form-control" cols="10" rows="5" id="contract_remarks"
                            name="contract_remarks"></textarea>
                    </div>
                </div>

                <div class="form-group row">

                    <label class="col-sm-2 col-form-label"></label>

                    <div class="col-sm-6">
                        <input type="button" class="btn btn-success margin-bottom float-right" onclick="savePDF()" name="submit"
                            id="submit-btn" value="<?php echo $this->lang->line('Update Contract') ?>"
                            data-loading-text="Adding...">
                        <input type="hidden" value="<?php echo $contract['id']; ?>" id="contract_id">
                        <input type="hidden" value="<?php echo base_url('billing/save_signing_details'); ?>" id="contract_sign_form" name="contract_sign_form" />
                    </div>
                </div>
                <?php } ?>
            </div>


            <!-- Invoice Footer -->


            <!--/ Invoice Footer -->

        </div>
        </section>
    </div>
</div>
</div>
<?php if(!empty($contract_signings)) { ?>
    <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="<?php echo $contract_signings[0]['file_path']; ?>" />
<?php }else if(!empty($upload_files)) { ?>
    <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="<?php echo $upload_files[0]['file_path']; ?>" />

<?php }else{ ?>
    <input type="hidden" id="latest_updated_doc" name="latest_updated_doc" value="https://localhost/erp-dev/userfiles/contract_docs/sample.pdf" />

<?php } ?>    
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js" integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"></script>
<script>
pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.worker.min.js';
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.3.0/fabric.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
<script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/prettify/r298/prettify.min.js"></script>
<script src="<?php echo base_url('pdf-assets/'); ?>arrow.fabric.js"></script>
<script src="<?php echo base_url('pdf-assets/'); ?>pdfannotate.js"></script>
<script src="<?php echo base_url('pdf-assets/'); ?>script.js"></script>

<script>
// $(document).on('click', '#submit-btn', function() {
//     //alert($(this).attr('do_id'));
//     var contract_id = $('#contract_id').val();
//     var contract_remarks = $('#contract_remarks').val();
//     //var p_do_id = $(this).attr('p_do_id');

//     $.ajax({
//         type: 'POST',
//         dataType: 'json',
//         url: '<?php // echo base_url('contract/save_signing_details') ?>',
//         data: {
//             contract_id: contract_id,
//             contract_remarks: contract_remarks
//         },
//         success: function(response) {

//             if (response.status == '200') {

//                 alert(response.message);
//                 location.reload();
//                 // $('#doctable').DataTable().destroy();
//                 //   $('#do_return_details_content').html('');
//                 //   $('#do_return_details_content').html(response.html);
//                 //   $('#do_return_details_modal').modal('show');
//                 // $('#doctable').DataTable();
//             } else {
//                 //alert(response.message);
//                 alert(response.message);
//             }
//             // Handle the response from the controller
//             // console.log(response);
//         },
//         error: function(error) {
//             // console.error(error);
//         }
//     });

// });
// $(document).ready(function() {

//     //const fileInput = this;
//     // const filePreview = document.getElementById('file-preview');
//     // filePreview.innerHTML = '';
//     // const pdfViewer = document.createElement('iframe');
//     // const filePreviewItem = document.createElement('div');
//     // filePreviewItem.classList.add('file-preview-item');
//     // pdfViewer.src = 'https://localhost/erp-dev/userfiles/contract_docs/sample.pdf';
//     // pdfViewer.width = 500;
//     // pdfViewer.height = 500;
//     // filePreviewItem.appendChild(pdfViewer);

//     const filePreview = document.getElementById('file-preview');
//     filePreview.innerHTML = '';

//     const pdfViewer = document.createElement('iframe');
//     pdfViewer.setAttribute('src', 'https://erp-dev.jsuitecloud.com/userfiles/contract_docs/sample.pdf');
//     pdfViewer.setAttribute('width', '690');
//     pdfViewer.setAttribute('height', '500');
//     pdfViewer.setAttribute('type', 'application/pdf'); // Set the type attribute for PDF

//     const filePreviewItem = document.createElement('div');
//     filePreviewItem.classList.add('file-preview-item');
//     filePreviewItem.appendChild(pdfViewer);

//     filePreview.appendChild(filePreviewItem);


// });
</script>
<!-- <script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-36251023-1']);
_gaq.push(['_setDomainName', 'jqueryscript.net']);
_gaq.push(['_trackPageview']);

(function() {
    var ga = document.createElement('script');
    ga.type = 'text/javascript';
    ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') +
    '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(ga, s);
})();
</script> -->