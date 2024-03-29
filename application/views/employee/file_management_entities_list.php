<div class="content-body">
    <div id="c_body"></div>
    <div class="card">
    <div class="card-header">
            <h5 class="title">
                <?php echo $this->lang->line('File Management System') ?>

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
            <div id="notify" class="alert alert-success" style="display:none;">
                <a href="#" class="close" data-dismiss="alert">&times;</a>

                <div class="message"></div>
            </div>
            <div>
            </div>
            


<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalNewFile">
  Open Modal
</button> -->
            <div class="card-body">
            <?php /* ?>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('filemanager'); ?>"><i
                                class="fa fa-home"></i></a></li>
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                    <?php if ($breadcrumb['entity_type'] == 'folder'): ?>
                    <li class="breadcrumb-item"><a
                            href="<?php echo base_url('filemanager/list_contents/'.$breadcrumb['entity_id']); ?>"><?php echo $breadcrumb['entity_name']; ?></a>
                    </li>
                    <?php else: ?>
                    <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb['entity_name']; ?>
                    </li>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
            </nav>
            <?php */ ?>
            <nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('filemanager'); ?>"><i class="fa fa-home"></i></a></li>
                    <?php foreach ($breadcrumbs as $breadcrumb): ?>
                        <?php if ($breadcrumb['entity_type'] == 'folder'): ?>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('filemanager/list_contents/'.$breadcrumb['entity_id']); ?>"><?php echo $breadcrumb['entity_name']; ?></a></li>
                        <?php else: ?>
                            <li class="breadcrumb-item active" aria-current="page"><?php echo $breadcrumb['entity_name']; ?></li>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ol>
                <!-- <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalNewFile">Add File / Folder</button> -->
            </nav>


                <table id="emptable" class="table table-striped table-bordered zero-configuration" cellspacing="0"
                    width="100%">

                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($contents)) { foreach ($contents as $content): ?>
                        <tr>
                            <td>
                                <?php if ($content['entity_type'] == 'folder'): ?>
                                    <i class="icon-folder"></i>
                                <a href="<?php echo base_url('filemanager/list_contents/'.$content['entity_id']); ?>"><?php echo $content['entity_name']; ?></a>
                                <?php else: ?>
                                    <i class="icon-paper-clip"></i> 
                                <?php echo $content['entity_name']; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo ucfirst($content['entity_type']); ?></td>
                            <td>
                                <?php /* ?>
                                <?php if ($content['entity_type'] == 'file'): ?>
                                <a href="<?php echo base_url('filemanager/view_file/'.$content['entity_id']); ?>">View</a>
                                <?php endif; ?>
                                <a href="javascript:void(0);" entity_id="<?php echo $content['entity_id']; ?>" onclick="openRenameModal(<?php echo $content['entity_id']; ?>,'<?php echo $content['entity_name']; ?>')">ReName</a>
                                <a href="javascript:void(0);" entity_id="<?php echo $content['entity_id']; ?>" onclick="confirmDelete(<?php echo $content['entity_id']; ?>)">Delete</a>
                                <a href="javascript:void(0);" onclick="shareToEmployee(<?php echo $content['entity_id']; ?>)"> Share To Employee</a>
                                <a href="javascript:void(0);" onclick="shareToCustomer(<?php echo $content['entity_id']; ?>)"> Share To Customers</a>
                                <?php if ($content['global_lock'] == 1 || $content['customer_locks'] >= 1 || $content['employee_locks'] >= 1): ?>
                                <a href="javascript:void(0);"  onclick="openunLockModal(<?php echo $content['entity_id']; ?>)">Unlock</a>
                                <?php else: ?>
                                <a href="javascript:void(0);" onclick="openLockModal(<?php echo $content['entity_id']; ?>)">Lock</a>
                                <?php endif; ?>
                                <?php */ ?>
                                <?php /* ?>
                                <?php if ($content['entity_type'] == 'file'): ?>
                                    <a href="<?php echo base_url('filemanager/view_file/'.$content['entity_id']); ?>" title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a href="<?php echo base_url('filemanager/list_contents/'.$content['entity_id']); ?>" title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                <?php endif; ?>

                                <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Rename" onclick="openRenameModal(<?php echo $content['entity_id']; ?>,'<?php echo $content['entity_name']; ?>')">
                                    <i class="icon-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Delete" onclick="confirmDelete(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-trash"></i>
                                </button>

                                <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Share To Employee" onclick="shareToEmployee(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-users"></i>
                                </button>

                                <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Share To Customers" onclick="shareToCustomer(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-share"></i>
                                </button>

                                <?php if ($content['global_lock'] == 1 || $content['customer_locks'] >= 1 || $content['employee_locks'] >= 1): ?>
                                    <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Unlock" onclick="openunLockModal(<?php echo $content['entity_id']; ?>)">
                                        <i class="icon-lock-open"></i>
                                    </button>
                                <?php else: ?>
                                    <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Lock" onclick="openLockModal(<?php echo $content['entity_id']; ?>)">
                                        <i class="icon-lock"></i>
                                    </button>
                                <?php endif; ?>

                                <?php if ($content['entity_type'] == 'file'): ?>
                                    <a href="<?php echo base_url('filemanager/download_file/'.$content['entity_id']); ?>" title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="icon-arrow-down"></i>
                                        </button>
                                    </a>
                                <?php endif; ?>

                                <a href="javascript:void(0);" title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="View" onclick="openLogsModal(<?php echo $content['entity_id']; ?>)">
                                            <i class="fa fa-file-code-o"></i>
                                        </button>
                                    </a>
                                <?php */ ?>

                                
                            </td>
                        </tr>
                        <?php endforeach; } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/'); ?>multi_select_css/example-styles.css">
