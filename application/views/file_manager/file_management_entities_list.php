<style>
@media (max-width: 767.98px) {
    .modal-body .row.justify-content-center .col-lg-6 {
        max-width: 100%;
    }

    .multi-select-button {
        width: 22em;
        padding: 1em 8em;
    }
}

.dashb_pr_wrapper {
    text-transform: uppercase;
    position: relative;
}

.dashb_pr_wrapper .dashb_pr_tooltip {
    background: #1496bb;
    bottom: 100%;
    color: #fff;
    display: block;
    left: -20px;
    margin-bottom: 15px;
    opacity: 0;
    padding: 20px;
    pointer-events: none;
    position: absolute;
    width: 100%;
    -webkit-transform: translateY(10px);
    -moz-transform: translateY(10px);
    -ms-transform: translateY(10px);
    -o-transform: translateY(10px);
    transform: translateY(10px);
    -webkit-transition: all .25s ease-out;
    -moz-transition: all .25s ease-out;
    -ms-transition: all .25s ease-out;
    -o-transition: all .25s ease-out;
    transition: all .25s ease-out;
    -webkit-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -moz-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -ms-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    -o-box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
    box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.28);
}

/* This bridges the gap so you can mouse into the dashb_pr_tooltip without it disappearing */
.dashb_pr_wrapper .dashb_pr_tooltip:before {
    bottom: -20px;
    content: " ";
    display: block;
    height: 20px;
    left: 0;
    position: absolute;
    width: 100%;
}

/* CSS Triangles - see Trevor's post */
.dashb_pr_wrapper .dashb_pr_tooltip:after {
    border-left: solid transparent 10px;
    border-right: solid transparent 10px;
    border-top: solid #1496bb 10px;
    bottom: -10px;
    content: " ";
    height: 0;
    left: 50%;
    margin-left: -13px;
    position: absolute;
    width: 0;
}

.dashb_pr_wrapper:hover .dashb_pr_tooltip {
    opacity: 1;
    pointer-events: auto;
    -webkit-transform: translateY(0px);
    -moz-transform: translateY(0px);
    -ms-transform: translateY(0px);
    -o-transform: translateY(0px);
    transform: translateY(0px);
}

/* IE can just show/hide with no transition */
.lte8 .dashb_pr_wrapper .dashb_pr_tooltip {
    display: none;
}

