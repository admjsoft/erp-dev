<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="c_body"></div>
            <div class="card card-block">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo $this->lang->line('File Manager') ?></h3>
                    <p><br></p>

                    <nav aria-label="breadcrumb" class="d-flex align-items-center justify-content-between">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('filemanager'); ?>"><i
                                        class="icon-home"></i></a></li>
                            <?php foreach ($breadcrumbs as $breadcrumb): ?>
                            <?php if ($breadcrumb['entity_type'] == 'folder'): ?>
                            <li class="breadcrumb-item"><a
                                    href="<?php echo base_url('filemanager/list_contents/'.$breadcrumb['entity_id']); ?>"><?php echo $breadcrumb['entity_name']; ?></a>
                            </li>
                            <?php else: ?>
                            <li class="breadcrumb-item active" aria-current="page">
                                <?php echo $breadcrumb['entity_name']; ?>
                            </li>
                            <?php endif; ?>
                            <?php endforeach; ?>
                        </ol>

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

                                    <?php if ($content['entity_type'] == 'file'): ?>
                                    <a href="<?php echo base_url('filemanager/view_file/'.$content['entity_id']); ?>"
                                        title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                    <?php else: ?>
                                    <a href="<?php echo base_url('filemanager/list_contents/'.$content['entity_id']); ?>"
                                        title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="View">
                                            <i class="icon-eye"></i>
                                        </button>
                                    </a>
                                    <?php endif; ?>
                                    <?php if ($content['entity_type'] == 'file'): ?>
                                    <a href="<?php echo base_url('filemanager/download_file/'.$content['entity_id']); ?>"
                                        title="View">
                                        <button type="button" class="btn btn-sm" data-toggle="tooltip"
                                            data-placement="top" title="View">
                                            <i class="icon-arrow-down"></i>
                                        </button>
                                    </a>
                                    <?php endif; ?>




                                </td>
                            </tr>
                            <?php endforeach; } ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>

    </div>


</div>
</div>

<script>
$(document).ready(function() {

    $('#emptable').DataTable({
        ordering: false
    });



});
</script>