<script type="text/javascript" src="<?php echo base_url('assets/'); ?>multi_select_js/jquery.multi-select.js"></script>

<!-- Rename Modal -->
<div id="renameModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Rename File</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>

            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('filemanager/rename_file_action'); ?>" method="post">
                    <input type="hidden" name="file_id" id="file_id" value="">
                    <div class="form-group">
                        <label for="new_name">New Name:</label>
                        <input type="text" class="form-control" id="new_name" name="new_name" value="">
                    </div>
                    <button type="submit" class="btn btn-default">Rename</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirm Delete</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this file?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button id="deleteButton" type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myEmpModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('filemanager/employee_access'); ?>" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Share Access To Employees</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">


                    <div class="row">
                        <div class="col-lg-12">
                            <label for="people">Select Employees:</label>
                            <select id="share_employees" class="form-control" name="share_employees[]" multiple>
                                <?php if(!empty($employees)) { foreach($employees as $emp){ ?>
                                <option value="<?php echo $emp['id']; ?>"><?php echo $emp['name']; ?></option>
                                <?php }} ?>
                            </select>
                            <input type="hidden" name="emp_file_id" id="emp_file_id" value="">
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal" id="myCustModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="<?php echo base_url('filemanager/customer_access'); ?>" method="post">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Share Access To Customers</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <label for="people">Select Customers:</label>
                            <select id="share_customers" class="form-control" name="share_customers[]" multiple>
                                <?php if(!empty($customers)) { foreach($customers as $cust){ ?>
                                <option value="<?php echo $cust->id; ?>"><?php echo $cust->name; ?></option>
                                <?php }} ?>
                            </select>
                            <input type="hidden" name="cust_file_id" id="cust_file_id" value="">
                        </div>
                    </div>

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="myLockModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <form action="<?php echo base_url('filemanager/lock_file'); ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Custom Modal Popup</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <!-- Global Lock Option -->
                    <div class="form-group">
                        <label for="globalLock">Global Lock:</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="globalLock" id="globalLockYes"
                                value="yes">
                            <label class="form-check-label" for="globalLockYes">Yes</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="globalLock" id="globalLockNo" value="no"
                                checked>
                            <label class="form-check-label" for="globalLockNo">No</label>
                        </div>
                    </div>

                    <!-- Multi-select Dropdown for Customers -->
                    <div class="form-group">
                        <label for="customers">Select Employees:</label>
                        <select id="share_lock_employees" class="form-control" name="share_lock_employees[]" multiple>
                            <?php if(!empty($employees)) { foreach($employees as $emp_l){ ?>
                            <option value="<?php echo $emp_l['id']; ?>"><?php echo $emp_l['name']; ?></option>
                            <?php }} ?>
                        </select>
                    </div>

                    <!-- Multi-select Dropdown for Employees -->
                    <div class="form-group">
                        <label for="employees">Select Customers:</label>
                        <select id="share_lock_customers" class="form-control" name="share_lock_customers[]" multiple>
                            <?php if(!empty($customers)) { foreach($customers as $cust_l){ ?>
                            <option value="<?php echo $cust_l->id; ?>"><?php echo $cust_l->name; ?></option>
                            <?php }} ?>
                        </select>
                    </div>
                    <input type="hidden" name="lock_file_id" id="lock_file_id" value="">
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="myUnLockModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <form action="<?php echo base_url('filemanager/unlock_file'); ?>" method="post">
                <div class="modal-header">
                    <h4 class="modal-title">Custom Modal Popup</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body" id="un_lock_modal_body">
                    <!-- Global Lock Option -->

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModalNewFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id="modalForm" enctype="multipart/form-data" action="<?php echo base_url('filemanager/add_entity'); ?>" method="post">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Choose Folder or File</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-check">
          <input class="form-check-input" type="radio" name="entityType" id="folderRadio" value="folder">
          <label class="form-check-label" for="folderRadio">
            Folder
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="entityType" id="fileRadio" value="file">
          <label class="form-check-label" for="fileRadio">
            File
          </label>
        </div>
        <div id="folderInput" style="display:none;">
          <input type="text" class="form-control" id="folderName" name="folderName" placeholder="Folder Name">
        </div>
        <div id="fileInput" style="display:none;">
          <input type="text" class="form-control" id="fileName" name="fileName" placeholder="File Name">
          <input type="file" class="form-control-file mt-2" id="fileUpload" name="userfile">
        </div>
        <input type="hidden" name="parentId" id="parentId" value="<?php echo $parent_id; ?>" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" >Submit</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myLogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal Title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="log_modal_body">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