.lte8 .dashb_pr_wrapper:hover .dashb_pr_tooltip {
    display: block;
}
</style>
<div class="content-body">

    <div id="c_body"></div>
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
    <div class="card">
        <div class="card-header" style="background-color : #4DD5E7;">
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
                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#exampleModalNewFile">Add File / Folder</button>
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
                                <a
                                    href="<?php echo base_url('filemanager/list_contents/'.$content['entity_id']); ?>"><?php echo $content['entity_name']; ?></a>
                                <?php else: ?>
                                <i class="icon-paper-clip"></i>
                                <?php echo $content['entity_name']; ?>
                                <?php endif; ?>
                            </td>
                            <td><?php echo ucfirst($content['entity_type']); ?></td>
                            <td>
                                <?php /* ?>
                                <?php if ($content['entity_type'] == 'file'): ?>
                                <a
                                    href="<?php echo base_url('filemanager/view_file/'.$content['entity_id']); ?>">View</a>
                                <?php endif; ?>
                                <a href="javascript:void(0);" entity_id="<?php echo $content['entity_id']; ?>"
                                    onclick="openRenameModal(<?php echo $content['entity_id']; ?>,'<?php echo $content['entity_name']; ?>')">ReName</a>
                                <a href="javascript:void(0);" entity_id="<?php echo $content['entity_id']; ?>"
                                    onclick="confirmDelete(<?php echo $content['entity_id']; ?>)">Delete</a>
                                <a href="javascript:void(0);"
                                    onclick="shareToEmployee(<?php echo $content['entity_id']; ?>)"> Share To
                                    Employee</a>
                                <a href="javascript:void(0);"
                                    onclick="shareToCustomer(<?php echo $content['entity_id']; ?>)"> Share To
                                    Customers</a>
                                <?php if ($content['global_lock'] == 1 || $content['customer_locks'] >= 1 || $content['employee_locks'] >= 1): ?>
                                <a href="javascript:void(0);"
                                    onclick="openunLockModal(<?php echo $content['entity_id']; ?>)">Unlock</a>
                                <?php else: ?>
                                <a href="javascript:void(0);"
                                    onclick="openLockModal(<?php echo $content['entity_id']; ?>)">Lock</a>
                                <?php endif; ?>
                                <?php */ ?>
                                <?php if ($content['entity_type'] == 'file'): ?>
                                <a href="<?php echo base_url('filemanager/view_file/'.$content['entity_id']); ?>"
                                    title="View">
                                    <button type="button" class="btn btn-sm btn-primary" title="View">
                                        <i class="icon-eye"></i>
                                    </button>
                                </a>
                                <?php else: ?>
                                <a href="<?php echo base_url('filemanager/list_contents/'.$content['entity_id']); ?>"
                                    title="View">
                                    <button type="button" class="btn btn-sm btn-primary" title="View">
                                        <i class="icon-eye"></i>
                                    </button>
                                </a>
                                <?php endif; ?>

                                <button type="button" class="btn btn-sm btn-info" title="Rename"
                                    onclick="openRenameModal(<?php echo $content['entity_id']; ?>,'<?php echo $content['entity_name']; ?>')">
                                    <i class="icon-pencil"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-danger" title="Delete"
                                    onclick="confirmDelete(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-trash"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-warning" title="Share To Employee"
                                    onclick="shareToEmployee(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-users"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-purple" title="Share To Customers"
                                    onclick="shareToCustomer(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-share"></i>
                                </button>

                                <?php if ($content['global_lock'] == 1 || $content['customer_locks'] >= 1 || $content['employee_locks'] >= 1): ?>
                                <button type="button" class="btn btn-sm btn-success" title="Unlock"
                                    onclick="openunLockModal(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-lock-open"></i>
                                </button>
                                <?php else: ?>
                                <button type="button" class="btn btn-sm btn-success" title="Lock"
                                    onclick="openLockModal(<?php echo $content['entity_id']; ?>)">
                                    <i class="icon-lock"></i>
                                </button>
                                <?php endif; ?>

                                <?php if ($content['entity_type'] == 'file'): ?>
                                <a href="<?php echo base_url('filemanager/download_file/'.$content['entity_id']); ?>"
                                    title="View">
                                    <button type="button" class="btn btn-sm btn-grey" title="View">
                                        <i class="icon-arrow-down"></i>
                                    </button>
                                </a>
                                <?php endif; ?>

                                <a href="javascript:void(0);" title="Logs">
                                    <button type="button" class="btn btn-sm btn-info" title="View"
                                        onclick="openLogsModal(<?php echo $content['entity_id']; ?>)">
                                        <i class="fa fa-file-code-o"></i>
                                    </button>
                                </a>

                                <a href="javascript:void(0);" title="Copy / Move">
                                    <button type="button" class="btn btn-sm btn-warning" title="View"
                                        onclick="openTransferModal(<?php echo $content['entity_id']; ?>)">
                                        <i class="fa fa-copy"></i>
                                    </button>
                                </a>



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
            <form action="<?php echo base_url('filemanager/rename_file_action'); ?>" method="post">
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h4 class="modal-title">Rename File</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">

                    <input type="hidden" name="file_id" id="file_id" value="">
                    <div class="form-group">
                        <label for="new_name">New Name:</label>
                        <input type="text" class="form-control" id="new_name" name="new_name" value="">
                    </div>
                    <!-- <button type="submit" class="btn btn-default">Rename</button> -->

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Rename</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div id="deleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header" style="background-color : #4DD5E7;">
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
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h4 class="modal-title">Share Access To Employees</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->
                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <label for="people" class="text-center">Select Employees:</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <select id="share_employees" class="form-control" name="share_employees[]" multiple>
                                <?php if(!empty($employees)) { foreach($employees as $emp){ ?>
                                <option value="<?php echo $emp['id']; ?>"><?php echo $emp['name']; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="emp_file_id" id="emp_file_id" value="">

                </div>

                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-success dashb_pr_wrapper">Selected Employees
                        <div class="dashb_pr_tooltip m-2" id="selected_employees">

                        </div>

                    </a>
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
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h4 class="modal-title">Share Access To Customers</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal Body -->



                <div class="modal-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <label for="people" class="text-center">Select Customers:</label>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-6 col-md-12">
                            <select id="share_customers" class="form-control" name="share_customers[]" multiple>
                                <?php if(!empty($customers)) { foreach($customers as $cust){ ?>
                                <option value="<?php echo $cust->id; ?>"><?php echo $cust->name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="cust_file_id" id="cust_file_id" value="">
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a class="btn btn-success dashb_pr_wrapper">Selected Customers
                        <div class="dashb_pr_tooltip m-2" id="selected_customers">

                        </div>

                    </a>
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
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h4 class="modal-title">File / Folder Lock</h4>
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


                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <label for="people" class="text-center">Select Employees:</label>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-lg-6 col-md-12">
                            <select id="share_lock_employees" class="form-control" name="share_lock_employees[]"
                                multiple>
                                <?php if(!empty($employees)) { foreach($employees as $emp_l){ ?>
                                <option value="<?php echo $emp_l['id']; ?>"><?php echo $emp_l['name']; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-lg-6 col-md-12">
                            <label for="people" class="text-center">Select Customers:</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-12">
                            <select id="share_lock_customers" class="form-control" name="share_lock_customers[]"
                                multiple>
                                <?php if(!empty($customers)) { foreach($customers as $cust_l){ ?>
                                <option value="<?php echo $cust_l->id; ?>"><?php echo $cust_l->name; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
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
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h4 class="modal-title">File / Folder UnLock</h4>
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
<div class="modal fade" id="exampleModalNewFile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modalForm" enctype="multipart/form-data"
                action="<?php echo base_url('filemanager/add_entity'); ?>" method="post">
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Folder or File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="entityType" id="folderRadio" value="folder"
                            checked>
                        <label class="form-check-label" for="folderRadio">
                            Folder
                        </label>
                    </div>
                    <div class="form-check mb-1">
                        <input class="form-check-input" type="radio" name="entityType" id="fileRadio" value="file">
                        <label class="form-check-label" for="fileRadio">
                            File
                        </label>
                    </div>
                    <div id="folderInput" style="">
                        <input type="text" class="form-control" id="folderName" name="folderName"
                            placeholder="Folder Name">
                    </div>
                    <div id="fileInput" style="display:none;">
                        <input type="text" class="form-control" id="fileName" name="fileName" placeholder="File Name">
                        <input type="file" class="form-control-file mt-2" id="fileUpload" name="userfile"
                            onchange="checkFileSize(this)">
                    </div>
                    <label>Max Upload Size 5mb. For Larger Files upload in ZIP format</label>
                    <input type="hidden" name="parentId" id="parentId" value="<?php echo $parent_id; ?>" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myLogModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color : #4DD5E7;">
                <h5 class="modal-title" id="exampleModalLabel">File / Folder Logs</h5>
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

<!-- Modal -->
<div class="modal fade" id="exampleModalFileTransfer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="modalFormTransfer" enctype="multipart/form-data"
                action="<?php echo base_url('filemanager/transfer_file'); ?>" method="post">
                <div class="modal-header" style="background-color : #4DD5E7;">
                    <h5 class="modal-title" id="exampleModalLabel">Choose Copy or Move</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actionType" id="copyRadio" value="copy"
                            checked>
                        <label class="form-check-label" for="folderRadio">
                            Copy
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="actionType" id="moveRadio" value="move">
                        <label class="form-check-label" for="fileRadio">
                            Move
                        </label>
                    </div>
                    </br>
                    <div id="folder_transfer_block mt-1">

                        <nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item"><a href="javascript:void(0);"
                                        onclick="getParentFolders('')"><i class="fa fa-home"></i></a></li>

                            </ol>

                        </nav>
                        <div id="fileInputCopy" style="">
                            <select id="folder_heirarichy" class="form-control folder_heirarichy"
                                name="folder_heirarichy">
                                <option value="">Select Folder</option>
                                <?php if(!empty($folders)) { foreach($folders as $folder){ ?>
                                <option value="<?php echo $folder['entity_id']; ?>">
                                    <?php echo $folder['entity_name']; ?></option>
                                <?php }} ?>
                            </select>
                        </div>
                        <input type="hidden" name="parentId" id="TransferparentId" value="<?php echo NULL; ?>" />
                    </div>



                    <input type="hidden" name="transfer_file_id" id="transfer_file_id" value="" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
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

function openTransferModal(fileId) {
    $('#transfer_file_id').val(fileId);
    $('#exampleModalFileTransfer').modal('show'); // Show the delete confirmation modal
}

function getParentFolders(folderId) {

    $.ajax({
        "url": "<?php echo site_url('filemanager/getFolderHeirarichy') ?>",
        "type": "POST",
        "dataType": 'json',
        'data': {
            'folderId': folderId
        },
        success: function(result) {
            if (result.status) {

                $("#folder_transfer_block").html('');
                $("#folder_transfer_block").append(result.html);

            }
        }
    });
}

$(document).ready(function() {

    $('#share_employees').multiSelect();
    $('#share_customers').multiSelect();

    $('#share_lock_employees').multiSelect();
    $('#share_lock_customers').multiSelect();

    $('#emptable').DataTable({
    ordering: false,
    responsive: true
});


    $('#share_employees').on('change', function() {
        var selectedOptions = [];
        $(this).find('option:selected').each(function() {
            selectedOptions.push($(this).text() + '<br>');
        });
        var selectedOptionsText = selectedOptions.join('');
        $('#selected_employees').html('');
        $('#selected_employees').html(selectedOptionsText);
        //console.log(selectedOptionsText); // Display selected options text in console
        // You can use the selectedOptionsText variable for further processing
    });

    
    $('#share_customers').on('change', function() {
        var selectedOptions = [];
        $(this).find('option:selected').each(function() {
            selectedOptions.push($(this).text() + '<br>');
        });
        var selectedOptionsText = selectedOptions.join('');
        $('#selected_customers').html('');
        $('#selected_customers').html(selectedOptionsText);
        //console.log(selectedOptionsText); // Display selected options text in console
        // You can use the selectedOptionsText variable for further processing
    });

    
});

$(document).ready(function() {
    $('#modalForm').submit(function(event) {
        var entityType = $('input[name="entityType"]:checked').val();

        if (entityType === 'folder') {
            // Validate folderName
            var folderName = $('#folderName').val().trim();
            if (folderName === '') {
                // alert('Please enter a folder name.');
                Swal.fire({
                    icon: "error",
                    title: "Please Enter a Folder Name.",
                    showConfirmButton: false,
                    timer: 1500
                });
                event.preventDefault(); // Prevent form submission
            }
        } else if (entityType === 'file') {
            // Validate fileName and fileUpload
            var fileName = $('#fileName').val().trim();
            var fileUpload = $('#fileUpload').val();
            if (fileName === '') {
                // alert('Please enter a file name.');
                Swal.fire({
                    icon: "error",
                    title: "Please Enter a File Name.",
                    showConfirmButton: false,
                    timer: 1500
                });
                event.preventDefault(); // Prevent form submission
            } else if (fileUpload === '') {
                //alert('Please select a file to upload.');
                Swal.fire({
                    icon: "error",
                    title: "Please Select File to Upload.",
                    showConfirmButton: false,
                    timer: 1500
                });
                event.preventDefault(); // Prevent form submission
            }
        } else {
            // Display alert if entityType is neither folder nor file
            //alert('Please select either Folder or File.');
            Swal.fire({
                icon: "error",
                title: "Please Select Either Folder or File.",
                showConfirmButton: false,
                timer: 1500
            });
            event.preventDefault(); // Prevent form submission
        }
    });
});


$(document).ready(function() {
    $('#modalFormTransfer').submit(function(event) {

        // Validate folderName
        var folderName = $('#TransferparentId').val();
        if (folderName === '') {
            // alert('Please enter a folder name.');
            Swal.fire({
                icon: "error",
                title: "Please Select a Folder.",
                showConfirmButton: false,
                timer: 1500
            });
            event.preventDefault(); // Prevent form submission
        }

    });
});


$(document).on('change', '.folder_heirarichy', function() {
    var folderId = $(this).val();
    if (folderId != '') {
        $.ajax({
            "url": "<?php echo site_url('filemanager/getFolderHeirarichy') ?>",
            "type": "POST",
            "dataType": 'json',
            'data': {
                'folderId': folderId
            },
            success: function(result) {
                if (result.status) {

                    $("#folder_transfer_block").html('');
                    $("#folder_transfer_block").append(result.html);

                }
            }
        });
    }
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

function checkFileSize(input) {

    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileSize = file.size; // in bytes
        var maxSize = 5 * 1024 * 1024; // 2 MB
        var allowedExtension = 'zip';
        var fileExtension = file.name.split('.').pop().toLowerCase();
        // Check file size
        if (fileSize > maxSize && fileExtension !== allowedExtension) {
            //alert("File size exceeds 2 MB. Please upload the file in ZIP format.");
            Swal.fire({
                icon: "error",
                title: "File size exceeds 5 MB. Please upload the file in ZIP format.",
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