function openRenameModal(fileId, fileName) {
    $('#file_id').val(fileId); // Set the file ID in the hidden input field
    $('#new_name').val(fileName);
    $('#renameModal').modal('show'); // Show the modal
}

// Function to confirm delete and trigger delete action
function confirmDelete(fileId) {
    $('#deleteButton').click(function() {
        // Redirect to delete action
        window.location.href = "<?php echo base_url('filemanager/delete_file/'); ?>" + fileId;
    });
    $('#deleteModal').modal('show'); // Show the delete confirmation modal
}

function shareToEmployee(fileId) {
    $('#emp_file_id').val(fileId);
    $('#myEmpModal').modal('show'); // Show the delete confirmation modal
}

function shareToCustomer(fileId) {
    $('#cust_file_id').val(fileId);
    $('#myCustModal').modal('show'); // Show the delete confirmation modal
}

function openLockModal(fileId) {
    $('#lock_file_id').val(fileId);
    $('#myLockModal').modal('show'); // Show the delete confirmation modal
}

$(document).ready(function() {

    $('#share_employees').multiSelect();
    $('#share_customers').multiSelect();

    $('#share_lock_employees').multiSelect();
    $('#share_lock_customers').multiSelect();

    $('#emptable').DataTable({
    ordering: false
    });

    $('[data-toggle="tooltip"]').tooltip();   
  
});


function openunLockModal(fileId) {
    $.ajax({
        "url": "<?php echo site_url('filemanager/getFileLockDetails') ?>",
        "type": "POST",
        "dataType": 'json',
        'data': {
            'fileId': fileId
        },
        success: function(result) {
            if (result.status) {
                $("#un_lock_modal_body").html(result.html);
                $('#myUnLockModal').modal('show');                
                $('#share_unlock_employees').multiSelect();
                $('#share_unlock_customers').multiSelect();
            }
        }
    });
}

function openLogsModal(fileId) {
    $.ajax({
        "url": "<?php echo site_url('filemanager/getFileLogDetails') ?>",
        "type": "POST",
        "dataType": 'json',
        'data': {
            'fileId': fileId
        },
        success: function(result) {
            if (result.status) {
                $("#log_modal_body").html(result.html);
                $('#myLogModal').modal('show');  
            }
        }
    });
}



document.addEventListener("DOMContentLoaded", function() {
  // Add event listeners to radio buttons
  var folderRadio = document.getElementById("folderRadio");
  var fileRadio = document.getElementById("fileRadio");

  folderRadio.addEventListener("click", toggleInputs);
  fileRadio.addEventListener("click", toggleInputs);
});

// Function to show/hide input fields based on radio button selection
function toggleInputs() {
  var folderInput = document.getElementById("folderInput");
  var fileInput = document.getElementById("fileInput");
  var folderRadio = document.getElementById("folderRadio");

  if (folderRadio.checked) {
    folderInput.style.display = "block";
    fileInput.style.display = "none";
  } else {
    folderInput.style.display = "none";
    fileInput.style.display = "block";
  }
}



</script>